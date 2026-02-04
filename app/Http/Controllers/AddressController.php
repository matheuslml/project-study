<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\City;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Services\AddressService;
use App\Services\AddressCreateService;
use App\Services\AddressUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Gate;

class AddressController extends Controller
{
    public function __construct(
        protected AddressService $addressService,
        protected AddressCreateService $addressCreateService,
        protected AddressUpdateService $addressUpdateService,
    ){}

    public function index($travel_id)
    {
        if (! Gate::allows('Ver e Listar Endereços')) {
            return view('pages.not-authorized');
        }

        try{
            $states = State::all();
            $cities = City::all();
            $countries = Country::all();
            //return view('admin.address', compact('travel', 'addresses', 'states', 'cities', 'countries'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Endereços Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($address_id)
    {
        if (! Gate::allows('Ver e Listar Endereços')) {
            return view('pages.not-authorized');
        }

        try{
            $states = State::all();
            $cities = City::all();
            $countries = Country::all();
            //return view('admin.travel.address_show', compact('states', 'cities', 'countries'));
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar o endereço!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        AddressRequest $request
    ){
        if (! Gate::allows('Criar Endereços')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->addressCreateService->create($request->toArray());

            flash('Endereço criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar novo endereço!')->error();

            return redirect()->back()->withInput();
        }
    }

    public function update(
        AddressRequest $request, $address_id
    ){
        if (! Gate::allows('Editar Endereços')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->addressTravelUpdateService->update($request->toArray(), $address_id);
            flash('Endereço editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar o endereço!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($address)
    {
        if (! Gate::allows('Deletar Endereços')) {
            return view('pages.not-authorized');
        }

        try{
            $address = Address::find($address);
            $address->delete();
            flash('Endereço deletado com sucesso!')->success();
        } catch (\Exception $exception) {
            flash('Erro ao deletar o endereço!')->error();
        }
        return redirect()->back()->withInput();
    }

    public function getCidades(int $idEstado): JsonResponse
    {
        $cidades = City::where('state_id', $idEstado)->orderBy('name')->get();
        return Response::json($cidades);
    }
}
