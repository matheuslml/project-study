@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Despesa')

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
              <form class="auth-register-form mt-2" action="{{ route('despesas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Nova Despesa</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-9 mb-1">
                      <label class="form-label" for="title">Descrição<strong>*</strong></label>
                      <input type="text" name="title" id="title" class="form-control" required />
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
                      <label class="form-label" for="source">Fonte<tag data-bs-toggle="tooltip" title="Quem é a fonte pagadora?"><i data-feather='info'></i></tag></label>
                      <input type="text" name="source" id="source" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="register">Registro<tag data-bs-toggle="tooltip" title="Numero de registro interno"><i data-feather='info'></i></tag></label>
                      <input type="text" name="register" id="register" class="form-control" required />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="genre">Lista de Tipos<strong>* </strong><tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar previamente os tipos de despesas"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="type_expense_id" name="type_expense_id" required>
                        <option value="" class="">Tipos</option>
                        @foreach($types as $type)
                          <option value="{{ $type->id }}" >{{ $type->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="current_balance">Saldo Atual<tag data-bs-toggle="tooltip" title="Utilize o Padrão Brasileiro de REAL: Ex:1.250,25 (mil duzentos e ciquenta e vinte e cinco centavos)"><i data-feather='info'></i></tag></label>
                      <input type="text" class="form-control current-balance" placeholder="10,000.00" id="current_balance" name="current_balance" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="blocked_balance">Saldo Bloqueado<tag data-bs-toggle="tooltip" title="Utilize o Padrão Brasileiro de REAL: Ex:1.250,25 (mil duzentos e ciquenta e vinte e cinco centavos)"><i data-feather='info'></i></tag></label>
                      <input type="text" class="form-control blocked-balance" placeholder="10,000.00" id="blocked_balance" name="blocked_balance" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="used_balance">Saldo Utilizado<tag data-bs-toggle="tooltip" title="Utilize o Padrão Brasileiro de REAL: Ex:1.250,25 (mil duzentos e ciquenta e vinte e cinco centavos)"><i data-feather='info'></i></tag></label>
                      <input type="text" class="form-control used-balance" placeholder="10,000.00" id="used_balance" name="used_balance" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="available_balance">Saldo Disponível<tag data-bs-toggle="tooltip" title="Utilize o Padrão Brasileiro de REAL: Ex:1.250,25 (mil duzentos e ciquenta e vinte e cinco centavos)"><i data-feather='info'></i></tag></label>
                      <input type="text" class="form-control available-balance" placeholder="10,000.00" id="available_balance" name="available_balance" />
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
