<?php

namespace App\Http\Controllers;

use App\Http\Requests\OmbudsmanRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\Gallery;
use App\Models\Leadership;
use App\Models\News;
use App\Models\Ombudsman;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use App\Services\OmbudsmanService;
use App\Services\OmbudsmanCreateService;
use App\Services\OmbudsmanUpdateService;
use App\Models\TypeAccess;
use App\Models\TypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\ProjectCategory;
use App\Models\WebFooter;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class OmbudsmanController extends Controller
{
    public function __construct(
        protected OmbudsmanService $ombudsmanService,
        protected OmbudsmanCreateService $ombudsmanCreateService,
        protected OmbudsmanUpdateService $ombudsmanUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $ombudsmen = $this->ombudsmanService->get();
            return view('admin.ombudsman.ombudsman_index', ['pageConfigs' => $pageConfigs], compact('ombudsmen', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Manifestações Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($ombudsman_id)
    {
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $ombudsman = $this->ombudsmanService->show($ombudsman_id);
            return view('admin.ombudsman.ombudsman_show', compact('ombudsman', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar a Manifestação!')->error();
            return redirect()->back()->withInput();
        }
    }

    //site


    public function web_ouvidoria()
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $type_requests = TypeRequest::all();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 1)->first();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        $categories = ProjectCategory::orderBy('title', 'asc')->get();
        return view('web.ombudsman.index', compact('categories', 'institucional_pages', 'service_pages', 'banner', 'web_footer', 'type_requests', 'unit', 'copyright', 'news', 'projects', 'leaderships', 'galleries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->ombudsmanCreateService->create($request->toArray());

            session()->flash('success', 'Manifesto realizado com sucesso! ');
            flash('Manifesto realizado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){

            DB::rollBack();
            dd($throwable);
            session()->flash('error', 'Aconteceu algum erro!! ');
            flash('Erro ao adicionar manifesto!')->error();
            return redirect()->back()->withInput();
        }
    }

    //reports
    public function report_ombudsman_index(): View
    {
        if (! Gate::allows('Ver e Listar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $ombudsman = Ombudsman::all();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.ombudsman.report_index', compact('ombudsman', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar os RAS Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function report_ombudsman_pdf(Request $request)
    {
        try{
            if (! Gate::allows('Ver e Listar Manifestações')) {
                return view('pages.not-authorized');
            }

            if($request['type'] == 'day'){
                $day = date('d', strtotime($request['day']));
                $ombudsman = Ombudsman::with(['type_access', 'type_request'])
                ->whereDay('created_at', $day)
                ->orderBy('created_at')
                ->get();
                $report_title = "Relatório Diário de Manifestações";
                $report_schedule = date('d-m-Y', strtotime($request['day']));
            }
            if($request['type'] == 'month'){
                $month =  $request['month'];
                $year = $request['year'];
                $ombudsman = Ombudsman::with(['type_access', 'type_request'])
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->orderBy('created_at')
                ->get();
                $report_title = "Relatório Mensal de Manifestações";
                $report_schedule = $month . ' - ' . $year;
            }
            if($request['type'] == 'year'){
                $year = $request['year'];
                $ombudsman = Ombudsman::with(['', 'type_request'])
                ->whereYear('created_at', $year)
                ->orderBy('created_at')
                ->get();
                $report_title = "Relatório Anual de Manifestações";
                $report_schedule = $request['year'];
            }
            if($request['type'] == 'between'){
                $date_start = $request['date_start'];
                $date_end = $request['date_end'];
                $ombudsman = Ombudsman::with(['type_access', 'type_request'])
                ->whereDate('created_at', '>=' , $date_start)
                ->whereDate('created_at', '<=' , $date_end)
                ->orderBy('created_at')
                ->get();
                $report_title = "Relatório de Manifestações";
                $report_schedule = $date_start . ' até ' . $date_end;
            }
        $pdf = FacadePdf::loadView('admin.ombudsman.report_pdf', compact('ombudsman', 'report_title', 'report_schedule'));
        $pdf->setPAper('a4', 'portrait');

        return $pdf->stream('ombudsman.pdf');

            //return view('admin.reports.orderly_pdf', compact('orderlies', 'report_title', 'report_schedule'));
        } catch (\Throwable $throwable) {
            flash('Não foram encontradas Manifestações Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }
}
