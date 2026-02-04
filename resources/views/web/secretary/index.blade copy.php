@extends('layouts.web_base')

@section('page-style')

<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css"
  rel="stylesheet"
/>

@endsection


@section('content')

    <section id="conservation_units">
        <div class="container">
            <div class="row mt-5">
                <!-- Projeto -->
                <div class="col-md-8 mb-5">
                    <div class="">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <!-- Imagem -->
                                <div style="position: relative;">
                                    <div style="width:100%; height: 100%">
                                        <img class="card-img-top shadow rounded" src="{{asset('storage/images/conservation_units/thumbs/KbdLD2z5aLAugdQLR6X4PIpcq7hZinC1GakWnuZv.jpg')}}" alt="Card image cap"
                                        style="
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
                                            A Secretaria do  Meio Ambiente
                                        </h1>
                                    </div>
                                </div>
                                <!-- Título FIM -->
                                <!-- Conteúdo -->
                                <div class="px-4">
                                    <div>
                                        <div class="">
                                            <p style="font-size: 16px">
                                                A Secretaria Municipal do Ambiente e Saneamento faz parte da Administração Pública Direta Municipal  vinculada à Prefeitura Municipal.
                                            <br>
                                                Possui a compete de propor e executar as políticas municipais de meio ambiente e saneamento adotadas pelos poderes Executivo e Legislativo do Município de Arraial do Cabo.
                                            <br>
                                            <br>
                                                A Secretaria integra o Sistema Nacional do Meio Ambiente (SISNAMA), o Sistema Nacional de Gerenciamento de Recursos Hídricos (SNGRH), o Sistema Estadual de Gerenciamento de Recursos Hídricos (SEGRH) e o Sistema Nacional de Unidades de Conservação (SNUC) e o Sistema Nacional de Saneamento Básico.
                                            <br>
                                                Sendo orientada por um conjunto de normas de conduta que, manifestadas na missão, visão e valores determinam o seu comportamento funcional.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ps-4 mt-0">
                                        <hr style="width: 40px; height: 2px; color:#198754; opacity: 0.50;" class="mt-3">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center mt-5">
                                        <div class=" section-title text-start">
                                            <h2 class="mb-0 pb-0 text-center" style="font-size: 25px">
                                                <strong>Princípios</strong>
                                            </h2>
                                        </div>
                                    </div>
                                    <!-- Pills navs -->
                                    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                                        <li class="nav-item" role="presentation">
                                        <a
                                            class="nav-link active border border-primary"
                                            id="ex3-tab-1"
                                            data-mdb-toggle="pill"
                                            href="#ex3-pills-1"
                                            role="tab"
                                            aria-controls="ex3-pills-1"
                                            aria-selected="true"


                                            >Missão</a
                                        >
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <a
                                            class="nav-link border border-primary"
                                            id="ex3-tab-2"
                                            data-mdb-toggle="pill"
                                            href="#ex3-pills-2"
                                            role="tab"
                                            aria-controls="ex3-pills-2"
                                            aria-selected="false"
                                            ><strong>Visão</strong></a
                                        >
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <a
                                            class="nav-link border border-primary"
                                            id="ex3-tab-3"
                                            data-mdb-toggle="pill"
                                            href="#ex3-pills-3"
                                            role="tab"
                                            aria-controls="ex3-pills-3"
                                            aria-selected="false"
                                            ><strong>Valores</strong></a
                                        >
                                        </li>
                                    </ul>
                                    <!-- Pills navs -->

                                    <!-- Pills content -->
                                    <div class="tab-content" id="ex2-content">
                                        <div
                                        class="tab-pane fade show active text-center px-5"
                                        id="ex3-pills-1"
                                        role="tabpanel"
                                        aria-labelledby="ex3-tab-1"
                                        >
                                        Promover a preservação, a conservação e a recuperação dos ecossistemas, desenvolvendo e implementando as políticas públicas relativas à qualidade ambiental, à biodiversidade, aos recursos hídricos e ao saneamento, visando à manutenção do equilíbrio ecológico, ao uso racional dos recursos naturais, à qualidade de vida e ao desenvolvimento sustentável, para as gerações presentes e futuras.
                                        </div>
                                        <div
                                        class="tab-pane fade text-center px-5"
                                        id="ex3-pills-2"
                                        role="tabpanel"
                                        aria-labelledby="ex3-tab-2"
                                        >
                                        Ser referência na gestão das políticas públicas de meio ambiente, saneamento e recursos hídricos da Região dos Lagos
                                        </div>
                                        <div
                                        class="tab-pane fade text-center px-5"
                                        id="ex3-pills-3"
                                        role="tabpanel"
                                        aria-labelledby="ex3-tab-3"
                                        >
                                        Governança.
                                        Integridade.
                                        Eficiência.
                                        <br>
                                        Transparência.
                                        Inovação.
                                        Participação
                                        Social.
                                        <br>
                                        Responsabilidade Compartilhada.
                                        </div>
                                    </div>
                                    <!-- Pills content -->
                                </div>
                                <!-- Conteúdo fim -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Unidade de Conservação FIm -->

                <!-- Barra Lateral -->
                <div class="col-md-4">
                        <!-- Campo de Busca -->
                            <div class="rounded shadow-sm p-4 caixa-verde d-flex flex-column w-100" >
                                <div class="">
                                    <h3 class="fonte-verde-escuro title-font" style="font-size: 18px;">
                                        <strong>Buscar Notícias</strong>
                                    </h3>
                                    <hr class="mt-2 mb-0 "style="width: 20px; height: 1px; color:#198754; opacity: 0.50;">
                                </div>
                                <form class="col-md-12 m-0 d-flex flex-row mt-4">
                                    <div class="col-md-10 pe-2">
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

                        <!-- Ultimos Unidade de Conservação -->
                        <div class="rounded shadow-sm p-4 caixa-verde mt-5 d-flex flex-column" >
                            <div>
                                <h3 class="fonte-verde-escuro title-font" style="font-size: 18px;">
                                    <strong>Ultimas Notícias</strong>
                                </h3>
                                <hr class="mt-2 mb-0 "style="width: 20px; height: 1px; color:#198754; opacity: 0.50;">
                            </div>


                                <a href="" style="text-decoration: none">
                                <div class="col-md-12 d-flex flex-column mt-4">
                                    <div class="d-flex flex-row">

                                            <div class="col-md-4 pe-2">
                                                <div>
                                                    <div style="position: relative;">
                                                        <div style="width:100%; height: 100%">
                                                            <img class="card-img-top shadow rounded" src="{{asset('storage/images/conservation_units/KbdLD2z5aLAugdQLR6X4PIpcq7hZinC1GakWnuZv.jpg')}}" alt="Card image cap"
                                                            style="
                                                            max-width: 100%;
                                                            height: 70px;
                                                            object-fit: cover;
                                                            border:solid 1px;
                                                            border-color: #b9d9ba !important;
                                                            ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 ps-2 ">
                                                <div class="fonte-verde-escuro">
                                                    <h3 style="font-size: 14px; font-weight: 600">
                                                        #
                                                    </h3>
                                                </div>
                                                <div style="font-size: 12px;">
                                                    <p>
                                                        #
                                                    </p>
                                                </div>
                                            </div>

                                    </div>
                                <div>
                                </a>
                                    <div class="d-flex flex-row align-items-center">
                                        <hr class="mb-0 "style="width: 100%; height: 1px; color:#198754; opacity: 0.20;">
                                    </div>

                        </div>
                        <!-- Ultimos Unidade de Conservação -->
                </div>
                <!-- Barra Lateral FIM -->

            </div>
        </div>
    </section>
@endsection
@section('page-script')

<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"
></script>

@endsection
