<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\RevenueRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\Gallery;
use App\Models\Leadership;
use App\Models\News;
use App\Models\Project;
use App\Models\Revenue;
use App\Models\RevenueType;
use App\Models\TypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\WebFooter;
use Illuminate\Contracts\View\View;
use App\Services\RevenueService;
use App\Services\RevenueCreateService;
use App\Services\RevenueUpdateService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class RevenueController extends Controller
{
    public function __construct(
        protected RevenueService $revenueService,
        protected RevenueCreateService $revenueCreateService,
        protected RevenueUpdateService $revenueUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Receitas')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $revenues = Revenue::with('files')->latest()->get();
            return view('admin.revenue.revenue_index', ['pageConfigs' => $pageConfigs], compact('revenues', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Receitas Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Editar Receitas')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $types = RevenueType::orderBy('title', 'asc')->get();
            return view('admin.revenue.revenue_create', ['pageConfigs' => $pageConfigs], compact('types', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Receitas Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        RevenueRequest $request
    ){
        if (! Gate::allows('Editar Receitas')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $revenue = $this->revenueCreateService->create($request->toArray());

            flash('Tipo de Receita criada com sucesso!')->success();
            DB::commit();
            return redirect()->route('receitas.show', [$revenue->id]);
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar nova Receita!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($revenue_id)
    {
        if (! Gate::allows('Ver e Listar Receitas')) {
            return view('pages.not-authorized');
        }

        try{
            $types = RevenueType::orderBy('title', 'asc')->get();
            $revenue = $this->revenueService->show($revenue_id);
            return view('admin.revenue.revenue_show', compact('revenue', 'types'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar a Receita!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        RevenueRequest $request, $revenue_id
    ){
        if (! Gate::allows('Editar Receitas')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->revenueUpdateService->update($request->toArray(), $revenue_id);

            flash('Receita editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar a Receita!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($revenue)
    {
        if (! Gate::allows('Deletar Receitas')) {
            return view('pages.not-authorized');
        }

        try{
            $revenueDelete = Revenue::find($revenue);
            $revenueDelete->delete();
            $pageConfigs = ['pageHeader' => false];

            $revenues = $this->revenueService->get();
            return view('admin.revenue.revenue_index', ['pageConfigs' => $pageConfigs], compact('revenues'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Receita!')->error();
            return redirect()->back()->withInput();
        }
    }

    //------------------------reports
    public function report_revenue_index(): View
    {
        if (! Gate::allows('Ver e Listar Receitas')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $revenues = Revenue::all();
            $types = RevenueType::orderBy('title', 'asc')->get();
            return view('admin.revenue.report_index', compact('revenues', 'types', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function report_revenues_pdf(Request $request)
    {
        try{
            if (! Gate::allows('Ver e Listar Receitas')) {
                return view('pages.not-authorized');
            }

            if($request['type'] == 'day'){
                if($request['type_id'] > 0){
                    $day = date('d', strtotime($request['day']));
                    $revenues = Revenue::with(['type'])
                    ->where('type_id','==' , $request['type_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Receitas";
                    $report_schedule = date('d-m-Y', strtotime($request['day']));
                }else{
                    $day = date('d', strtotime($request['day']));
                    $revenues = Revenue::with(['type'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Receitas";
                    $report_schedule = date('d-m-Y', strtotime($request['day']));
                }
            }
            if($request['type'] == 'month'){
                if($request['type_id'] > 0){
                    $month =  $request['month'];
                    $year = $request['year'];
                    $revenues = Revenue::with(['type'])
                    ->where('type_id','==' , $request['type_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Receitas";
                    $report_schedule = $month . ' - ' . $year;
                }else{
                    $month =  $request['month'];
                    $year = $request['year'];
                    $revenues = Revenue::with(['type'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Receitas";
                    $report_schedule = $month . ' - ' . $year;
                }
            }
            if($request['type'] == 'year'){
                if($request['type_id'] > 0){
                    $year = $request['year'];
                    $revenues = Revenue::with(['type'])
                    ->where('type_id', $request['type_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Receitas";
                    $report_schedule = $request['year'];
                }
                else{
                    $year = $request['year'];
                    $revenues = Revenue::with(['type'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Receitas";
                    $report_schedule = $request['year'];
                }
            }
            if($request['type'] == 'between'){
                if($request['type_id'] > 0){
                    $date_start = $request['date_start'];
                    $date_end = $request['date_end'];
                    $revenues = Revenue::with(['type'])
                    ->where('type_id','==' , $request['type_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Receitas";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }else{
                    $date_start = $request['date_start'];
                    $date_end = $request['date_end'];
                    $revenues = Revenue::with(['type'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Receitas";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }
            }

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $pdf = FacadePdf::loadView('admin.revenue.report_pdf', compact('revenues', 'report_title', 'report_schedule', 'unit', 'copyright'));
            $pdf->setPAper('a4', 'portrait');

            return $pdf->stream('revenues.pdf');

        } catch (\Throwable $throwable) {
            flash('Não foram encontradas Receitas Cadastradas!')->error();

            return redirect()->back()->withInput();
        }
    }

    //site


    public function web_index(Request $request){

        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 6)->first();
        $type_requests = TypeRequest::all();
        $revenues = Revenue::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(10);
        $types = RevenueType::all();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.revenue.index', compact('institucional_pages', 'service_pages', 'banner', 'web_footer', 'revenues', 'types', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
    }

    public function web_index_filter(Request $request)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 6)->first();
        $type_requests = TypeRequest::all();
        $revenues = Revenue::filter($request->all())->where('status', 'PUBLISHED')->paginate(5);
        $types = RevenueType::all();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.revenue.index', compact('institucional_pages', 'service_pages', 'banner', 'web_footer', 'revenues', 'types', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
    }

    public function web_show($revenue_id)
    {
        try{
            $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
            $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $banner = Banner::where('banner_type_id', 6)->first();
            $type_requests = TypeRequest::all();
            $revenue = Revenue::findOrFail($revenue_id);
            $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
            $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
            $leaderships = Leadership::all();
            $galleries = Gallery::all();
            $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
            return view('web.revenue.show', compact('institucional_pages', 'service_pages', 'banner', 'web_footer', 'revenue', 'unit', 'copyright', 'type_requests', 'news', 'projects', 'leaderships', 'galleries'));
        } catch (\Exception $exception) {
            session()->flash('show_revenue_error', $revenue['title'].' Erro ao tentar acessar! ');
            return redirect()->route('web.revenue_index');
        }
    }
}
