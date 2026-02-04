<!doctype html>
<html dir="ltr" lang="en-US">
    <head>
        <meta charset="utf-8">
        <link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800' 
    rel='stylesheet' type='text/css'>

        <style>
            /* Define the margins of your page */
            @page {
                margin: 90px 25px;
            }

            /*Diagramação*/

            span {
                text-transform: uppercase;
            }

            .rotated {
                transform: rotate(180deg);
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

            .col-2 {
                width: 20%;
            }

            .col-3 {
                width: calc(100% / 3);
            }

            .col-4 {
                width: calc(100% / 4);
            }

            .col-5 {
                width: 50%;
            }

            .col-6 {
                width: 60%;
            }

            .col-8 {
                width: 80%;
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
                width: 15%;
                margin: 0;
                padding: 2%;
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
                margin: 0 0 0.8em 0;
                padding: 0;
                font-size: 16px;
                line-height: 1.4;
                font-weight: 600;
                text-align: justify;
                color: #747474;
            }

            .local-data {
                margin: 45% 0 15% 0;
            }

            .local-data p {
                font-family: "Montserrat", sans-serif;
                margin: 0;
                padding: 0;
                font-size: 12px;
                font-weight: 400;
                text-align: right;
            }

            /*Assinatura*/
            .signature {
                margin: 8% 0 14% 0;
            }

            .signature p {
                font-family: "Montserrat", sans-serif;
                margin: 0;
                padding: 0;
                font-size: 14px;
                font-weight: 600;
                text-align: center;
            }

            .signature hr {
                display: block;
                margin-top: 0.5em;
                margin-bottom: 0.4em;
                margin-left: auto;
                margin-right: auto;
                border-style: inset;
                border-width: 1px;
                border-color: black;
                width: 40%;
            }

            
            /*Tabela*/

            table {
                border-collapse: collapse;
            }

            tr {
                display: table-row;
                vertical-align: inherit;
                border-color: inherit;
            }

            .table {
                width: 100%;
                padding: 0;
                text-align: left;
                margin-bottom: 1rem;
            }

            .table thead th {
                padding: 0.75rem;
                border-bottom: 2px solid #e3e6f0;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #e3e6f0;
            }

            .table tr {
                padding: 0.75rem;
                border-top: 1px solid #e3e6f0;
            }

            th {
                display: table-cell;
                vertical-align: inherit;
                font-weight: bold;
                text-align: -internal-center;
            }

            .index-table h4 {
                font-family: "Montserrat", sans-serif;
                margin: 5% 0 0 0;
                padding: 0;
                font-size: 20px;
                font-weight: 600;
                text-align: justify;
            }

            .index-table table th {
                font-family: "Montserrat", sans-serif;
                font-size: 14px;
                font-weight: 600;
                text-align: left;
            }

            .index-table table td {
                font-family: "Montserrat", sans-serif;
                font-size: 12px;
                font-weight: 600;
                text-align: left;
            }
            
        </style>
    </head>
    <body style="display: block;">
        <header class="o-header" style="clear:both">
            <div class="row ">
                <div class="col col-2">
                    <img src="storage/images/units/{{ $unit->logo }}" style="width: 60%;" class="logo-header" alt="logo-arraial">
                </div>
                <div class="col col-6 title-sup">
                    <p>{{ $unit->organization->title }}</p>
                    <p>{{ $unit->name }}</p>
                </div>
                <div class="col col-2" style=" text-align: right;">
                    <img src="storage/images/units/{{ $unit->logo }}" style="width: 60%;"  class="logo-header" alt="logo-governo">
                </div>
            </div>
        </header>

        <footer class="o-footer " style="clear:both">
            <img src="images/logo/logo-horizontal.svg" class="logo-footer" alt="CODE">
        </footer>

        <main class="o-main" style="clear:both;">
            <div class="row">
                <div class="document-master">
                    <div class="title-mid">
                        <p>{{ $report_title }}</p>
                        <p>{{ $report_schedule }}</p>
                    </div>
                    <div class="info-data">
                        <div class="col col-5">
                            <p>Total de Legislações: {{ count($legislations) }}</p>
                        </div>
                        <div class="col col-5" >
                            <p style="text-align: right;">Arraial do Cabo, {{date('d/m/Y - H:i')}} horas</p>
                        </div>
                        <div class="row col col-10 index-table" style="margin-top: 6%;">
                            <h4>Legislações Cadastradas deste Relatório </h4>
                            <div class="col-10">   
                            @if (count($legislations) >= 1)
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th>Ementa</th>
                                    <th>Número</th>
                                    <th>Categoria</th>
                                    <th>Situação</th>
                                    <th>Recolhimento</th>
                                    <th>Início</th>
                                    <th>Fim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($legislations as $legislation)
                                        <tr>
                                            <td>{{ $legislation->ementa }}</td>
                                            <td>{{ $legislation->number . '/' . $legislation->number_complement }}</td>
                                            <td>{{ $legislation->category->category }}</td>
                                            <td>{{ $legislation->situation->situation }}</td>
                                            <td>{{ date('d-m-Y', strtotime($legislation->date)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($legislation->initial_term)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($legislation->final_term)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            @else
                                <div class="alert alert-info" role="alert">
                                <i class="fas fa-times"></i> Não existem Dados Armazenados.
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </body>
</html>