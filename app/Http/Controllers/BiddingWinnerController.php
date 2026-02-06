<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiddingWinner;
use App\Http\Requests\BiddingWinnerRequest;
use App\Models\Bidding;
use App\Models\BlankPage;
use App\Models\City;
use App\Models\Country;
use App\Models\Genre;
use App\Models\MatrialStatus;
use App\Models\Person;
use App\Models\State;
use App\Models\TypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\PersonService;
use App\Services\BiddingWinnerService;
use App\Services\BiddingWinnerCreateService;
use App\Services\BiddingWinnerUpdateService;
use App\Services\BiddingItemUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BiddingWinnerController extends Controller
{

    public function __construct(
        protected PersonService $personService,
        protected BiddingWinnerService $biddingWinnerService,
        protected BiddingWinnerCreateService $biddingWinnerCreateService,
        protected BiddingWinnerUpdateService $biddingWinnerUpdateService,
        protected BiddingItemUpdateService $biddingItemUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $person = Person::whereDoesntHave('departaments')
                                        ->latest()
                                        ->get();
            return view('admin.bidding.winner_index', ['pageConfigs' => $pageConfigs], compact('person', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Assuntos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $genres = Genre::all();
        $matrial_statuses = MatrialStatus::all();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();

        return view('admin.bidding.winner_create', ['pageConfigs' => $pageConfigs], compact('genres', 'unit', 'copyright', 'matrial_statuses', 'countries', 'states', 'cities'));

    }

    public function store(
        BiddingWinnerRequest $request
    ){
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->biddingWinnerCreateService->create($request->toArray());

            flash('Vencedor criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($winner_id)
    {
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }
        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $genres = Genre::all();
            $matrial_statuses = MatrialStatus::all();
            $countries = Country::all();
            $states = State::all();
            $cities = City::all();

            $person = $this->personService->show($winner_id);
            $biddings_winner = BiddingWinner::where('person_id', $winner_id)
                                            ->latest()
                                            ->get();
            return view('admin.bidding.winner_show', compact('person', 'unit', 'copyright', 'biddings_winner', 'genres', 'matrial_statuses', 'countries', 'states', 'cities'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        BiddingWinnerRequest $request, $winner_id
    ){
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->biddingWinnerUpdateService->update($request->toArray(), $winner_id);

            flash('Vencedor editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($winner)
    {
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = BiddingWinner::find($winner);
            $bidding_id = $for_delete->bidding_id;
            $bidding = Bidding::find($bidding_id);
            $for_delete->delete();
            flash('Vencedor deletado com sucesso!')->success();
            return redirect('/licitacoes/' . $bidding->id);
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Winner!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function winner_add_itens(
        Request $request, $person_id
    ){
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            foreach($request['items'] as $key => $item_id){
                $fileData = array(
                    "person_id" => $person_id
                );
                $this->biddingItemUpdateService->update($fileData, $item_id);
            }
            flash('Item editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function winner_remove_itens(
        Request $request
    ){
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            foreach($request['remove_items'] as $key => $item_id){
                $fileData = array(
                    "person_id" => NULL
                );
                $this->biddingItemUpdateService->update($fileData, $item_id);
            }
            flash('Item editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function winner_itens($winner_id)
    {
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $genres = Genre::all();
            $matrial_statuses = MatrialStatus::all();
            $countries = Country::all();
            $states = State::all();
            $cities = City::all();

            $winner_selected = $this->biddingWinnerService->show($winner_id);
            return view('admin.bidding.winner_itens', compact('winner_selected', 'unit', 'copyright', 'genres', 'matrial_statuses', 'countries', 'states', 'cities'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }
        //site


    public function show_web($winner_id)
    {
        try{
            $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
            $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $type_requests = TypeRequest::all();
            $person = $this->personService->show($winner_id);
            return view('web.bidding.winner_show', compact('service_pages', 'institucional_pages', 'person', 'type_requests', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();

            return redirect()->back()->withInput();
        }
    }
}
