<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Legislation;
use App\Http\Requests\LegislationRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\Departament;
use App\Models\Gallery;
use App\Models\Leadership;
use App\Models\LegislationAuthor;
use App\Models\LegislationCategory;
use App\Models\LegislationSituation;
use App\Models\LegislationSubject;
use App\Models\News;
use App\Models\Project;
use App\Models\TypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\WebFooter;
use App\Services\LegislationService;
use App\Services\LegislationCreateService;
use App\Services\LegislationUpdateService;
use App\Services\LegislationBondCreateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class LegislationController extends Controller
{

    public function __construct(
        protected LegislationService $legislationService,
        protected LegislationCreateService $legislationCreateService,
        protected LegislationUpdateService $legislationUpdateService,
        protected LegislationBondCreateService $legislationBondCreateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $legislations = Legislation::with('category', 'situation', 'subjects')
                                        ->latest()
                                        ->get();
            $categories = LegislationCategory::with('legislations')->orderBy('category', 'asc')->get();
            $situations = LegislationSituation::with('legislations')->orderBy('situation', 'asc')->get();
            return view('admin.legislation.legislation_index', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'legislations', 'categories', 'situations'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Assuntos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $categories = LegislationCategory::with('legislations')->orderBy('category', 'asc')->get();
        $situations = LegislationSituation::with('legislations')->orderBy('situation', 'asc')->get();
        $authors = LegislationAuthor::all();
        $subjects = LegislationSubject::with('legislations')->orderBy('subject', 'asc')->get();
        $units = Unit::all();

        return view('admin.legislation.legislation_create', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'categories', 'situations', 'authors', 'subjects', 'units'));

    }

    public function store(
        LegislationRequest $request
    ){
        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $fileData = array_merge(
                $request->toArray(),
                [
                    'content'  => $request['ementa']
                ]
            );
            $this->legislationCreateService->create($fileData);

            flash('Legislação criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($legislation)
    {
        if (! Gate::allows('Ver e Listar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $legislation = Legislation::find($legislation);
            $categories = LegislationCategory::with('legislations')->orderBy('category', 'asc')->get();
            $situations = LegislationSituation::with('legislations')->orderBy('situation', 'asc')->get();
            $authors = LegislationAuthor::all();
            $subjects = LegislationSubject::with('legislations')->orderBy('subject', 'asc')->get();
            $units = Unit::all();
            $legislations = Legislation::with('category', 'situation', 'subjects')
                                        ->latest()
                                        ->get();
            $categories = LegislationCategory::with('legislations')->orderBy('category', 'asc')->get();
            return view('admin.legislation.legislation_show', compact('unit', 'copyright', 'legislation', 'legislations', 'categories', 'situations', 'categories', 'authors', 'subjects', 'units'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        LegislationRequest $request, $legislation_id
    ){
        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $fileData = array_merge(
                $request->toArray(),
                [
                    'content'  => $request['ementa']
                ]
            );
            $this->legislationUpdateService->update($fileData, $legislation_id);

            flash('Legislação editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($legislation_id)
    {
        if (! Gate::allows('Deletar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $legislation = Legislation::find($legislation_id);
            $legislation->delete();
            flash('Legislação deletada com sucesso!')->success();
            return redirect('/legislacoes');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Legislação!')->error();
            return redirect()->back()->withInput();
        }
    }

    //------------------------reports
    public function report_legislation_index(): View
    {
        if (! Gate::allows('Ver e Listar Receitas')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $legislations = Legislation::all();
            $categories = LegislationCategory::orderBy('category', 'asc')->get();
            $situations = LegislationSituation::orderBy('situation', 'asc')->get();
            return view('admin.legislation.report_index', compact('legislations', 'categories', 'situations', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function report_legislations_pdf(Request $request)
    {
        try{
            if (! Gate::allows('Ver e Listar Legislações')) {
                return view('pages.not-authorized');
            }

            if(($request['category_id'] == '0') && ($request['situation_id'] == '0')){
                if($request['type'] == 'day'){
                    $day = date('d', strtotime($request['day']));
                    $legislations = Legislation::with(['category', 'situation'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Legislações";
                    $report_schedule = date('d-m-Y', strtotime($request['day']));
                }
                if($request['type'] == 'month'){
                    $month =  $request['month'];
                    $year = $request['year'];
                    $legislations = Legislation::with(['category', 'situation'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Legislações";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['type'] == 'year'){
                    $year = $request['year'];
                    $legislations = Legislation::with(['category', 'situation'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Legislações";
                    $report_schedule = $request['year'];
                }
                if($request['type'] == 'between'){
                    $date_start = $request['date_start'];
                    $date_end = $request['date_end'];
                    $legislations = Legislation::with(['category', 'situation'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Legislações";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }
            }elseif(($request['category_id'] > '0') && ($request['situation_id'] > '0')){
                if($request['type'] == 'day'){
                    $day = date('d', strtotime($request['day']));
                    $legislations = Legislation::with(['category', 'situation'])
                    ->where('category_id', $request['category_id'])
                    ->where('situation_id', $request['situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Legislações";
                    $report_schedule = date('d-m-Y', strtotime($request['day']));
                }
                if($request['type'] == 'month'){
                    $month =  $request['month'];
                    $year = $request['year'];
                    $legislations = Legislation::with(['category', 'situation'])
                    ->where('category_id', $request['category_id'])
                    ->where('situation_id', $request['situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Legislações";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['type'] == 'year'){
                    $year = $request['year'];
                    $legislations = Legislation::with(['category', 'situation'])
                    ->where('category_id',  $request['category_id'])
                    ->where('situation_id',  $request['situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Legislações";
                    $report_schedule = $request['year'];
                }
                if($request['type'] == 'between'){
                    $date_start = $request['date_start'];
                    $date_end = $request['date_end'];
                    $legislations = Legislation::with(['category', 'situation'])
                    ->where('category_id', $request['category_id'])
                    ->where('situation_id', $request['situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Legislações";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }else{
                if($request['category_id'] > '0'){
                    if($request['type'] == 'day'){
                        $day = date('d', strtotime($request['day']));
                        $legislations = Legislation::with(['category', 'situation'])
                        ->where('category_id', $request['category_id'])
                        ->whereDay('created_at', $day)
                        ->orderBy('created_at')
                        ->get();
                        $report_title = "Relatório Diário de Legislações";
                        $report_schedule = date('d-m-Y', strtotime($request['day']));
                    }
                    if($request['type'] == 'month'){
                        $month =  $request['month'];
                        $year = $request['year'];
                        $legislations = Legislation::with(['category', 'situation'])
                        ->where('category_id', $request['category_id'])
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->orderBy('created_at')
                        ->get();
                        $report_title = "Relatório Mensal de Legislações";
                        $report_schedule = $month . ' - ' . $year;
                    }
                    if($request['type'] == 'year'){
                        $year = $request['year'];
                        $legislations = Legislation::with(['category', 'situation'])
                        ->where('category_id', $request['category_id'])
                        ->whereYear('created_at', $year)
                        ->orderBy('created_at')
                        ->get();
                        $report_title = "Relatório Anual de Legislações";
                        $report_schedule = $request['year'];
                    }
                    if($request['type'] == 'between'){
                        $date_start = $request['date_start'];
                        $date_end = $request['date_end'];
                        $legislations = Legislation::with(['category', 'situation'])
                        ->where('category_id', $request['category_id'])
                        ->whereDate('created_at', '>=' , $date_start)
                        ->whereDate('created_at', '<=' , $date_end)
                        ->orderBy('created_at')
                        ->get();
                        $report_title = "Relatório de Legislações";
                        $report_schedule = $date_start . ' até ' . $date_end;
                    }

                }
                if($request['situation_id'] > '0'){
                    if($request['type'] == 'day'){
                        $day = date('d', strtotime($request['day']));
                        $legislations = Legislation::with(['category', 'situation'])
                        ->where('situation_id', $request['situation_id'])
                        ->whereDay('created_at', $day)
                        ->orderBy('created_at')
                        ->get();
                        $report_title = "Relatório Diário de Legislações";
                        $report_schedule = date('d-m-Y', strtotime($request['day']));
                    }
                    if($request['type'] == 'month'){
                        $month =  $request['month'];
                        $year = $request['year'];
                        $legislations = Legislation::with(['category', 'situation'])
                        ->where('situation_id', $request['situation_id'])
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->orderBy('created_at')
                        ->get();
                        $report_title = "Relatório Mensal de Legislações";
                        $report_schedule = $month . ' - ' . $year;
                    }
                    if($request['type'] == 'year'){
                        $year = $request['year'];
                        $legislations = Legislation::with(['category', 'situation'])
                        ->where('situation_id', $request['situation_id'])
                        ->whereYear('created_at', $year)
                        ->orderBy('created_at')
                        ->get();
                        $report_title = "Relatório Anual de Legislações";
                        $report_schedule = $request['year'];
                    }
                    if($request['type'] == 'between'){
                        $date_start = $request['date_start'];
                        $date_end = $request['date_end'];
                        $legislations = Legislation::with(['category', 'situation'])
                        ->where('situation_id', $request['situation_id'])
                        ->whereDate('created_at', '>=' , $date_start)
                        ->whereDate('created_at', '<=' , $date_end)
                        ->orderBy('created_at')
                        ->get();
                        $report_title = "Relatório de Legislações";
                        $report_schedule = $date_start . ' até ' . $date_end;
                    }

                }
            }

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $pdf = FacadePdf::loadView('admin.legislation.report_pdf', compact('legislations', 'report_title', 'report_schedule', 'unit', 'copyright'));
            $pdf->setPAper('a4', 'portrait');

            return $pdf->stream('legislations.pdf');

        } catch (\Throwable $throwable) {
            flash('Não foram encontradas Legislações Cadastradas!')->error();

            return redirect()->back()->withInput();
        }
    }

    //site


    public function index_web(): View
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $banner = Banner::where('banner_type_id', 7)->first();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $type_requests = TypeRequest::all();
        $categories = LegislationCategory::all();
        $situations = LegislationSituation::all();
        $legislations = Legislation::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(10);
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.legislation.index', compact('institucional_pages', 'service_pages', 'banner', 'web_footer', 'legislations', 'categories', 'situations', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
    }

    public function web_index_filter(Request $request)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 7)->first();
        $type_requests = TypeRequest::all();
        $categories = LegislationCategory::all();
        $situations = LegislationSituation::all();
        $legislations = Legislation::filter($request->all())->where('status', 'PUBLISHED')->paginate(5);
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.legislation.index', compact('institucional_pages', 'service_pages', 'banner', 'web_footer', 'legislations', 'categories', 'situations', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
    }

    public function show_web($legislation_id)
    {
        try{
            $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
            $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $banner = Banner::where('banner_type_id', 7)->first();
            $type_requests = TypeRequest::all();
            $legislation = $this->legislationService->show($legislation_id);
            $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
            $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
            $leaderships = Leadership::all();
            $galleries = Gallery::all();
            $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
            return view('web.legislation.show', compact('institucional_pages', 'service_pages', 'banner', 'web_footer', 'legislation', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();
            return redirect()->back()->withInput();
        }
    }

}
