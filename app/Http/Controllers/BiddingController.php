<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidding;
use App\Models\BiddingAgreement;
use App\Models\BiddingFile;
use App\Models\BiddingWinner;
use App\Http\Requests\BiddingCreateRequest;
use App\Models\Banner;
use App\Models\BiddingModality;
use App\Models\BiddingSituation;
use App\Models\BlankPage;
use App\Models\Gallery;
use App\Models\Leadership;
use App\Models\News;
use App\Models\Person;
use App\Models\Project;
use App\Models\TypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\BiddingService;
use App\Services\BiddingCreateService;
use App\Services\BiddingUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BiddingController extends Controller
{

    public function __construct(
        protected BiddingService $biddingService,
        protected BiddingCreateService $biddingCreateService,
        protected BiddingUpdateService $biddingUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $biddings = Bidding::with('modality')
                                        ->latest()
                                        ->get();
            return view('admin.bidding.bidding_index', ['pageConfigs' => $pageConfigs], compact('biddings', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Assuntos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Criar Licitações')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $modalities = BiddingModality::with('biddings')->orderBy('title', 'asc')->get();
        $situations = BiddingSituation::with('biddings')->orderBy('title', 'asc')->get();

        return view('admin.bidding.bidding_create', ['pageConfigs' => $pageConfigs], compact('modalities', 'unit', 'copyright', 'situations'));

    }

    public function store(
        BiddingCreateRequest $request
    ){
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $fileData = array_merge(
                $request->toArray(),
                [
                    'login'  => 0
                ]
            );
            $this->biddingCreateService->create($fileData);

            flash('Licitação criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($bidding_id)
    {
        if (! Gate::allows('Ver e Listar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $bidding = Bidding::find($bidding_id);
            $biddings = Bidding::with('modality')
            ->latest()
            ->get();
            $possible_winners = Person::whereDoesntHave('departaments')
                                        ->orderBy('full_name', 'asc')
                                        ->get();
            $modalities = BiddingModality::with('biddings')->orderBy('title', 'asc')->get();
            $situations = BiddingSituation::with('biddings')->orderBy('title', 'asc')->get();

            return view('admin.bidding.bidding_show', compact('bidding', 'unit', 'copyright', 'biddings', 'modalities', 'situations', 'possible_winners'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        BiddingCreateRequest $request, $bidding_id
    ){
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->biddingUpdateService->update($request->toarray(), $bidding_id);

            flash('Licitação editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($bidding_id)
    {
        if (! Gate::allows('Deletar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $bidding = Bidding::find($bidding_id);
            $bidding->delete();
            flash('Licitação deletada com sucesso!')->success();
            return redirect('/legislacoes');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Licitação!')->error();
            return redirect()->back()->withInput();
        }
    }

    //site


    public function index_web(): View
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 8)->first();
        $type_requests = TypeRequest::all();
        $biddings = Bidding::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(10);
        $modalities = BiddingModality::all();
        $situations = BiddingSituation::all();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        return view('web.bidding.index', compact('service_pages', 'institucional_pages', 'banner', 'biddings', 'modalities', 'situations', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
    }

    public function web_index_filter(Request $request)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 8)->first();
        $type_requests = TypeRequest::all();
        $modalities = BiddingModality::all();
        $situations = BiddingSituation::all();
        $biddings = Bidding::filter($request->all())->where('status', 'PUBLISHED')->paginate(5);
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        return view('web.bidding.index', compact('service_pages', 'institucional_pages', 'banner', 'biddings', 'modalities', 'situations', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
    }

    public function show_web($bidding_id)
    {
        try{
            $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
            $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $type_requests = TypeRequest::all();
            $bidding = $this->biddingService->show($bidding_id);
            $bidding_files = BiddingFile::where('bidding_id', $bidding->id)->paginate(10);
            $bidding_winners = BiddingWinner::where('bidding_id', $bidding_id)->paginate(10);
            $bidding_agreements = BiddingAgreement::where('bidding_id', $bidding_id)->paginate(10);
            $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
            $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
            $leaderships = Leadership::all();
            $galleries = Gallery::all();
            return view('web.bidding.show', compact('service_pages', 'institucional_pages', 'bidding', 'bidding_files', 'bidding_winners', 'bidding_agreements', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();
            return redirect()->back()->withInput();
        }
    }

}
