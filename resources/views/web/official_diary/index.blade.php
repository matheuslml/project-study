@extends('layouts.web_base')

@section('page-style')

    <style>
        .avatar--md .avatar__content img {
            width: 40px;
            height: 40px;
        }
    </style>

@endsection

@section('content')
    <!--
      ============================
      PageTitle #14 Section
      ============================
      -->
    <section class="content pt-0 mt-0">

        <!-- Carousel wrapper -->
        <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel" style="height:260px;">
            <!-- Inner -->
            <div class="carousel-inner" style="height:220px;">
                <!-- Single item -->
                <div class="carousel-item active">
                    <img src="{{ isset($banner->image) ? (asset('storage/images/banners/' . $banner->image)) : ''}}"
                         class="d-block w-100" alt="{{ isset($banner->title) ? $banner->title : '' }}"/>
                </div>
            </div>
            <!-- Inner -->
        </div>
        <!-- Carousel wrapper -->
        <div class="container pt-4">
            <div class="row pt-8">
                <div class="col-12 col-lg-6 pt-4">
                    <div class="title">
                        <h1 class="title-heading"
                            style="color: #009A74; font-family: 'Helvetica Neue', sans-serif; font-size: 55px; font-weight: bold; letter-spacing: -1px; line-height: 1; text-align: left;">{{ isset($banner->title) ? $banner->title : '' }}</h1>
                        <!-- End .breadcrumb-->
                    </div>
                    <!-- End .title-->
                </div>
                <!-- End .col-12-->
            </div>
            <!-- End .row-->
        </div>
    </section>
    <!-- End #page-title-->
    <section id="advanced-search-datatable" class="service-single mb-8" id="service-single">
        <div class="container ">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-4">
                        <div class="card">
                            <h5 class="card-header">Última Edição</h5>
                            <div class="card-body">
                                <h5 class="card-title">
                                    Edição: {{ isset($official_diary_latest->edition) ? $official_diary_latest->edition : '' }}</h5>
                                <h5 class="card-title">
                                    Postagem: {{isset($official_diary_latest->published_at) ? ((date('d/M/Y', strtotime($official_diary_latest->published_at)))) : ''}}</h5>
                                <p class="card-text">{{ isset($official_diary_latest->description) ? $official_diary_latest->description : '' }}</p>
                                @if (isset($official_diary_latest?->files()?->first()->id))
                                    <a href="{{ route('file_web', $official_diary_latest->files()->first()->id) }}"
                                       class="btn btn-secondary"><i class="fa fa-search mr-2"></i> Ler Online</a>
                                @endif
                                <a href="#" class="btn btn-secondary" hidden><i class="fa fa-download"></i> Download</a>

                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="card">
                            <h5 class="card-header">
                                Busca
                                @if($official_diaries->total())
                                    <span
                                        class="badge badge-info">{{ $official_diaries->total() }} {{ $official_diaries->total()> 1 ? 'edições' :  'edição' }}</span>
                                @endif
                            </h5>
                            <div class="card-body">
                                <form method="get" action="{{ route('official_diary_web_index') }}">
                                    <div class="form-row transparency-info">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="text">Edição ou Descrição</label>
                                            <input class="form-control" type="text" id="text" name="filter[text]"
                                                   value="{{ old('filter.text') ?? request('filter.text') }}"/>
                                        </div>
                                    </div>
                                    <div class="form-row transparency-info">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="filter[daterange]">Data de Publicação</label>
                                            <input class="form-control" type="text" name="filter[daterange]"
                                                   value="{{ old('filter.daterange') ?? request('filter.daterange') }}"/>
                                        </div>
                                    </div>
                                    <div class="form-row transparency-info">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary w-100">
                                                Filtrar pesquisa <i class="energia-arrow-right"></i></button>
                                            <a role="button" href="{{ route('official_diary_web_index') }}"
                                               class="btn btn-secondary w-100 mt-3">
                                                Limpar <i class="energia-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="d-flex flex-column flex-md-row mb-3 mb-md-0">
                        <nav class="mr-auto d-flex align-items-center" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="active breadcrumb-item" aria-current="page"><a
                                        href="{{ route('web_home') }}"><i class="fa fa-home"></i></a></li>
                                <li class="active breadcrumb-item" aria-current="page"><a
                                        href="{{ route('official_diary_web_index') }}">Diários Oficiais</a></li>
                            </ol>
                        </nav>
                    </div>

                    <div class="d-flex justify-content-center p-4">
                        {{ $official_diaries->links()}}
                    </div>
                    <div class="row">
                        @if (count($official_diaries) >= 1)
                            @foreach($official_diaries as $official_diary)
                                <div class="col-lg-6 col-sm-12 mt-2">
                                    <div class="card card-margin">
                                        <div class="card-header no-border">
                                            <h5 class="card-title">Diário
                                                Oficial {{ $official_diary->edition . ' / ' . (date('Y', strtotime($official_diary->published_at)))}}</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div
                                                        class="widget-49-date-primary">
                                                        <span
                                                            class="widget-49-date-day">{{isset($official_diary->published_at) ? (($official_diary->published_at)->format('d M Y')) : ''}}</span>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                            <span class="widget-49-pro-title">Assinado por: {{ isset($official_diary->certificates->first()->name) ?
                                                                    $official_diary->certificates->first()->name . ' - Matrícula: ' . $official_diary->certificates->first()->registration
                                                                : '' }}</span>
                                                        <span
                                                            class="widget-49-meeting-time">{{ $official_diary->description }}</span>
                                                    </div>
                                                </div>
                                                <div class="widget-49-meeting-action mt-2">
                                                    @if (isset($official_diary->files()->first()->id))
                                                        <a href="{{ route('file_web', $official_diary->files()->first()->id) }}"
                                                           class="btn btn-secondary"><i class="fa fa-search mr-2"></i>
                                                            Ler Online</a>
                                                    @else
                                                        <a href="{{ route('web_pdf_official_diary_acts', $official_diary->id) }}"
                                                           class="btn btn-secondary"><i class="fa fa-search mr-2"></i>
                                                            Ler Online</a>
                                                    @endif
                                                    <a href="#" class="btn btn-secondary" hidden><i
                                                            class="fa fa-download"></i> Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @else
                            <div class="alert alert-info" role="alert" style="margin: 10px">
                                <i class="fas fa-times"></i>
                                @if(request()->hasAny(['filter.text', 'filter.daterange']))
                                    Nenhum Diário Oficial encontrado com os parâmetros de busca.
                                @else
                                    Não existem Diários Oficiais Armazenados.
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center p-4">
                        {{ $official_diaries->links()}}
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- official_diaries list ends -->
@endsection

