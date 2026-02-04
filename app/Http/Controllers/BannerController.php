<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BannerType;
use App\Models\Unit;
use App\Models\Copyright;
use App\Http\Requests\BannerRequest;
use App\Services\BannerService;
use App\Services\BannerCreateService;
use App\Services\BannerUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function __construct(
        protected BannerService $bannerService,
        protected BannerCreateService $bannerCreateService,
        protected BannerUpdateService $bannerUpdateService,
    ){}

    public function index(): View
    {

        if (! Gate::allows('Ver e Listar Banners')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $banner_types = BannerType::orderBy('title', 'asc')->get();

            return view('admin.banner.index', ['pageConfigs' => $pageConfigs], compact('banner_types', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Banner Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        BannerRequest $request, $type_id
    ){
        if (! Gate::allows('Editar Banner')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $request->validate([
                'title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $path = Storage::disk('banners')->put('image', $request->file( key:'image'));

            $bannerData = array_merge(
                $request->toArray(),
                [
                    'path'  => $path
                ]
            );

            $this->bannerUpdateService->update($bannerData, $type_id);

            flash('Banner editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }
}
