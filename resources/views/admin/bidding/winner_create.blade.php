@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Vencedor')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
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
              <form class="auth-register-form mt-2" action="{{ route('pessoas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                  <div class="content-header mb-2 mt-2">
                        <h2 class="fw-bolder mb-75">Cadastro de Vencedor</h2>
                        <span>coloque os dados</span>
                  </div>
                  <div class="row">
                    <div class="mb-1 col-md-4">
                      <label class="form-label" for="personable_type">Tipo de Pessoa</label>
                      <select class="form-select input-admin" id="personable_type" name="personable_type" onchange="type_person();">
                        <option value="" class="">Tipos</option>
                        <option value="pj" {{ old('personable_type')==='pj' ? 'selected' : '' }} >Pessoa Jurídica</option>
                        <option value="pf" {{ old('personable_type')==='pf' ? 'selected' : '' }} >Pessoa Física</option>
                      </select>
                    </div>
                    <div class="mb-1 col-md-8 pf " style="display: none;">
                      <label class="form-label" for="name">Nome Completo</label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="nome" />
                    </div>
                    <div class="mb-1 col-md-8 pj" style="display: none;">
                      <label class="form-label" for="company_name">Nome da Empresa</label>
                      <input type="text" name="company_name" id="company_name" class="form-control" placeholder="nome" />
                    </div>
                    <div class="mb-1 col-md-6 pj" style="display: none;">
                      <label class="form-label" for="legal_responsible">Nome do Representante Legal</label>
                      <input type="text" name="legal_responsible" id="legal_responsible" class="form-control" placeholder="nome" />
                    </div>
                    <div class="mb-1 col-md-6 pf" style="display: none;">
                      <label class="form-label" for="social_name">Nome Social (apelido, alcunha, designação, etc) </label>
                      <input type="text" name="social_name" id="social_name" class="form-control" placeholder="nome social" />
                    </div>
                    <div class="col-md-6 mb-1 others" style="display: none;">
                      <label class="form-label" for="email">E-mail</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="email@email.com" aria-label="email" />
                    </div>
                    <div class="col-md-4 mb-1 pf" style="display: none;">
                      <label class="form-label" for="genre">Gênero</label>
                      <select class="form-select input-admin" id="genre" name="genre" >
                        <option value="" class="">Tipos</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" >{{ $genre->type }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1 pf" style="display: none;">
                      <label class="form-label" for="matrial_status">Estado Civíl</label>
                      <select class="form-select input-admin" id="matrial_status" name="matrial_status" >
                        <option value="" class="">Tipos</option>
                        @foreach($matrial_statuses as $matrial_statuse)
                            <option value="{{ $matrial_statuse->id }}" >{{ $matrial_statuse->type }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1 pf" style="display: none;">
                      <label class="form-label" for="birthdate">Data de Nascimento</label>
                      <input
                        type="date"
                        name="birthdate"
                        id="birthdate"
                        class="form-control"
                      />
                    </div>
                    <div class="col-md-4 mb-1 pf" style="display: none;">
                      <label class="form-label" for=cpf">CPF</label>
                      <input type="hidden" name="documents[document_type][]" value="1">
                      <input
                        type="text"
                        name="documents[document][]"
                        id="cpf"
                        class="form-control custom-delimiter-mask"
                        placeholder="999.999.999-99"
                      />
                    </div>
                    <div class="col-md-4 mb-1 pf" style="display: none;">
                      <label class="form-label" for="identidade">Identidade</label>
                      <input type="hidden" name="documents[document_type][]" value="2">
                      <input
                        type="text"
                        name="documents[document][]"
                        id="identidade"
                        class="form-control"
                      />
                    </div>
                    <div class="col-md-4 mb-1 pj" style="display: none;">
                      <label class="form-label" for="matricula">CNPJ</label>
                      <input type="hidden" name="documents[document_type][]" value="7">
                      <input
                        type="text"
                        name="documents[document][]"
                        id="matricula"
                        class="form-control"
                      />
                    </div>

                    <div class="col-md-4 mb-1 others" style="display: none;">
                      <label class="form-label" for="mobile-number">Celular</label>
                      <div class="input-group input-group-merge ">
                        <span class="input-group-text">BR (+55)</span>
                        <input
                          type="text"
                          name="phone"
                          id="phone"
                          class="form-control phone-number-mask"
                          placeholder="(99) 9 9999-9999"
                        />
                      </div>
                    </div>

                    <div class="col-6 mb-1 others" style="display: none;">
                      <label class="form-label" for="street">Endereço</label>
                      <input
                        type="text"
                        name="street"
                        id="street"
                        class="form-control"
                        placeholder="Address"
                      />
                    </div>

                    <div class="col-2 mb-1 others" style="display: none;">
                      <label class="form-label" for="number">Número</label>
                      <input
                        type="text"
                        name="number"
                        id="number"
                        class="form-control"
                        placeholder="Número"
                      />
                    </div>

                    <div class="col-4 mb-1 others" style="display: none;">
                      <label class="form-label" for="complement">Complemento</label>
                      <input
                        type="text"
                        name="complement"
                        id="complement"
                        class="form-control"
                        placeholder="Complemento"
                      />
                    </div>

                    <div class="col-4 mb-1 others" style="display: none;">
                      <label class="form-label" for="neighborhood">Bairro</label>
                      <input
                        type="text"
                        name="neighborhood"
                        id="neighborhood"
                        class="form-control"
                        placeholder="Bairro"
                      />
                    </div>

                    <div class="col-4 mb-1 others" style="display: none;">
                      <label class="form-label" for="postal_code">Código Postal (CEP)</label>
                      <input
                        type="text"
                        name="postal_code"
                        id="postal_code"
                        class="form-control"
                        placeholder="CEP"
                      />
                    </div>

                    <div class="mb-1 col-md-4 others" style="display: none;">
                      <label class="form-label" for="country">País</label>
                      <select class="select2 w-100" name="country" id="country">
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country')==='$country->id'|| $country->id===1 ? 'selected' : '' }} >{{ $country->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="mb-1 col-md-4 others" style="display: none;">
                      <label class="form-label" for="state">Estado</label>
                      <select class="select2 w-100" name="state" id="state">
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ (old('state')==$state->id || $state->id===19) ? 'selected' : '' }}>{{ $state->uf . ' - ' . $state->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="mb-1 col-md-4 others" style="display: none;">
                      <label class="form-label" for="city_id">Cidade</label>
                      <select class="select2 w-100"  id="city_id" name="city_id" data-default="{{ old('city_id') }}">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" >{{ $city->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  </div>
                    <button class="btn btn-primary w-100 mt-2 others" type="submit" tabindex="5" style="display: none;">Cadastrar</button>
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
<script src="{{ asset(mix('js/scripts/departament/departament.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/address/address.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/person/types_show.js')) }}"></script>
<script src="{{asset(mix('js/scripts/pages/auth-register.js'))}}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-input-mask.js')) }}"></script>
@endsection
