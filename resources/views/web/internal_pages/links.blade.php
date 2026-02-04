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

<style id="links">
    .btn:not(:disabled):not(.disabled) {
        cursor: pointer;
    }
    .btn-a-brc-tp:not(.disabled):not(:disabled).active, .btn-brc-tp, .btn-brc-tp:focus:not(:hover):not(:active):not(.active):not(.dropdown-toggle), .btn-h-brc-tp:hover, .btn.btn-f-brc-tp:focus, .btn.btn-h-brc-tp:hover {
        border-color: transparent;
    }
    .btn-outline-blue {
        color: #0d6ce1;
        border-color: #5a9beb;
        background-color: transparent;
    }
    .btn {
        cursor: pointer;
        position: relative;
        z-index: auto;
        border-radius: .175rem;
        transition: color .15s,background-color .15s,border-color .15s,box-shadow .15s,opacity .15s;
    }
    .border-2 {
        border-width: 2px!important;
        border-style: solid!important;
        border-color: transparent;
    }
    .bgc-white {
        background-color: #fff!important;
    }


    .text-green-d1 {
        color: #277b5d!important;
    }
    .letter-spacing {
        letter-spacing: .5px!important;
    }
    .font-bolder, .text-600 {
        font-weight: 600!important;
    }
    .text-170 {
        font-size: 1.7em!important;
    }

    .text-purple-d1 {
        color: #6d62b5!important;
    }

    .text-primary-d1 {
        color: #276ab4!important;
    }
    .text-secondary-d1 {
        color: #5f718b!important;
    }
    .text-180 {
        font-size: 1.8em!important;
    }
    .text-150 {
        font-size: 1.5em!important;
    }
    .text-danger-m3 {
        color: #e05858!important;
    }
    .rotate-45 {
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .position-l {
        left: 0;
    }
    .position-b, .position-bc, .position-bl, .position-br, .position-center, .position-l, .position-lc, .position-r, .position-rc, .position-t, .position-tc, .position-tl, .position-tr {
        position: absolute!important;
        display: block;
    }
    .mt-n475, .my-n475 {
        margin-top: -2.5rem!important;
    }
    .ml-35, .mx-35 {
        margin-left: 1.25rem!important;
    }

    .text-dark-l1 {
        color: #56585e!important;
    }
    .text-90 {
        font-size: .9em!important;
    }
    .text-left {
        text-align: left!important;
    }

    .mt-25, .my-25 {
        margin-top: .75rem!important;
    }

    .text-110 {
        font-size: 1.1em!important;
    }

    .deleted-text{
    text-decoration:line-through;;
    }
</style>

@endsection


@section('content')

    <section class="title-section">
        <div class="container">
            <h2>Telefones Úteis</h2>
            <div class="col-md-6 pt-0 mt-0">
                <h3>Lista de Telefones Úteis</h3>
            </div>
        </div>
        <div class="container">
            <div class="mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <!-- link -->
                        <div class="d-style btn btn-brc-tp w-100">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8">
                                    <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                        Centro Integrado de Segurança Pública
                                    </h4>

                                    <div class="text-secondary-d1 text-120">
                                        <span class="text-180">22 99700 0311</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 text-center">
                                    <a href="#" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- link -->
                        <div class="d-style btn btn-brc-tp w-100">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8">
                                    <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                        CIOSP - Animais na pista
                                    </h4>

                                    <div class="text-secondary-d1 text-120">
                                        <span class="text-180">22 99700 0311</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 text-center">
                                    <a href="#" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- link -->
                        <div class="d-style btn btn-brc-tp w-100">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8">
                                    <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                        Defesa Civil
                                    </h4>

                                    <div class="text-secondary-d1 text-120">
                                        <span class="text-180">22 98123 1182</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 text-center">
                                    <a href="#" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- link -->
                        <div class="d-style btn btn-brc-tp w-100">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8">
                                    <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                        Guarda Ambiental
                                    </h4>

                                    <div class="text-secondary-d1 text-120">
                                        <span class="text-180">22 99936 1255</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 text-center">
                                    <a href="#" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- link -->
                        <div class="d-style btn btn-brc-tp w-100">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8">
                                    <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                        Posturas
                                    </h4>

                                    <div class="text-secondary-d1 text-120">
                                        <span class="text-180">22 99705-5026</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 text-center">
                                    <a href="#" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- link -->
                        <div class="d-style btn btn-brc-tp w-100">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8">
                                    <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                        PROCON
                                    </h4>

                                    <div class="text-secondary-d1 text-120">
                                        <span class="text-180">22 2622 1417</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 text-center">
                                    <a href="#" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- link -->
                        <div class="d-style btn btn-brc-tp w-100">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8">
                                    <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                        Pronto Socorro de Figueira
                                    </h4>

                                    <div class="text-secondary-d1 text-120">
                                        <span class="text-180">22 3199 0292</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 text-center">
                                    <a href="#" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- link -->
                        <div class="d-style btn btn-brc-tp w-100">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8">
                                    <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                        Pronto Socorro de Figueira (whatsapp)
                                    </h4>

                                    <div class="text-secondary-d1 text-120">
                                        <span class="text-180">22 99896 6283</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 text-center">
                                    <a href="#" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- link -->
                        <div class="d-style btn btn-brc-tp w-100">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8">
                                    <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                        Resgate Hospital
                                    </h4>

                                    <div class="text-secondary-d1 text-120">
                                        <span class="text-180">0800 880 2111</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 text-center">
                                    <a href="#" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
