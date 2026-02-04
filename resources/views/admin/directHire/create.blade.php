@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Contratação Direta')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
  <div class="row">

    <div class="col-lg-4 col-sm-6">
      <div class="card">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-body  text-center ps-sm-0">
              <a
                href="{{ route('contratacoes_diretas.index') }}"
                class="stretched-link text-nowrap add-new-role"
              >
                <span class="btn btn-primary mb-1">Lista de Contratações Diretas</span>
              </a>
              <p class="mb-0">Busca Avançada das Contratações Diretas</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Register-->
    <div class="col-lg-12  ">
      <div class="card ">
        <div class="card-body ">
          <!-- Register-->
          <div class="col-lg-12 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
            @include('flash::message')
              @if ($errors->any())
                <div class="alert alert-danger pb-2" role="alert">
                    <h4 class="alert-heading">Erros:</h4>
                    <div class="alert-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
              @endif
              <form class="auth-register-form mt-2" action="{{ route('contratacoes_diretas.store') }}" method="POST" >
                @csrf()
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da  Nova Contratação Direta</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="title">Nome<strong>*</strong></label>
                      <input type="text" name="title" id="title" class="form-control" required/>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="status">Status<strong>*</strong></label>
                      <select class="form-select" id="status" name="status" required>
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT"  >Desenvolvendo</option>
                        <option value="PENDING"  >Pendente</option>
                        <option value="PUBLISHED"  >Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="modality_id">Modalidades<strong>*</strong></label>
                      <select class="form-select" id="modality_id" name="modality_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($modalities as $modality)
                          <option value="{{ $modality->id }}"  >{{ $modality->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="situation_id">Situações<strong>*</strong></label>
                      <select class="form-select" id="situation_id" name="situation_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($situations as $situation)
                          <option value="{{ $situation->id }}" >{{ $situation->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="bidding">Contratação Direta<strong>*</strong></label>
                      <input type="text" name="bidding" id="bidding" class="form-control" placeholder="123456" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="value_min">Valor Mínimo <tag data-bs-toggle="tooltip" title="Utilize o Padrão Brasileiro de REAL: Ex:1.250,25 (mil duzentos e ciquenta e vinte e cinco centavos)"><i data-feather='info'></i></tag></label>

                      <input type="text" class="form-control value_min"   id="value_min" name="value_min" placeholder="1.250,25" />

                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="value_max">Valor Estimativa <tag data-bs-toggle="tooltip" title="Utilize o Padrão Brasileiro de REAL: Ex:1.250,25 (mil duzentos e ciquenta e vinte e cinco centavos)"><i data-feather='info'></i></tag></label>
                      <input type="text" class="form-control value_max"   id="value_max" name="value_max" placeholder="1.250,25" />
                    </div>
                    <div class="col-md-4 mb-1">

                      <label class="form-label" for="local">Local<strong>*</strong></label>
                      <input type="text" name="local" id="local" class="form-control" placeholder="rua.rua,01,bairro" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="content">Objeto<strong>*</strong></label>
                      <input type="text" name="content" id="content" class="form-control"  />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="process">Processo</label>
                      <input type="text" name="process" id="process" class="form-control" placeholder="1234/2022" />
                    </div>

                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="published_at">Data de Publicação do Edital<strong>*</strong></label>
                      <input type="date" name="published_at" id="published_at" class="form-control"  />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="realized_at">Data da Contratação Direta<strong>*</strong></label>

                      <input type="date" name="realized_at" id="realized_at" class="form-control" />
                    </div>


                  </div>
                  <div class="col-12 mt-1 pb-4">
                    <button class="btn btn-primary w-100 mt-2" type="submit" tabindex="5">Cadastrar</button>
                  </div>
            </div>
          </div>
        <!-- /Register-->
        </div>
      </div>
    </div>

  </div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/forms/bidding-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
