@extends('layouts.web_base')


@section('content')

    <section id="projects">
        <div class="container">
            <div class="row mt-5">
                <!-- Projeto -->
                <div class="col-md-8">
                    <div class="">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <!-- Imagem -->
                                <div style="position: relative;">
                                    <div style="width:100%; height: 100%">
                                        <img class="card-img-top shadow rounded border-0" src="{{asset('storage/images/projects/' . $project->thumb)}}" alt="Card image cap"
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
                                            {{$project->title}}
                                        </h1>
                                    </div>
                                </div>
                                <!-- Título FIM -->
                                <div class="ps-4">
                                    <hr style="width: 40px; height: 2px; color:#198754; opacity: 0.50;" class="">
                                </div>
                                <!-- Conteúdo -->
                                <div>
                                    <div class="px-4">
                                        {!! html_entity_decode($project->body, ENT_QUOTES, 'UTF-8') !!}
                                    </div>
                                </div>
                                <div class="ps-4">
                                    <hr style="width: 40px; height: 2px; color:#198754; opacity: 0.50;" class="mt-2">
                                </div>
                                <!-- Conteúdo fim -->
                            </div>
                            <div class="row">
                                <!-- Download Pdf -->
                                <div class="d-flex align-items-center justify-content-center flex-column rounded border-0" style="border-right: solid 1px; border-color:#19875438;">
                                   <div class="text-center">
                                        <h3 class="my-5 py-2 px-5 rounded caixa-verde text-center" style="border-left: 0px; border-right:0px; font-weight:400;">
                                            PDF's do Projeto
                                        </h3>
                                    </div>
                                    <div  class="d-inline-flex mx-4">
                                        @foreach($project->files as $file)
                                        <a href="{{ route('file_web', $file->id) }}"
                                            style="
                                                text-decoration: none;
                                                font-weight: 500;

                                            ">
                                        <div class="d-flex align-items-center flex-column px-3 mx-2">
                                            <div class="shadow">
                                                <i class="far fa-file-pdf fa-4x" style="color: #d55151" >
                                                </i>
                                            </div>
                                            <p class="mt-3 text-center" style="width: 130px; font-size: 16px; font-weight: 600;">
                                                    {{$file->title}}
                                            </p>
                                        </div>
</a>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Download Pdf FIM -->
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
                                        Buscar Projetos
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

                        <!-- Ultimos Projetos -->
                        <div class="rounded shadow-sm p-4 caixa-verde mt-5 d-flex flex-column border-0" >
                            <div>
                                <h3 class="fonte-verde-escuro title-font" style="font-size: 26px;">
                                    Ultimos Projetos
                                </h3>
                                <hr class="mt-2 mb-0 "style="width: 20px; height: 1px; color:#198754; opacity: 0.50;">
                            </div>

                                @foreach($projects as $project)
                                <div class="col-md-12 d-flex flex-column mt-4">
                                    <div class="d-flex flex-row">
                                        <div class="col-md-4 offset-md-1 pe-2">
                                            <div>
                                                <div style="position: relative;">
                                                    <div style="width:100%; height: 100%">
                                                        <img class="card-img-top shadow rounded" src="{{asset('storage/images/projects/' . $project->thumb)}}" alt="Card image cap"
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
                                                <h3 style="font-size: 16px; font-weight: 600">
                                                    {{$project->title}}
                                                </h3>
                                            </div>
                                            <div class="">
                                                <p>
                                                    {{$project->sub_title}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <div>
                                    <div class="d-flex flex-row align-items-center">
                                        <hr class="mb-0 "style="width: 100%; height: 1px; color:#198754; opacity: 0.20;">
                                    </div>
                                @endforeach

                        </div>
                        <!-- Ultimos Projetos -->
                </div>
                <!-- Barra Lateral FIM -->

            </div>
        </div>
    </section>
@endsection
