<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiddingAgreement;
use App\Http\Requests\BiddingAgreementRequest;
use App\Models\AgreementOrigin;
use App\Models\AgreementSituation;
use App\Models\AgreementType;
use App\Models\Banner;
use App\Models\Bidding;
use App\Models\BiddingAgreementFile;
use App\Models\BlankPage;
use App\Models\DocumentType;
use App\Models\News;
use App\Models\Person;
use App\Models\Project;
use App\Models\TypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\BiddingAgreementService;
use App\Services\BiddingAgreementCreateService;
use App\Services\BiddingAgreementUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BiddingAgreementController extends Controller
{

    public function __construct(
        protected BiddingAgreementService $biddingAgreementService,
        protected BiddingAgreementCreateService $biddingAgreementCreateService,
        protected BiddingAgreementUpdateService $biddingAgreementUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Contratos')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $agreements = BiddingAgreement::with('bidding')
                                        ->latest()
                                        ->get();
            return view('admin.bidding.agreement_index', ['pageConfigs' => $pageConfigs], compact('agreements', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Contratos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Criar Contratos')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $origins = AgreementOrigin::with('agreements')->orderBy('title', 'asc')->get();
        $types = AgreementType::with('agreements')->orderBy('title', 'asc')->get();
        $situations = AgreementSituation::with('agreements')->orderBy('title', 'asc')->get();
        $document_types = DocumentType::all();
        $biddings = Bidding::all();

        //$modalities = BiddingAgreementModality::with('biddingAgreements')->orderBy('title', 'asc')->get();
        //$situations = BiddingAgreementSituation::with('biddingAgreements')->orderBy('title', 'asc')->get();

        return view('admin.bidding.agreement_create', ['pageConfigs' => $pageConfigs], compact('biddings', 'unit', 'copyright', 'origins', 'types', 'situations', 'document_types'));

    }

    public function store(
        BiddingAgreementRequest $request
    ){
        if (! Gate::allows('Criar Contratos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $this->biddingAgreementCreateService->create($request->toArray());

            flash('Contrato criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($bidding_agreement_id)
    {
        if (! Gate::allows('Ver e Listar Contratos')) {
            return view('pages.not-authorized');
        }

        try{
            $agreement = $this->biddingAgreementService->show($bidding_agreement_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $agreement_files = BiddingAgreement::find($bidding_agreement_id)->files()->paginate(10);
            $origins = AgreementOrigin::with('agreements')->orderBy('title', 'asc')->get();
            $types = AgreementType::with('agreements')->orderBy('title', 'asc')->get();
            $situations = AgreementSituation::with('agreements')->orderBy('title', 'asc')->get();
            $document_types = DocumentType::all();
            $biddings = Bidding::all();

            return view('admin.bidding.agreement_show', compact('agreement', 'unit', 'copyright', 'agreement_files', 'biddings', 'origins', 'types', 'situations', 'document_types' ));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        BiddingAgreementRequest $request, $agreement_id
    ){
        if (! Gate::allows('Editar Contratos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->biddingAgreementUpdateService->update($request->toarray(), $agreement_id);

            flash('Contrato editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($agreement_id)
    {
        if (! Gate::allows('Deletar Contratos')) {
            return view('pages.not-authorized');
        }

        try{
            $bidding_agreement = BiddingAgreement::find($agreement_id);
            $bidding_agreement->delete();
            flash('Contrato deletado com sucesso!')->success();
            return redirect('/licitacao_contratos');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Contrato!')->error();
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
        $banner = Banner::where('banner_type_id', 9)->first();
        $type_requests = TypeRequest::all();
        $origins = AgreementOrigin::all();
        $types = AgreementType::all();
        $situations = AgreementSituation::all();
        $agreements = BiddingAgreement::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(10);
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        return view('web.agreement.index', compact('service_pages', 'institucional_pages', 'banner', 'agreements', 'origins', 'types', 'situations', 'unit', 'copyright', 'type_requests', 'news', 'projects'));
    }

    public function web_index_filter(Request $request)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 9)->first();
        $type_requests = TypeRequest::all();
        $types = AgreementType::all();
        $origins = AgreementOrigin::all();
        $situations = AgreementSituation::all();
        $agreements = BiddingAgreement::filter($request->all())->where('status', 'PUBLISHED')->paginate(5);
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        return view('web.agreement.index', compact('service_pages', 'institucional_pages', 'banner', 'agreements', 'origins', 'types', 'situations', 'unit', 'copyright', 'type_requests', 'news', 'projects'));
    }

    public function show_web($bidding_agreement_id): View
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $type_requests = TypeRequest::all();
        try{
            $bidding_agreement = $this->biddingAgreementService->show($bidding_agreement_id);
            $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
            $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
            $agreement_files = BiddingAgreementFile::where('bidding_agreement_id', $bidding_agreement_id)->paginate(10);

            return view('web.agreement.show', compact('service_pages', 'institucional_pages', 'bidding_agreement', 'agreement_files', 'unit', 'copyright', 'type_requests', 'news', 'projects'));
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();
            return redirect()->back()->withInput();
        }
    }

}
