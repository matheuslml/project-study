@extends('layouts.web_base')

@section('content')
    <section id="checklist">
        <div class="container">
            <div class="section-title">
                <h2>Checklists</h2>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="environment-licensing-menu">
                        <button type="button" class="btn btn-success">
                            <a href="{{ route('web_services.environmentlicensing.home') }}">Licenciamento Ambiental</a>
                        </button>
                        <button type="button" class="btn btn-success">
                            <a href="{{ route('web_services.environmentlicensing.postlicense') }}">Pós-Licensa</a>
                        </button>
                        <button type="button" class="btn btn-success">
                            <a href="{{ route('web_services.environmentlicensing.forms') }}">Formulários</a>
                        </button>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text">Checklist 1</p>
                                    <button type="button" class="btn btn-outline-success">Download</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text">Checklist 2</p>
                                    <button type="button" class="btn btn-outline-success">Download</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text">Checklist 3</p>
                                    <button type="button" class="btn btn-outline-success">Download</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection