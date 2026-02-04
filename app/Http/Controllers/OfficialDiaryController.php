<?php

namespace App\Http\Controllers;


use App\Actions\OfficialDiary\CutString;
use App\Http\Requests\OfficialDiaryRequest;
use App\Models\Act;
use App\Models\ActTopic;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\Copyright;
use App\Models\OfficialDiary;
use App\Models\Unit;
use App\Models\WebFooter;
use App\Services\OfficialDiaryCreateService;
use App\Services\OfficialDiaryService;
use App\Services\OfficialDiaryUpdateService;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class OfficialDiaryController extends Controller
{

    public function __construct(
        protected OfficialDiaryService $officialDiaryService,
        protected OfficialDiaryCreateService $officialDiaryCreateService,
        protected OfficialDiaryUpdateService $officialDiaryUpdateService,
    ) {
    }

    public function index(): View
    {
        if (!Gate::allows('Ver e Listar Diário Oficial')) {
            return view('pages.not-authorized');
        }

        try {
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $official_diaries = OfficialDiary::orderByRaw('CAST(edition AS UNSIGNED) DESC')->get();

            $pendents = count(OfficialDiary::where('status', 'PENDING')->orWhere('status', 'DRAFT')->get());

            return view(
                'admin.official_diary.official_diary_index',
                ['pageConfigs' => $pageConfigs],
                compact('unit', 'copyright', 'official_diaries', 'pendents')
            );
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Assuntos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (!Gate::allows('Criar Diário Oficial')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $certificates = Certificate::where('status', 'PUBLISHED')->orderBy('name', 'asc')->get();

        $acts = Act::where('status', 'PENDING')->orWhere('status', 'DRAFT')->orderBy('created_at', 'desc')->get();

        return view(
            'admin.official_diary.official_diary_create',
            ['pageConfigs' => $pageConfigs],
            compact('certificates', 'unit', 'copyright', 'acts')
        );
    }

    public function store(
        OfficialDiaryRequest $request
    ) {
        if (!Gate::allows('Editar Diário Oficial')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            if (isset($request['type']) && isset($request['file']) && $request['type'] == 'FILE') {
                $pathfile = Storage::disk('files')->put('documents', $request['file']);
                $data = array_merge(
                    $request->toArray(),
                    [
                        'pathfile' => $pathfile
                    ]
                );
                $this->officialDiaryCreateService->create($data);
                flash('O Diário Oficial foi criado com sucesso!')->success();
            } elseif (isset($request['type']) && $request['type'] != 'FILE') {
                $this->officialDiaryCreateService->create($request->toArray());
                flash('O Diário Oficial foi criado com sucesso!')->success();
            } elseif (isset($request['type']) && !isset($request['file']) && $request['type'] == 'FILE') {
                flash('É necessário selecionar um arquivo!')->error();
            }
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $throwable) {
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($official_diary_id)
    {
        if (!Gate::allows('Ver e Listar Diário Oficial')) {
            return view('pages.not-authorized');
        }

        try {
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $official_diary = OfficialDiary::find($official_diary_id);
            $acts = Act::where('status', 'PENDING')->orWhere('status', 'DRAFT')->orWhere(
                'official_diary_id',
                $official_diary_id
            )->orderBy('created_at', 'desc')->get();

            $certificates = Certificate::where('status', 'PUBLISHED')->orderBy('name', 'asc')->get();

            return view(
                'admin.official_diary.official_diary_show',
                compact('acts', 'unit', 'copyright', 'official_diary', 'certificates')
            );
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Diário Oficial!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        OfficialDiaryRequest $request,
        $official_diary_id
    ) {
        if (!Gate::allows('Editar Diário Oficial')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            if (isset($request['file'])) {
                $pathfile = Storage::disk('files')->put('documents', $request['file']);
                $data = array_merge(
                    $request->toArray(),
                    [
                        'pathfile' => $pathfile
                    ]
                );
                $this->officialDiaryUpdateService->update($data, $official_diary_id);
            } else {
                $this->officialDiaryUpdateService->update($request->toArray(), $official_diary_id);
            }

            flash('Diário Oficial editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $throwable) {
            DB::rollBack();
            flash('Erro ao editar o Diário Oficial!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($official_diary_id)
    {
        if (!Gate::allows('Deletar Diário Oficial')) {
            return view('pages.not-authorized');
        }

        try {
            $for_delete = OfficialDiary::find($official_diary_id);
            $for_delete->delete();
            flash('Diário deletado com sucesso!')->success();
            return redirect('/noticias');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Notícia!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function pdf_official_diary_acts($official_diary_id)
    {
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        $report_title = 'Lista de Responsáveis Familiares com Funcionários Públicos no Grupo Familiar';

        $official_diary = OfficialDiary::find($official_diary_id);

        $cut_string = resolve(CutString::class);
        //array de linhas limitadas por quantidade de caracteres
        //usar tpicas como linha tbm
        $lines = array();
        $line_limit = 5;
        //utilizar campo de muda coluna

        $act_topics = ActTopic::where('status', 'PUBLISHED')->whereNull('act_topic_id')->orderBy('title', 'asc')->get();

        foreach ($act_topics as $topic) {
            $string_lenght = 0;
            //se tiver acts no tópico raiz
            if (count(
                    Act::where('official_diary_id', $official_diary_id)->where('act_topic_id', $topic->id)->get()
                ) > 0) {
                $subtitle_data = $cut_string->handle($topic->title, 'subtitle');
                array_push($lines, $subtitle_data);

                $acts = Act::where('official_diary_id', $official_diary_id)->where('act_topic_id', $topic->id)->get();
                foreach ($acts as $act) {
                    $subtitle_data = $cut_string->handle($act->title, 'act-title');
                    array_push($lines, $subtitle_data);
                    $body_data = $cut_string->handle($act->body, 'body');
                    array_push($lines, $body_data);
                }
            }
            foreach ($topic->actTopics as $btopic) {
                if (count(
                        Act::where('official_diary_id', $official_diary_id)->where('act_topic_id', $btopic->id)->get()
                    ) > 0) {
                    $title_data = $cut_string->handle($btopic->actTopic->title, 'title');
                    $subtitle_data = $cut_string->handle($btopic->title, 'subtitle');
                    array_push($lines, $title_data);
                    array_push($lines, $subtitle_data);

                    $acts = Act::where('official_diary_id', $official_diary_id)->where(
                        'act_topic_id',
                        $btopic->id
                    )->get();
                    foreach ($acts as $act) {
                        $subtitle_data = $cut_string->handle($act->title, 'act-title');
                        array_push($lines, $subtitle_data);
                        $body_data = $cut_string->handle($act->body, 'body');
                        array_push($lines, $body_data);
                    }
                }
            }
        }

        $pdf = FacadePdf::loadView(
            'admin.official_diary.pdf_official_diary_acts',
            compact('unit', 'copyright', 'official_diary', 'report_title', 'lines', 'act_topics', 'line_limit')
        );
        $pdf->setPAper('a4', 'portrait');
        //return view('admin.official_diary.pdf_official_diary_acts', compact('unit', 'copyright', 'official_diary', 'report_title', 'lines', 'act_topics', 'line_limit' ));

        return $pdf->stream($official_diary->edition . '_diario_oficial.pdf');
    }

    public function diarios_oficiais_web_filter_text(Request $request)
    {
        try {
            $official_diaries = OfficialDiary::
            where('status', 'PUBLISHED')
                ->whereAny([
                    'edition',
                    'description',
                ], 'LIKE', $request->text . '%')
                ->orderByRaw('CAST(edition AS UNSIGNED) DESC')
                ->paginate(10);
            $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
            $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $banner = Banner::where('banner_type_id', 14)->first();
            $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
            $categories = Category::orderBy('title')->get();
            $official_diary_last = $official_diaries->first();

            return view(
                'web.official_diary.index',
                compact(
                    'official_diaries',
                    'official_diary_last',
                    'categories',
                    'service_pages',
                    'institucional_pages',
                    'banner',
                    'unit',
                    'copyright',
                    'web_footer'
                )
            );
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar os Diários Oficiais!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function diarios_oficiais_web_filter_year(Request $request)
    {
        try {
            $official_diaries = OfficialDiary::
            where('status', 'PUBLISHED')
                ->whereYear('published_at', '>=', $request->year)
                ->orderByRaw('CAST(edition AS UNSIGNED) DESC')
                ->paginate(10);
            $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
            $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $banner = Banner::where('banner_type_id', 14)->first();
            $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
            $categories = Category::orderBy('title')->get();
            $official_diary_last = $official_diaries->first();

            return view(
                'web.official_diary.index',
                compact(
                    'official_diaries',
                    'official_diary_last',
                    'categories',
                    'service_pages',
                    'institucional_pages',
                    'banner',
                    'unit',
                    'copyright',
                    'web_footer'
                )
            );
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar os Diários Oficiais!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function diarios_oficiais_web_filter_date(Request $request)
    {
        try {
            $official_diaries = OfficialDiary::
            where('status', 'PUBLISHED')
                ->whereDate('published_at', '>=', $request->started_at)
                ->whereDate('published_at', '<=', $request->ended_at)
                ->orderByRaw('CAST(edition AS UNSIGNED) DESC')
                ->paginate(10);
            $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
            $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $banner = Banner::where('banner_type_id', 14)->first();
            $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
            $categories = Category::orderBy('title')->get();
            $official_diary_last = $official_diaries->first();

            return view(
                'web.official_diary.index',
                compact(
                    'official_diaries',
                    'official_diary_last',
                    'categories',
                    'service_pages',
                    'institucional_pages',
                    'banner',
                    'unit',
                    'copyright',
                    'web_footer'
                )
            );
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar os Diários Oficiais!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function web_pdf_official_diary_acts($official_diary_id)
    {
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        $report_title = 'Lista de Responsáveis Familiares com Funcionários Públicos no Grupo Familiar';

        $official_diary = OfficialDiary::find($official_diary_id);

        $cut_string = resolve(CutString::class);
        //array de linhas limitadas por quantidade de caracteres
        //usar tpicas como linha tbm
        $lines = array();
        $line_limit = 5;
        //utilizar campo de muda coluna

        $act_topics = ActTopic::where('status', 'PUBLISHED')->whereNull('act_topic_id')->orderBy('title', 'asc')->get();

        foreach ($act_topics as $topic) {
            $string_lenght = 0;
            //se tiver acts no tópico raiz
            if (count(
                    Act::where('official_diary_id', $official_diary_id)->where('act_topic_id', $topic->id)->get()
                ) > 0) {
                $subtitle_data = $cut_string->handle($topic->title, 'subtitle');
                array_push($lines, $subtitle_data);

                $acts = Act::where('official_diary_id', $official_diary_id)->where('act_topic_id', $topic->id)->get();
                foreach ($acts as $act) {
                    $subtitle_data = $cut_string->handle($act->title, 'act-title');
                    array_push($lines, $subtitle_data);
                    $body_data = $cut_string->handle($act->body, 'body');
                    array_push($lines, $body_data);
                }
            }
            foreach ($topic->actTopics as $btopic) {
                if (count(
                        Act::where('official_diary_id', $official_diary_id)->where('act_topic_id', $btopic->id)->get()
                    ) > 0) {
                    $title_data = $cut_string->handle($btopic->actTopic->title, 'title');
                    $subtitle_data = $cut_string->handle($btopic->title, 'subtitle');
                    array_push($lines, $title_data);
                    array_push($lines, $subtitle_data);

                    $acts = Act::where('official_diary_id', $official_diary_id)->where(
                        'act_topic_id',
                        $btopic->id
                    )->get();
                    foreach ($acts as $act) {
                        $subtitle_data = $cut_string->handle($act->title, 'act-title');
                        array_push($lines, $subtitle_data);
                        $body_data = $cut_string->handle($act->body, 'body');
                        array_push($lines, $body_data);
                    }
                }
            }
        }

        $pdf = FacadePdf::loadView(
            'admin.official_diary.pdf_official_diary_acts',
            compact('unit', 'copyright', 'official_diary', 'report_title', 'lines', 'act_topics', 'line_limit')
        );
        $pdf->setPAper('a4', 'portrait');
        return $pdf->stream($official_diary->edition . '_diario_oficial.pdf');
    }
}
