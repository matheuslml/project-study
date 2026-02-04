<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\FaqRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Leadership;
use App\Models\News;
use App\Models\Project;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\ProjectCategory;
use App\Services\FaqService;
use App\Services\FaqCreateService;
use App\Services\FaqUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FaqController extends Controller
{
    public function __construct(
        protected FaqService $faqService,
        protected FaqCreateService $faqCreateService,
        protected FaqUpdateService $faqUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar FAQs')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $faqs = Faq::all();
            return view('admin.faq.index', ['pageConfigs' => $pageConfigs], compact('faqs', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as FAQs Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        FaqRequest $request
    ){
        if (! Gate::allows('Criar FAQs')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->faqCreateService->create($request->toArray());

            flash('FAQ criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar nova FAQ!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($faq_id): View
    {
        if (! Gate::allows('Ver e Listar FAQs')) {
            return view('pages.not-authorized');
        }

        try{
            $faq = Faq::find($faq_id);
            $faqs = Faq::all();
            $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.faq.show', compact('faq', 'faqs', 'unit', 'copyright'));

        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        FaqRequest $request, $faq_id
    ){
        if (! Gate::allows('Editar FAQs')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->faqUpdateService->update($request->toArray(), $faq_id);

            flash('FAQ editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar o FAQ!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($faq)
    {
        if (! Gate::allows('Deletar FAQs')) {
            return view('pages.not-authorized');
        }

        try{
            $faq = Faq::find($faq);
            $faq->delete();
            flash('FAQ deletado com sucesso!')->success();
            return redirect('/faqs');
        } catch (\Exception $exception) {
            flash('Erro ao deletar o FAQ!')->error();
            return redirect()->back()->withInput();
        }
    }
    //web


    public function faqs_web_index()
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $faqs = Faq::where('status', 'PUBLISHED')->orderBy('question', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 2)->first();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();

        $categories = ProjectCategory::orderBy('title', 'asc')->get();
        return view('web.faq.index', compact('categories', 'service_pages', 'institucional_pages', 'banner', 'faqs', 'unit', 'copyright', 'news', 'projects', 'leaderships', 'galleries'));
    }
}
