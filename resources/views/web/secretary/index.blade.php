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

                                <!-- Título -->
                                <div class="d-flex flex-column justify-content-center">
                                    <div class="mt-5 section-title text-start">
                                        <h1 class="mb-0 pb-0 text-center">
                                            Licenciamento Ambiental
                                        </h1>
                                    </div>
                                </div>
                                <!-- Título FIM -->
                                <!-- Conteúdo -->
                                <div class="px-4">
                                    <div class="p-5">
                                        <div class="">
                                            <p style="font-size: 16px">
                                                O licenciamento ambiental é o procedimento administrativo por meio do qual a Secretaria faz o necessário controle sobre empreendimentos ou atividades que utilizam recursos naturais ou que possam causar, sob qualquer forma, algum tipo de poluição ou degradação ao meio ambiente.
                                                <br>
                                                <br>
                                                No Município de Arraial, os procedimentos de licenciamento são regidos pelo Sistema Municipal de Licenciamento Ambiental e demais Procedimentos de Controle Ambiental, tendo a Lei Municipal 1.544/07 juntamente com a Resolução conjunta SEMAS/SECOU Nº 001/22.
                                        </div>
                                        <div class="ps-4 mt-0">
                                            <hr style="width: 40px; height: 2px; color:#198754; opacity: 0.50;" class="mt-3">
                                        </div>
                                        <div>
                                            <p>
                                                Após a concessão das licenças ou demais tipos de instrumentos de controle ambiental, a Secretaria faz o acompanhamento dessas atividades e empreendimentos, visando garantir o efetivo cumprimento das exigências e condicionantes durante a vigência das autorizações concedidas. Nesta etapa, chamada pós-licença, a secretaria integra informações do monitoramento com as ferramentas de gestão e programas de autocontrole.
                                            </p>
                                        </div>
                                    </div>


                                    <div style="background-color:#d9ffd8; border-color:#279f32" class="rounded p-5">
                                        <p>
                                            A fiscalização das atividades licenciadas ou autorizadas poderá ocorrer no decorrer de todo o processo de licenciamento e na etapa de pós-licença, bem como após seu encerramento, visando atendimento às normas ambientais e promoção da recuperação de eventual passivo.
                                            <br>
                                            <br>
                                            Além disso, serão objeto de fiscalização pelo órgão ambiental as atividades irregulares, ou seja, aquelas que deveriam ser objeto de instrumento de controle ambiental (licenças, autorizações etc.) mas não se encontram respaldadas pelos devidos instrumentos, ou que violem demais normas ambientais.
                                            <br>
                                            <br>
                                            A lei que estabelece as infrações ambientais administrativas no âmbito do Estado do Rio de Janeiro é a Lei Estadual nº 3.467/2000, e em nível municipal o Decreto de nº 1.826/2010 fundamenta a aplicação de sanções administrativas pela Secretaria.
                                        </p>
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
