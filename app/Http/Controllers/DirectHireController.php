<?php

namespace App\Http\Controllers;

use App\Http\Requests\DirectHireRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\DirectHire;
use App\Models\DirectHireFile;
use App\Models\DirectHireModality;
use App\Models\DirectHireSituations;
use App\Models\DirectHireWinner;
use App\Models\Gallery;
use App\Models\Leadership;
use App\Models\News;
use App\Models\Person;
use App\Models\Project;
use App\Models\TypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;
use App\Services\DirectHireService;
use App\Services\DirectHireCreateService;
use App\Services\DirectHireUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class DirectHireController extends Controller
{
    public function __construct(
        protected DirectHireService $directHireService,
        protected DirectHireCreateService $directHireCreateService,
        protected DirectHireUpdateService $directHireUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Contratações Diretas')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $direct_hires = DirectHire::with('modality')
                                        ->latest()
                                        ->get();
            return view('admin.directHire.index', ['pageConfigs' => $pageConfigs], compact('direct_hires', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Contratações Diretas Cadastrada-s!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Criar Contratações Diretas')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $modalities = DirectHireModality::with('directHires')->orderBy('title', 'asc')->get();
        $situations = DirectHireSituations::with('directHires')->orderBy('title', 'asc')->get();

        return view('admin.directHire.create', ['pageConfigs' => $pageConfigs], compact('modalities', 'situations', 'unit', 'copyright'));

    }

    public function store(
        DirectHireRequest $request
    ){
        if (! Gate::allows('Criar Contratações Diretas')) {
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
            $this->directHireCreateService->create($fileData);

            flash('Contratação Direta criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        if (! Gate::allows('Ver e Listar Contratações Diretas')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $direct_hire = DirectHire::find($id);
            $direct_hires = DirectHire::with('modality')
            ->latest()
            ->get();
            $possible_winners = Person::whereDoesntHave('departaments')
                                        ->orderBy('full_name', 'asc')
                                        ->get();
            $modalities = DirectHireModality::with('directHires')->orderBy('title', 'asc')->get();
            $situations = DirectHireSituations::with('directHires')->orderBy('title', 'asc')->get();

            return view('admin.directHire.show', compact('direct_hire', 'unit', 'copyright', 'direct_hires', 'modalities', 'situations', 'possible_winners'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        DirectHireRequest $request, $direct_hire_id
    ){
        if (! Gate::allows('Editar Contratações Diretas')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->directHireUpdateService->update($request->toarray(), $direct_hire_id);

            flash('Contratação Direta editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
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
        $banner = Banner::where('banner_type_id', 10)->first();
        $type_requests = TypeRequest::all();

        $direct_hires = DirectHire::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(10);
        $modalities = DirectHireModality::all();
        $situations = DirectHireSituations::all();
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        return view('web.directHire.index', compact('service_pages', 'institucional_pages', 'banner', 'direct_hires', 'modalities', 'situations', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
    }

    public function web_index_filter(Request $request)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 10)->first();
        $type_requests = TypeRequest::all();
        $modalities = DirectHireModality::all();
        $situations = DirectHireSituations::all();
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $direct_hires = DirectHire::filter($request->all())->where('status', 'PUBLISHED')->paginate(5);
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        return view('web.directHire.index', compact('service_pages', 'institucional_pages', 'banner', 'direct_hires', 'modalities', 'situations', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
    }

    public function show_web($direct_hire_id)
    {
        try{
            $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
            $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $type_requests = TypeRequest::all();
            $direct_hire = $this->directHireService->show($direct_hire_id);
            $direct_hire_files = DirectHireFile::where('direct_hire_id', $direct_hire->id)->paginate(10);
            $direct_hire_winners = DirectHireWinner::where('direct_hire_id', $direct_hire->id)->paginate(10);
            $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
            $leaderships = Leadership::all();
            $galleries = Gallery::all();
            $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
            return view('web.directHire.show', compact('service_pages', 'institucional_pages', 'direct_hire', 'direct_hire_files', 'direct_hire_winners', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();
            return redirect()->back()->withInput();
        }
    }
}
