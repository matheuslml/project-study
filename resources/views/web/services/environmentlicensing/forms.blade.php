@extends('layouts.web_base')

@section('content')
    <section id="forms">
        <div class="container">
            <div class="section-title">
                <h2>Formulários</h2>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="environment-licensing-menu">
                        <button type="button" class="btn btn-success">
                            <a href="{{ route('web_services.environmentlicensing.home') }}">Licenciamento Ambiental</a>
                        </button>
                        <button type="button" class="btn btn-success">
                            <a href="{{ route('web_services.environmentlicensing.postlicense') }}">Pós-Licença</a>
                        </button>
                        <button type="button" class="btn btn-success">
                            <a href="{{ route('web_services.environmentlicensing.checklist') }}">Checklist</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection