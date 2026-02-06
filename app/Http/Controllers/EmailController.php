<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use App\Models\Email;
use App\Services\PersonService;
use App\Services\EmailService;
use App\Services\EmailCreateService;
use App\Services\EmailUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class EmailController extends Controller
{
    public function __construct(
        protected PersonService $personService,
        protected EmailService $emailService,
        protected EmailCreateService $emailCreateService,
        protected EmailUpdateService $emailUpdateService,
    ){}

    public function index_person_email($person_id): View
    {
        if (! Gate::allows('Ver e Listar E-mails')) {
            return view('pages.not-authorized');
        }

        try{
            $person = $this->personService->show($person_id);
            return view('admin.email.person_email', compact('person'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar os e-mails Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        EmailRequest $request
    ){
        if (! Gate::allows('Criar E-mails')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->emailCreateService->create($request->toArray());

            flash('E-mail criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar novo e-mail!')->error();
            return redirect()->back()->withInput();
        }
    }
    public function update(
        EmailRequest $request
    ){
        if (! Gate::allows('Editar E-mails')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->emailUpdateService->update($request->toArray());

            flash('E-mail editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar o e-mail!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($email)
    {
        if (! Gate::allows('Deletar E-mails')) {
            return view('pages.not-authorized');
        }

        try{
            $email = Email::find($email);
            $email->delete();
            flash('E-mail deletado com sucesso!')->success();
        } catch (\Exception $exception) {
            flash('Erro ao deletar o e-mail!')->error();
        }
        return redirect()->back()->withInput();
    }
}
