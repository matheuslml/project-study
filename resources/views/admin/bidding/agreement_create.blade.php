@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Contrato')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
  <div class="row">

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
              <form class="auth-register-form mt-2" action="{{ route('licitacao_contratos.store') }}" method="POST" >
                @csrf()
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados do  Novo Contrato</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="origin_id">Origem<strong>*</strong></label>
                      <select class="form-select" id="origin_id" name="origin_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($origins as $origin)
                          <option value="{{ $origin->id }}"  >{{ $origin->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="type_id">Tipo<tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar previamente um tipo"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="type_id" name="type_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($types as $type)
                          <option value="{{ $type->id }}" >{{ $type->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="situation_id">Situações</label>
                      <select class="form-select" id="situation_id" name="situation_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($situations as $situation)
                          <option value="{{ $situation->id }}" >{{ $situation->title }}</option>
                        @endforeach
                      </select>
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
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="bidding_id">Licitação<strong>*</strong> <tag data-bs-toggle="tooltip" title="Vincule a uma licitação ja existente"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="bidding_id" name="bidding_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($biddings as $bidding)
                          <option value="{{ $bidding->id }}"  >{{ $bidding->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="title">Título<strong>*</strong></label>
                      <input type="text" name="title" id="title" class="form-control" required/>
                    </div>
                    <div class="col-md-8 mb-1">
                      <label class="form-label" for="contract">Contrato<strong>*</strong> </label>
                      <input type="text" name="contract" id="contract" class="form-control" placeholder="123456"/>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="process">Processo<strong>*</strong> <tag data-bs-toggle="tooltip" title="numero do processo"><i data-feather='info'></i></tag></label>
                      <input type="text" name="process" id="process" class="form-control" placeholder="1234/2022"/>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="name">Nome da Contratada<strong>*</strong><tag data-bs-toggle="tooltip" title="Nome da empresa contratada"><i data-feather='info'></i></tag></label>
                      <input type="text" name="name" id="name" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="document_type_id">Tipo do Documento do Contratado<strong>*</strong></label>
                      <select class="form-select" id="document_type_id" name="document_type_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($document_types as $document_type)
                          <option value="{{ $document_type->id }}"  >{{ $document_type->type }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="document">Documento do Contratado</label>
                      <input type="text" name="document" id="document" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="value">Valor do Contrato<strong>*</strong> <tag data-bs-toggle="tooltip" title="Utilize o Padrão Brasileiro de REAL: Ex:1.250,25 (mil duzentos e ciquenta e vinte e cinco centavos)"><i data-feather='info'></i></tag></label>
                      <input type="text" name="value" id="value" class="form-control value" placeholder="1.250,25"/>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="supervisor">Fiscal do Contrato<strong>*</strong> <tag data-bs-toggle="tooltip" title="Fiscal responsavel pelo contrato"><i data-feather='info'></i></tag></label>
                      <input type="text" name="supervisor" id="supervisor" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="manager">Gestor do Contrato<strong>*</strong> <tag data-bs-toggle="tooltip" title="Secretário ou secretaria responsavel pelo contrato"><i data-feather='info'></i></tag></label>
                      <input type="text" name="manager" id="manager" class="form-control" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="date_signature">Data de Assinatura<strong>*</strong></label>
                      <input type="date" name="date_signature" id="date_signature" class="form-control"  />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="date_validity_init">Início de Vigência<strong>*</strong></label>
                      <input type="date" name="date_validity_init" id="date_validity_init" class="form-control"  />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="date_validity_end">Fim da Vigência<strong>*</strong></label>
                      <input type="date" name="date_validity_end" id="date_validity_end" class="form-control"  />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="date_diary">Publicação<strong>*</strong></label>
                      <input type="date" name="date_diary" id="date_diary" class="form-control"  />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="object">Objetivo<strong>*</strong></label>
                      <textarea name="object" id="object" class="form-control" ></textarea>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="legal_reasoning">Fundamentação Legal<strong>*</strong></label>
                      <textarea name="legal_reasoning" id="legal_reasoning" class="form-control" ></textarea>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="observation">Observações</label>
                      <textarea name="observation" id="observation" class="form-control" ></textarea>
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
  <script src="{{ asset(mix('js/scripts/forms/bidding-agreement-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
