<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\GalleryRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\GalleryType;
use App\Models\Leadership;
use App\Models\News;
use App\Models\Project;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\ProjectCategory;
use App\Models\WebFooter;
use App\Services\GalleryService;
use App\Services\GalleryCreateService;
use App\Services\GalleryUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Throwable;

class GalleryController extends Controller
{
    public function __construct(
        protected GalleryService $galleryService,
        protected GalleryCreateService $galleryCreateService,
        protected GalleryUpdateService $galleryUpdateService,
    ){}

    public function index(): View
    {

        if (! Gate::allows('Ver e Listar Galeria')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $galleries = Gallery::all();
            $gallery_types = GalleryType::orderBy('slug', 'asc')->get();
            return view('admin.gallery.index', ['pageConfigs' => $pageConfigs], compact('galleries', 'unit', 'copyright', 'gallery_types'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Imagens da Galeria Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        GalleryRequest $request
    ){

        if (! Gate::allows('Criar Galeria')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();

            $request->validate([
                'title' => 'required',
                'image_small' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image_large' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $path_image_small = Storage::disk('gallery')->put('small', $request->file( key:'image_small'));
            $path_image_large = Storage::disk('gallery')->put('large', $request->file( key:'image_large'));

            $galleryData = array_merge(
                $request->toArray(),
                [
                    'image_small'  => $path_image_small,
                    'image_large'  => $path_image_large
                ]
            );

            $this->galleryCreateService->create($galleryData);

            flash('Galeria criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($gallery_id)
    {

        if (! Gate::allows('Ver e Listar Galeria')) {
            return view('pages.not-authorized');
        }

        try{
            $gallery = $this->galleryService->show($gallery_id);

            $gallery_types = GalleryType::orderBy('slug', 'asc')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.gallery.show', compact('gallery', 'unit', 'copyright', 'gallery_types'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar a imagem!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        GalleryRequest $request, $gallery_id
    ){

        if (! Gate::allows('Editar Galeria')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            if(isset($request['image_small']) && isset($request['image_large'])){
                $request->validate([
                    'title' => 'required',
                    'image_small' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'image_large' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $path_image_small = Storage::disk('gallery')->put('small', $request->file( key:'image_small'));
                $path_image_large = Storage::disk('gallery')->put('large', $request->file( key:'image_large'));

                $galleryData = array_merge(
                    $request->toArray(),
                    [
                        'image_small'  => $path_image_small,
                        'image_large'  => $path_image_large
                    ]
                );

                $this->galleryUpdateService->update($galleryData, $gallery_id);
            }
            else{
                if(isset($request['image_small'])){
                    $request->validate([
                        'title' => 'required',
                        'image_small' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ]);

                    $path_image_small = Storage::disk('gallery')->put('small', $request->file( key:'image_small'));

                    $galleryData = array_merge(
                        $request->toArray(),
                        [
                            'image_small'  => $path_image_small
                        ]
                    );

                    $this->galleryUpdateService->update($galleryData, $gallery_id);

                }
                elseif(isset($request['image_large'])){
                    $request->validate([
                        'title' => 'required',
                        'image_large' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ]);

                    $path_image_large = Storage::disk('gallery')->put('large', $request->file( key:'image_large'));

                    $galleryData = array_merge(
                        $request->toArray(),
                        [
                            'image_large'  => $path_image_large
                        ]
                    );

                    $this->galleryUpdateService->update($galleryData, $gallery_id);

                }else{

                    $this->galleryUpdateService->update($request->toArray(), $gallery_id);

                }
            }

            flash('Galeria editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($gallery_id)
    {

        if (! Gate::allows('Deletar Galeria')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = Gallery::find($gallery_id);
            $for_delete->delete();
            flash('Galeria deletada com sucesso!')->success();
            return redirect('/galeria_imagens');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Galeria!')->error();
            return redirect()->back()->withInput();
        }
    }
    //web


    public function gallery_web_index()
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $banner = Banner::where('banner_type_id', 13)->first();
        $galleries = Gallery::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(12);
        $gallery_types = GalleryType::orderBy('slug', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();

        $categories = ProjectCategory::orderBy('title', 'asc')->get();
        return view('web.gallery.index', compact('categories', 'service_pages', 'institucional_pages', 'web_footer', 'banner', 'galleries','unit', 'copyright', 'news', 'projects', 'leaderships', 'gallery_types'));
    }
}
