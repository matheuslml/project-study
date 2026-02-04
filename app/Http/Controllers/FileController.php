<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\Bidding;
use App\Models\BiddingAgreement;
use App\Services\FileService;
use App\Services\FileCreateService;
use App\Services\FileUpdateService;

use App\Models\BiddingAgreementFile;
use App\Models\BiddingFile;
use App\Models\BlankPage;
use App\Models\Category;
use App\Models\EnviromentalLicensing;
use App\Models\ExpenseFile;
use App\Models\File;
use App\Models\FileProject;
use App\Models\FileManagementReport;
use App\Models\ManagementReport;
use App\Models\Project;
use App\Models\FileLegislation;
use App\Models\FileRevenue;
use App\Models\FileType;
use App\Models\Legislation;
use App\Models\TypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\WebFooter;
use Illuminate\Http\Request;
use App\Services\BiddingAgreementService;
use App\Services\BiddingService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Detection\MobileDetect;
use Exception;

class FileController extends Controller
{
    public function __construct(
        protected BiddingAgreementService $biddingAgreementService,
        protected BiddingService $biddingService,
        protected FileService $fileService,
        protected FileCreateService $fileCreateService,
        protected FileUpdateService $fileUpdateService,
    ){}

    //public function index(){}

    public function store(
        Request $request
    ){

        /*if (! Gate::allows('Criar Ouvidoria')) {
            return view('pages.not-authorized');
        }*/
        try {
            DB::beginTransaction();
            foreach ($request['files']['document'] as $key => $files) {
                if ($request['files']['title'][$key]) {

                    $pathfile = Storage::disk('files')->put('documents', $request['files']['document'][$key]);

                    $file = File::create([
                        'file_type_id' => 1,
                        'title' => $request['files']['title'][$key],
                        'url' => $pathfile
                    ]);

                    //Contrato
                    if($request->type == 'bidding_agreement'){
                        BiddingAgreementFile::create([
                            'bidding_agreement_id' => $request->id,
                            'file_id' => $file->id
                        ]);
                    }

                    //Licitação
                    if($request->type == 'bidding'){
                        BiddingFile::create([
                            'bidding_id' => $request->id,
                            'file_id' => $file->id
                        ]);
                    }

                    //Legislação
                    if($request->type == 'legislation'){
                        FileLegislation::create([
                            'legislation_id' => $request->id,
                            'file_id' => $file->id
                        ]);
                    }

                    //Receitas
                    if($request->type == 'revenue'){
                        FileRevenue::create([
                            'file_id' => $file->id,
                            'revenue_id' => $request->id
                        ]);
                    }

                    //Despesas
                    if($request->type == 'expense'){
                        ExpenseFile::create([
                            'file_id' => $file->id,
                            'expense_id' => $request->id
                        ]);
                    }

                    //Projetos
                    if($request->type == 'project'){
                        FileProject::create([
                            'file_id' => $file->id,
                            'project_id' => $request->id,
                        ]);

                    }
                }
            }

            DB::commit();
            session()->flash('success', 'Registro criado com sucesso! ');

            return redirect()->back();
        }catch (Exception $exception){
            DB::rollBack();
            session()->flash('error', 'Aconteceu algum erro!! ');
            return redirect()->back()->withInput();
        }
    }

    public function show($file_id)
    {
        /*if (! Gate::allows('Criar Ouvidoria')) {
            return view('pages.not-authorized');
        }*/

        try{
            $detect = new MobileDetect();
            $isMobile = $detect->isMobile();
            $file = File::find($file_id);
            if($isMobile){
                return response()->download('storage/files/' . $file->url, 'file.pdf');
            }else{
                $url_redirect = asset('storage/files/' . $file->url);
                return redirect()->to($url_redirect);
            }

        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function file_web($file_id)
    {
        /*if (! Gate::allows('Criar Ouvidoria')) {
            return view('pages.not-authorized');
        }*/

        try{
            $detect = new MobileDetect();
            $isMobile = $detect->isMobile();
            $file = File::find($file_id);
            if($isMobile){
                return response()->download('storage/files/' . $file->url, 'file.pdf');
            }else{
                $url_redirect = asset('storage/files/' . $file->url);
                return redirect()->to($url_redirect);
            }

        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        FileRequest $request, $file_id
    ){
        if (! Gate::allows('file-update')) {
            return abort(401);
        }
        try {
            DB::beginTransaction();
            $fileData = array_merge(
                $request->toArray(),
                [
                    'file_id'  => $file_id
                ]
            );
            $this->fileUpdateService->update($fileData);

            session()->flash('success', 'Registro editado com sucesso! ');
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            session()->flash('error', 'Aconteceu alguem erro!! ');
            return redirect()->back()->withInput();
        }
    }

    public function destroy($file)
    {
        if (! Gate::allows('file-delete')) {
            return abort(401);
        }
        try{
            DB::beginTransaction();
                $file = File::find($file);
                $old_path = storage_path() . '/app/public/files/documents/' . str_replace("documents/", "", $file->url);
                $file->delete();
                unlink($old_path);
                session()->flash('success', 'Registro deletado com sucesso! ');
            DB::commit();
            if(count($file->agreements) > 0){
                return redirect()->action(
                    [BiddingAgreementController::class, 'show'], ['licitacao_contrato' => $file->agreements->first()->id]
                );
            }
            if(count($file->biddings) > 0){
                return redirect()->action(
                    [BiddingController::class, 'show'], ['licitaco' => $file->biddings->first()->id]
                );
            }
            if(count($file->legislations) > 0){
                return redirect()->action(
                    [LegislationController::class, 'show'], ['legislaco' => $file->legislations->first()->id]
                );
            }
            if(count($file->revenues) > 0){
                return redirect()->action(
                    [RevenueController::class, 'show'], ['receita' => $file->revenues->first()->id]
                );
            }
            if(count($file->expenses) > 0){
                return redirect()->action(
                    [ExpenseController::class, 'show'], ['despesa' => $file->expenses->first()->id]
                );
            }
            if(count($file->official_diaries) > 0){
                return redirect()->action(
                    [OfficialDiaryController::class, 'show'], ['official_diary' => $file->expenses->first()->id]
                );
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('error', 'Aconteceu alguem erro!! ');
            return redirect()->back()->withInput();
        }

    }


    public function getRegisters(int $idType): JsonResponse
    {
        if($idType == 0){
            $registers = BiddingAgreement::all();

        }
        elseif($idType == 1){
            $registers = Bidding::all();

        }
        elseif($idType == 2){
            $registers = Legislation::all();

        }
        return Response::json($registers);
    }
}
