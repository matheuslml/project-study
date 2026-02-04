<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Http\Requests\AboutRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\Gallery;
use App\Models\Leadership;
use App\Models\News;
use App\Models\Project;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\AboutService;
use App\Services\AboutCreateService;
use App\Services\AboutUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Throwable;

class AboutController extends Controller
{
    public function __construct(
        protected AboutService $aboutService,
        protected AboutCreateService $aboutCreateService,
        protected AboutUpdateService $aboutUpdateService,
    ){}

    public function create(): View
    {

        if (! Gate::allows('Ver e Listar Sobre')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $units = Unit::all();
            return view('admin.about.create', ['pageConfigs' => $pageConfigs], compact('units', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Unidades Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        AboutRequest $request
    ){

        if (! Gate::allows('Editar Sobre')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $path_image = Storage::disk('about')->put('image', $request->file( key:'image'));

            $galleryData = array_merge(
                $request->toArray(),
                [
                    'image'  => $path_image,
                    'body'  => $request['content']
                ]
            );

            $this->aboutCreateService->create($galleryData);

            flash('Criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($about_id)
    {

        if (! Gate::allows('Ver e Listar Sobre')) {
            return view('pages.not-authorized');
        }

        try{
            $about = $this->aboutService->show($about_id);
            $units = Unit::all();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            return view('admin.about.show', compact('about', 'units', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        AboutRequest $request, $about_id
    ){

        if (! Gate::allows('Editar Sobre')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();

            if(isset($request['image'])){
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $path_image = Storage::disk('about')->put('image', $request->file( key:'image'));

                $aboutData = array_merge(
                    $request->toArray(),
                    [
                        'image'  => $path_image,
                        'body'  => $request['content']
                    ]
                );
            }
            else{

                $aboutData = array_merge(
                    $request->toArray(),
                    [
                        'body'  => $request['content']
                    ]
                );

            }

            $this->aboutUpdateService->update($aboutData, $about_id);

            flash('Editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){

            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($about_id)
    {

        if (! Gate::allows('Deletar Sobre')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = About::find($about_id);
            $for_delete->delete();
            flash('Deletada com sucesso!')->success();
            return redirect('/sobres');
        } catch (\Exception $exception) {
            flash('Erro ao deletar!')->error();
            return redirect()->back()->withInput();
        }
    }


    //web


    public function about_web_index ()
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 12)->first();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        return view('web.about.index', compact('service_pages' , 'institucional_pages', 'banner', 'unit', 'copyright', 'news', 'projects', 'leaderships', 'galleries'));
    }
}
