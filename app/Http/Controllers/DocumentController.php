<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\DocumentResource;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Services\PersonService;
use App\Services\DocumentService;
use App\Services\DocumentCreateService;
use App\Services\DocumentUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DocumentController extends Controller
{
    public function __construct(
        protected PersonService $personService,
        protected DocumentService $documentService,
        protected DocumentCreateService $documentCreateService,
        protected DocumentUpdateService $documentUpdateService,
    ){}

    public function index_person_document($person_id): View
    {
        if (! Gate::allows('Ver e Listar Documentos')) {
            return view('pages.not-authorized');
        }

        try{
            $type_documents = DocumentType::all();
            $person = $this->personService->show($person_id);
            return view('admin.document.person_document', compact('person', 'type_documents'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar os Documentos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }
    
    public function update(
        DocumentRequest $request
    ){
        if (! Gate::allows('Editar Documentos')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->documentUpdateService->update($request->toArray());
            flash('Documento editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();            
            flash('Erro ao editar o documento!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        DocumentRequest $request
    ){
        if (! Gate::allows('Criar Documentos')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->documentCreateService->create($request->toArray());

            flash('Documento criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar novo documento!')->error();
            return redirect()->back()->withInput();
        }
    }
    

    public function destroy($document)
    {
        if (! Gate::allows('Deletar Documentos')) {
            return view('pages.not-authorized');
        }

        try{
            $document = Document::find($document);
            $document->delete();
            flash('Unidade deletado com sucesso!')->success();
        } catch (\Exception $exception) {
            flash('Erro ao deletar a unidade!')->error();
        }
        return redirect()->back()->withInput();
    }
}
