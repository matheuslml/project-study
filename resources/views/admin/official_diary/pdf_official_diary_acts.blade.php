<!doctype html>
<html dir="ltr" lang="en-US">
    <head>
        <meta charset="utf-8">
        <link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800'
    rel='stylesheet' type='text/css'><style>
            /* Define the margins of your page */
            @page {
                margin: 90px 25px;
            }
            .row {
                width: 100%;
                display: inline-block;
                clear:both;
            }

            .col {
                position: relative;
                float: left;
            }

            .col-1 {
                width: 10%;
            }

            .col-2 {
                width: 20%;
            }

            .col-3 {
                width: 30%;
            }

            .col-4 {
                width: 40%;
            }

            .col-5 {
                width: 50%;
            }

            .col-6 {
                width: 60%;
            }

            .col-7 {
                width: 70%;
            }

            .col-8 {
                width: 80%;
            }

            .col-9 {
                width: 90%;
            }

            .col-10 {
                width: 100%;
            }
            /*Partes do PDF*/
            header {
                position: fixed;
                top: -70px;
                left: 0px;
                right: 0px;
                height: 50px;
                margin-bottom:10px;

                /* Extra personal styles */
                line-height: 35px;
            }

            footer {
                padding: 0;
                margin: 0;
                position: fixed;
                bottom: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                /* Extra personal styles */
                border-top:1px solid #000;
                color: #000;
                text-align: center;
                line-height: 35px;
            }

            .summary {
                width: 210mm;
                height: 240mm;
            }

            /*Geral MAIN*/
            .title-sup p{
                font-family: "Montserrat", sans-serif;
                margin: 0;
                padding: 1% 0 0 0;
                font-size: 15px;
                line-height: 1.2;
                font-weight: 900;
                text-align: center;
                text-transform: uppercase;
            }

            .document-master {
                padding: 0;
                margin: 0;
                max-width: 210mm;
                text-align: center;
                top: 2cm;
            }

            .title-sup p {
                font-family: "Montserrat", sans-serif;
                margin: 0;
                padding: 1% 0 0 0;
                font-size: 15px;
                line-height: 1.2;
                font-weight: 900;
                text-align: center;
                text-transform: uppercase;
            }

            .logo-header {
                width: 100%;
            }

            .logo-gmac {
                width: 25%;
                padding-top: 5%;
            }

            .logo-footer {
                width: 180px;
                margin: 0;
                padding: 0;
                text-align: center;
            }

            .title-mid {
                margin: 8% 0 12% 0;
            }

            .title-mid p {
                font-family: "Montserrat", sans-serif;
                margin: 0;
                padding: 0;
                font-size: 16px;
                line-height: 1.4;
                font-weight: 400;
                font-weight: 700;
                text-align: center;
            }

            .info-data {
                margin: 6% 0 8% 0;
            }

            .info-data p {
                font-family: "Montserrat", sans-serif;
                margin: 0 0 0.1em 0;
                padding: 0;
                font-size: 12px;
                line-height: 1.4;
                font-weight: 600;
                text-align: justify;
                color: #747474;
            }

            .line-title {
                font-family: "Montserrat", sans-serif;
                margin: 0;
                padding: 0.5em 0 0.5em 0;
                font-size: 16px;
                line-height: 1.4;
                font-weight: 400;
                text-align: center;
                background-color: #747474
            }

            .line-act-title {
                font-family: "Montserrat", sans-serif;
                margin: 0 0 0.1em 0;
                padding: 0.5em 0 0.5em 0;
                font-size: 16px;
                line-height: 1.4;
                font-weight: 400;
                text-align: center;
                background-color: #c9c7c7
            }

            .line-subtitle {
                font-family: "Montserrat", sans-serif;
                margin: 0;
                padding: 0.5em 0 0.5em 0;
                font-size: 16px;
                line-height: 1.4;
                font-weight: 400;
                text-align: center;
                background-color: #adadad
            }

            .line-body {
                font-family: "Montserrat", sans-serif;
                margin: 0 0 0.1em 0;
                padding: 0 0.5em 0 0.5em;
                font-size: 12px;
                line-height: 1.4;
                font-weight: 400;
                text-align: justify;
            }

            .line-center {
                text-align: center;
            }

            .line-first {
                margin-top: 1em;
            }

            .line-last {
                margin-bottom: 1em;
            }




        </style>
    </head>
    <body style="display: block;">
        <header class="o-header" style="clear:both">
            <div class="row ">
                <div class="col col-2">
                    <img src="" style="width: 100px;" class="logo-header" alt="logo-arraial">
                </div>
                <div class="col col-6 title-sup">
                    <p>{{ $unit->organization->name }}</p>
                    <p>{{ $unit->sigla . ' - ' .  $unit->name}}</p>
                    <p>{{ 'Edição' . $official_diary->edition . 'Data de Publicação: ' . date('d/m/Y', strtotime($official_diary->published_at))}}</p>
                </div>
                <div class="col col-2" style=" text-align: left;">
                    <img src="" style="width: 60px;"  class="logo-header" alt="logo-governo">
                </div>
            </div>
        </header>

        <footer class="o-footer " style="clear:both">
            <div class="title-sup">
                <p style="margin-top: 1.1em">AVENIDA ALMIRANTE PAULO DE CASTRO MOREIRA, Nº 50 - CENTRO - ARRAIAL DO CABO - RJ</p>
            </div>
        </footer>

        <main class="o-main summary" style="clear:both;">
                @if (count($act_topics) >= 1)
                    <div class="col col-10" style="margin:20mm 10mm 10mm 10mm">
                        <h1>Sumário</h1>
                        @foreach($act_topics as $topic)
                            <h4>{{ $topic->title }}</h4>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                    <i class="fas fa-times"></i> Não existem Atos Cadastrados no Diário Oficial.
                    </div>
                @endif
            </div>
        </main>

        <main class="o-main" style="clear:both;">
                @if (count($lines) >= 1)
                        @php
                            $count = $line_limit;
                            $count_cols = 2;
                        @endphp
                        @foreach($lines as $line)
                            @foreach($line as $obj)
                                @if ($count_cols == 2)
                                    @php
                                        $count_cols--;
                                    @endphp
                                    <div class="row">
                                @endif
                                @if ($count == $line_limit)
                                        <div class="col col-5 ">
                                @endif
                                @php
                                    $count--;
                                @endphp
                                    {!! html_entity_decode($obj['line'], ENT_QUOTES, 'UTF-8') !!}
                                @if ($count == 0)
                                    @php
                                        $count = $line_limit;
                                        $count_cols--;
                                    @endphp
                                        </div>
                                @endif
                                @if ($count_cols == -1)
                                    @php
                                        $count_cols = 2;
                                    @endphp
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                @else
                    <div class="alert alert-info" role="alert">
                    <i class="fas fa-times"></i> Não existem Atos Cadastrados no Diário Oficial.
                    </div>
                @endif
            </div>
        </main>

    </body>
</html>