@section('page-script')
    <style>
        .ranges li.active {
            color: #3b71ca !important;
            font-weight: bold !important;
            text-decoration: underline !important;
        }
    </style>
    <script async>
        $(function () {
            const minDate = "{{ $official_diary_first->published_at->startOfYear()->format('d/m/Y') }}";
            const maxDate = "{{ \Carbon\Carbon::today()->format('d/m/Y') }}";
            $('input[name="filter[daterange]"]').daterangepicker({
                "showDropdowns": true,
                "alwaysShowCalendars": true,
                "locale": {
                    "format": "DD/MM/YYYY",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Limpar",
                    "fromLabel": "De",
                    "toLabel": "Até",
                    "customRangeLabel": "Personalizado",
                    "weekLabel": "S",
                    "daysOfWeek": [
                        "Dom",
                        "Seg",
                        "Ter",
                        "Qua",
                        "Qui",
                        "Sex",
                        "Sáb"
                    ],
                    "monthNames": [
                        "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    ]
                },
                "minYear": {{ $official_diary_first->published_at->format('Y') }},
                "maxYear": {{ $official_diary_latest->published_at->format('Y') }},
                "minDate": minDate,
                "maxDate": maxDate,
                "startDate": minDate,
                "endDate": maxDate,
                ranges: {
                    'Hoje': [moment(), moment()],
                    'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
                    'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
                    "Todo peróodo": [minDate, maxDate],
                },
                "drops": "auto",
                "opens": "center",
            });
            $('.daterangepicker .drp-buttons .cancelBtn').hide()
        });
    </script>
@endsection
