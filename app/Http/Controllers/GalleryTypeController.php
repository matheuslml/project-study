<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Services\GalleryTypeService;
use App\Services\GalleryTypeCreateService;
use App\Services\GalleryTypeUpdateService;
use App\Http\Requests\GalleryTypeRequest;
use App\Models\GalleryType;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Support\Facades\Gate;

class GalleryTypeController extends Controller
{
    public function __construct(
        protected GalleryTypeService $galleryTypeService,
        protected GalleryTypeCreateService $galleryTypeCreateService,
        protected GalleryTypeUpdateService $galleryTypeUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Editar Galeria')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $gallery_types = GalleryType::orderBy('slug', 'asc')->get();
            return view('admin.gallery.type_index', ['pageConfigs' => $pageConfigs], compact('gallery_types', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Galerias Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        GalleryTypeRequest $request
    ){
        if (! Gate::allows('Editar Galeria')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->galleryTypeCreateService->create($request->toArray());

            flash('Tipo de Galeria criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar novo Tipo de Galeria!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($type_id)
    {
        if (! Gate::allows('Editar Galeria')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $gallery_types = GalleryType::orderBy('slug', 'asc')->get();
            $type_selected = $this->galleryTypeService->show($type_id);
            return view('admin.gallery.type_show', compact('type_selected', 'gallery_types', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Galeria!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        GalleryTypeRequest $request, $type_id
    ){
        if (! Gate::allows('Editar Galeria')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->galleryTypeUpdateService->update($request->toArray(), $type_id);

            flash('Tipo de Galeria editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar o Tipo de Galeria!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($type)
    {
        if (! Gate::allows('Editar Galeria')) {
            return view('pages.not-authorized');
        }

        try{
            $type = GalleryType::find($type);
            $type->delete();
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $gallery_types = GalleryType::orderBy('slug', 'asc')->get();
            return view('admin.gallery.type_index', ['pageConfigs' => $pageConfigs], compact('gallery_types', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar o Tipo de Galeria!')->error();
            return redirect()->back()->withInput();
        }
    }



}
