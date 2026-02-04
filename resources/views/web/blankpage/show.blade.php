@extends('layouts.web_base')


@section('content')

    <section id="news">
        <div class="container">
            <div class="row mt-5">
                <!-- Projeto -->
                <div class="col-md-12">
                    <div class="">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <!-- Imagem -->
                                <div  style="position: relative;">
                                    <div style="width:100%; height: 100%">
                                        <img class="card-img-top shadow rounded border-0" src="{{asset('storage/images/blankpages/' . $page->image)}}" alt="Card image cap"
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
                                            {{$page->title}}
                                        </h1>
                                        <h4 class="ps-4 mt-5" style="font-size: 18px; color: #6d6d6d">{{$page->description}}</h4>
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
                                            {!! html_entity_decode($page->body, ENT_QUOTES, 'UTF-8') !!}
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

            </div>
        </div>
    </section>
@endsection
