<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\phoneRequest;
use App\Models\Phone;
use App\Services\PeopleService;
use App\Services\PhoneService;
use App\Services\PhoneCreateService;
use App\Services\PhoneUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PhoneController extends Controller
{
    public function __construct(
        protected PeopleService $peopleService,
        protected PhoneService $phoneService,
        protected PhoneCreateService $phoneCreateService,
        protected PhoneUpdateService $phoneUpdateService,
    ){}

    public function index_people_phone($person_id): View
    {
        if (! Gate::allows('Ver e Listar Telefones')) {
            return view('pages.not-authorized');
        }

        try{
            $person = $this->peopleService->show($person_id);
            return view('admin.phone.people_phone', compact('person'));
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();
            flash('Erro ao procurar as Telefones Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        PhoneRequest $request
    ){
        if (! Gate::allows('Criar Telefones')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->phoneCreateService->create($request->toArray());

            flash('Telefone criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar novo telefone!')->error();
            return redirect()->back()->withInput();
        }
    }
    public function update(
        PhoneRequest $request
    ){
        if (! Gate::allows('Editar Telefones')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->phoneUpdateService->update($request->toArray());

            flash('Telefone editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar o telefone!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($phone)
    {
        if (! Gate::allows('Deletar Telefones')) {
            return view('pages.not-authorized');
        }

        try{
            $phone = Phone::find($phone);
            $phone->delete();
            flash('Telefone deletado com sucesso!')->success();
        } catch (\Exception $exception) {
            flash('Erro ao deletar o telefone!')->error();
        }
        return redirect()->back()->withInput();
    }
}
