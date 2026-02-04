<?php

namespace App\Http\Controllers;

use App\Models\WebFooterLogo;
use App\Http\Requests\WebFooterLogoRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\WebFooter;
use App\Services\WebFooterLogoService;
use App\Services\WebFooterLogoCreateService;
use App\Services\WebFooterLogoUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Throwable;

class WebFooterLogoController extends Controller
{
    public function __construct(
        protected WebFooterLogoService $webFooterLogoService,
        protected WebFooterLogoCreateService $webFooterLogoCreateService,
        protected WebFooterLogoUpdateService $webFooterLogoUpdateService,
    ){}


    public function store(
        WebFooterLogoRequest $request
    ){

        if (! Gate::allows('Criar WebFooter')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $path_logo = Storage::disk('webfooters')->put('logos', $request->file( key:'logo'));

            $webFooterLogoData = array_merge(
                $request->toArray(),
                [
                    'logo_url'  => $path_logo
                ]
            );

            $this->webFooterLogoCreateService->create($webFooterLogoData);

            flash('Logo criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create_logo($web_footer_id)
    {

        if (! Gate::allows('Ver e Listar WebFooter')) {
            return view('pages.not-authorized');
        }

        try{
            $web_footer = WebFooter::find($web_footer_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.webfooter.logo_create', compact('web_footer', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar a imagem!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($web_footer_logo_id)
    {

        if (! Gate::allows('Ver e Listar WebFooter')) {
            return view('pages.not-authorized');
        }
        try{
            $web_footer_logo_selected = WebFooterLogo::find($web_footer_logo_id);
            $web_footer = WebFooter::whereRelation('logos', 'web_footer_id', $web_footer_logo_id)->first();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.webfooter.logo_show', compact('web_footer', 'unit', 'copyright', 'web_footer_logo_selected'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar a imagem!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        WebFooterLogoRequest $request, $web_footer_logo_id
    ){

        if (! Gate::allows('Ver e Listar WebFooter')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();


            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $path_logo = Storage::disk('webfooters')->put('logos', $request->file( key:'logo'));

            $webFooterLogoData = array_merge(
                $request->toArray(),
                [
                    'logo_url'  => $path_logo
                ]
            );

            $this->webFooterLogoUpdateService->update($webFooterLogoData, $web_footer_logo_id);

            flash('Galeria editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($webFooterLogo_id)
    {

        if (! Gate::allows('Deletar WebFooter')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = WebFooterLogo::find($webFooterLogo_id);
            $for_delete->delete();
            flash('WebFooter deletada com sucesso!')->success();
            return redirect('/webfooter_logos');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a WebFooter!')->error();
            return redirect()->back()->withInput();
        }
    }
}
