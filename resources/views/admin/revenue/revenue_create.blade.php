@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Receita')

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
              <form class="auth-register-form mt-2" action="{{ route('receitas.store') }}" method="POST" >
                @csrf()
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Nova Receita</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-9 mb-1">
                      <label class="form-label" for="description">Descrição<strong>*</strong></label>
                      <input type="text" name="description" id="description" class="form-control" required/>
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
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="value">Valor Bruto <tag data-bs-toggle="tooltip" title="Utilize o Padrão Brasileiro de REAL: Ex:1.250,25 (mil duzentos e ciquenta e vinte e cinco centavos)"><i data-feather='info'></i></tag></label>
                      <input type="text" class="form-control current-balance" placeholder="1.250,25" id="value" name="value" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="type_id">Lista de Tipos<strong>* </strong><tag data-bs-toggle="tooltip" title="Não Esqueça de cadastrar previamente o tipo de receita"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="type_id" name="type_id" required>
                        <option value="" class="">Tipos</option>
                        @foreach($types as $type)
                          <option value="{{ $type->id }}" >{{ $type->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="referent">Referente <tag data-bs-toggle="tooltip" title="Referente a que mês ou a qual recolhimento"><i data-feather='info'></i></tag></label>
                      <input type="text" name="referent" id="referent" class="form-control" placeholder="Janeiro de 2022" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="receipt_at">Data de Recolhimento<strong>*</strong></label>
                      <input type="date" name="receipt_at" id="receipt_at" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="collection_initial_at">Início da Arrecadação<strong>*</strong></label>
                      <input type="date" name="collection_initial_at" id="collection_initial_at" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="collection_final_at">Fim da Arrecadação<strong>*</strong></label>
                      <input type="date" name="collection_final_at" id="collection_final_at" class="form-control" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="notes">Anotações</label>
                      <textarea type="text" name="notes" id="notes" class="form-control"></textarea>
                    </div>
                  </div>
                  <button class="btn btn-primary w-100 mt-2" type="submit" tabindex="5">Cadastrar</button>
              </form>
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
<script src="{{ asset(mix('js/scripts/forms/expense-input-mask.js')) }}"></script>
@endsection
