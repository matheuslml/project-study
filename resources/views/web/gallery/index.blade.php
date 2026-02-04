@extends('layouts.web_base')

@section('content')
    <section class="section" style="width: 100%;">
        <div class="container">
            <div class="row mt-4 mb-4">
               <div class="col-lg-12 text-center my-2">
                   <h1>Nossa Galeria de Fotos</h1>
               </div>
            </div>
            <div class="portfolio-menu mt-2 mb-4">
               <ul>
                  <li class="btn btn-outline-dark active" data-filter="*">Todos</li>
                  @foreach ($gallery_types as $gallery_type)
                    <li class="btn btn-outline-dark" data-filter=".{{ $gallery_type->slug }}">{{ $gallery_type->title }}</li>
                  @endforeach
               </ul>
            </div>
            <div class="portfolio-item row">
                @foreach ($galleries as $gallery)
                    <div class="item {{ $gallery->gallery_type->slug }} col-lg-3 col-md-4 col-6 col-sm">
                       <a href="{{asset('storage/images/gallery/' . $gallery->image_large)}}" class="fancylight popup-btn" data-fancybox-group="light">
                       <img class="img-fluid" src="{{asset('storage/images/gallery/' . $gallery->image_small)}}" alt="">
                       </a>
                    </div>
                @endforeach
            </div>
            <div class="col-md-12" >

                <div class="d-flex justify-content-center" style="margin-top: 3%;">
                    {{ $galleries->links()}}
                </div>
            </div>
         </div>

    </section>
@endsection

@section('page-script')
<script src="{{ asset('assets-web/js/site/gallery.js') }}"></script>
@endsection
