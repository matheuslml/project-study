@extends('layouts.web_base')


@section('content')

    <section id="news">
        <div class="container">
            <div class="row mt-5">
                <!-- Projeto -->
                <div class="col-md-8">
                    <div class="">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <!-- Imagem -->
                                <div  style="position: relative;">
                                    <div style="width:100%; height: 100%">
                                        <img class="card-img-top shadow rounded border-0" src="{{asset('storage/images/news/' . $new->image)}}" alt="Card image cap"
                                        style="j
                                        max-width: 100%;
                                        height: 260px;
                                        object-fit: cover;
                                        border:solid 1px;
                                        border-color: #b9d9ba !important;
                                        ">
                                    </div>
                                </div>
                                <!-- Imagem FIM -->

                                <!-- Título -->
                                <div class="d-flex flex-column justify-content-center">
                                    <div class="mt-5 section-title text-start">
                                        <h1 class="mb-0 pb-0 text-center">
                                            {{$new->title}}
                                        </h1>
                                        <h4 class="ps-4 mt-5" style="font-size: 18px; color: #6d6d6d">{{$new->description}}</h4>
                                    </div>
                                </div>
                                <!-- Título FIM -->

                                <!-- Descrição -->
                                <!-- Descrição FIM -->
                                <div class="ps-4">
                                    <hr>
                                </div>
                                <!-- Conteúdo -->
                                <div class="px-5 mt-4">
                                    <div>
                                        <div class="px-4" style="font-size: 18px; letter-spacing:0.3px">
                                            {!! html_entity_decode($new->body, ENT_QUOTES, 'UTF-8') !!}
                                        </div>
                                    </div>
                                    <div class="ps-4">
                                        <hr style="width: 40px; height: 2px; color:#198754; opacity: 0.50;" class="mt-2">
                                    </div>
                                </div>
                                <!-- Conteúdo fim -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Projeto FIm -->

                <!-- Barra Lateral -->
                <div class="col-md-4">
                        <!-- Campo de Busca -->
                            <div class="rounded shadow-sm p-4 caixa-verde d-flex flex-column w-100 border-0" >
                                <div class="">
                                    <h3 class="fonte-verde-escuro title-font" style="font-size: 26px;">
                                        Buscar Noticias
                                    </h3>
                                    <hr class="mt-2 mb-0 "style="width: 20px; height: 1px; color:#198754; opacity: 0.50;">
                                </div>
                                <form class="col-md-12 m-0 d-flex flex-row mt-4">
                                    <div class="col-md-9 offset-md-1 pe-2">
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search"       style="height: 50px;" >
                                    </div>

                                    <div class="col-md-2">
                                    <button type="button" class="btn w-100" style="height: 49px; background-color: #3cb347; border-color: #279f32">
                                            <i class="fas fa-search" style="color: #fafffa;"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        <!-- Campo de Busca FIM -->

                        <!-- Ultimos Noticias -->
                        <div class="rounded shadow-sm p-4 caixa-verde mt-5 d-flex flex-column border-0" >
                            <div>
                                <h3 class="fonte-verde-escuro title-font" style="font-size: 26px;">
                                    Ultimas Noticias
                                </h3>
                                <hr class="mt-2 mb-0 "style="width: 20px; height: 1px; color:#198754; opacity: 0.50;">
                            </div>

                                @foreach($news as $new)
                                <div class="col-md-12 d-flex flex-column mt-4">
                                    <a href="{{ route('news_web_show', $new->id) }}">
                                        <div class="d-flex flex-row">
                                            <div class="col-md-4 offset-md-1 pe-2">
                                                <div>
                                                    <div style="position: relative;">
                                                        <div style="width:100%; height: 100%">
                                                            <img class="card-img-top shadow rounded" src="{{asset('storage/images/news/' . $new->image)}}" alt="Card image cap"
                                                            style="
                                                            max-width: 100%;
                                                            height: 80px;
                                                            object-fit: cover;
                                                            border:solid 1px;
                                                            border-color: #b9d9ba !important;
                                                            ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 ps-2 ">
                                                <div>
                                                    <h3 style="font-size: 14px; font-weight: 600">
                                                        {{$new->title}}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <div>
                                    <div class="d-flex flex-row align-items-center">
                                        <hr class="mb-0 "style="width: 100%; height: 1px; color:#198754; opacity: 0.20;">
                                    </div>
                                @endforeach

                        </div>
                        <!-- Ultimos Noticias -->
                </div>
                <!-- Barra Lateral FIM -->

            </div>
        </div>
    </section>
@endsection
