@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Vencedor')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
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
              <form class="auth-register-form mt-2" action="{{ route('pessoas.update', $winner_selected->person->id) }}" method="POST" enctype="multipart/form-data">
                @csrf()
                  <div class="content-header mb-2 mt-2">
                        <h2 class="fw-bolder mb-75">{{ $winner_selected->bidding->title }}</h2>
                        <h2 class="fw-bolder mb-75">Dados do Vencedor</h2>
                  </div>
                  <div class="row">
                    <div class="mb-1 col-md-4">
                      <label class="form-label" for="personable_type">Tipo de Pessoa</label>
                      <select class="form-select input-admin" id="personable_type" name="personable_type" onchange="type_person();" disabled>
                        <option value="" class="">Tipos</option>
                        <option value="pj" {{ $winner_selected->person->personable_type==='App\Models\LegalPerson' ? 'selected' : '' }} >Pessoa Jurídica</option>
                        <option value="pf" {{ $winner_selected->person->personable_type==='App\Models\IndividualPerson' ? 'selected' : '' }} >Pessoa Física</option>
                      </select>
                    </div>
                    <div class="mb-1 col-md-8 pf " style="display: none;">
                      <label class="form-label" for="name">Nome Completo</label>
                      <input type="text" value="{{ $winner_selected->person->full_name }}" name="name" id="name" class="form-control" placeholder="nome" disabled/>
                    </div>

                    <div class="mb-1 col-md-8 pj" style="display: none;">
                      <label class="form-label" for="company_name">Nome da Empresa</label>
                      <input type="text" value="{{ isset($winner_selected->person->personable->company_name) ? $winner_selected->person->personable->company_name : '' }}" name="company_name" id="company_name" class="form-control" placeholder="nome" disabled/>
                    </div>
                    <div class="mb-1 col-md-6 pj" style="display: none;">
                      <label class="form-label" for="legal_responsible">Nome do Representante Legal</label>
                      <input type="text" value="{{ isset($winner_selected->person->personable->legal_responsible) ? $winner_selected->person->personable->legal_responsible : '' }}" name="legal_responsible" id="legal_responsible" class="form-control" placeholder="nome" disabled/>
                    </div>
                    <div class="mb-1 col-md-6 pf" style="display: none;">
                      <label class="form-label" for="social_name">Nome Social (apelido, alcunha, designação, etc) </label>
                      <input type="text" value="{{ $winner_selected->person->social_name }}" name="social_name" id="social_name" class="form-control" placeholder="nome social" disabled/>
                    </div>
                    @foreach($winner_selected->person->emails as $email)
                      <div class="col-md-6 mb-1 others" style="display: none;">
                        <label class="form-label" for="email">E-mail - {{ $email->type }}</label>
                        <input type="text"name="emails[id][]" value="{{ $email->id }}" hidden>
                        <input type="email" value="{{ $email->email }}" name="emails[email][]" class="form-control" placeholder="email@email.com" aria-label="email" disabled/>
                      </div>
                    @endforeach
                    <div class="col-md-4 mb-1 pf" style="display: none;">
                      <label class="form-label" for="genre">Gênero</label>
                      <select class="form-select input-admin" id="genre" name="genre" disabled>
                        <option value="" class="">Tipos</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $genre->id ==  $winner_selected->person->genre ? 'selected' : '' }} >{{ $genre->type }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1 pf" style="display: none;">
                      <label class="form-label" for="matrial_status">Estado Civíl</label>
                      <select class="form-select input-admin" id="matrial_status" name="matrial_status" disabled>
                        <option value="" class="">Tipos</option>
                        @foreach($matrial_statuses as $matrial_status)
                            <option value="{{ $matrial_status->id }}" {{ $matrial_status->id ==  $winner_selected->person->matrial_status ? 'selected' : '' }} >{{ $matrial_status->type }}</option>
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
                        value="{{ isset($winner_selected->person->personable->birthdate) ? date('Y-m-d',strtotime($winner_selected->person->personable->birthdate)) : '' }}"
                      disabled/>
                    </div>

                    @foreach($winner_selected->person->phones as $phone)
                      <div class="col-md-4 mb-1 others" style="display: none;">
                        <label class="form-label" for="phone">Celular - {{ $phone->type }}</label>
                        <input type="text"name="phones[id][]" value="{{ $phone->id }}" hidden>
                        <input type="phone" value="{{ $phone->phone }}" name="phones[phone][]" class="form-control" disabled/>
                      </div>
                    @endforeach
                    @foreach($winner_selected->person->addresses as $address)
                      <div class="col-6 mb-1 others" style="display: none;">
                        <label class="form-label" for="street">Endereço</label>
                        <input
                          type="text"
                          name="street"
                          id="street"
                          class="form-control"
                          value="{{ $address->street }}"
                        disabled/>
                      </div>

                      <div class="col-2 mb-1 others" style="display: none;">
                        <label class="form-label" for="number">Número</label>
                        <input
                          type="text"
                          name="number"
                          id="number"
                          class="form-control"
                          placeholder="Número"
                          value="{{ $address->number }}"
                        disabled/>
                      </div>

                      <div class="col-4 mb-1 others" style="display: none;">
                        <label class="form-label" for="complement">Complemento</label>
                        <input
                          type="text"
                          name="complement"
                          id="complement"
                          class="form-control"
                          placeholder="Complemento"
                          value="{{ $address->complement }}"
                        disabled/>
                      </div>

                      <div class="col-4 mb-1 others" style="display: none;">
                        <label class="form-label" for="neighborhood">Bairro</label>
                        <input
                          type="text"
                          name="neighborhood"
                          id="neighborhood"
                          class="form-control"
                          placeholder="Bairro"
                          value="{{ $address->neighborhood }}"
                        disabled/>
                      </div>

                      <div class="col-4 mb-1 others" style="display: none;">
                        <label class="form-label" for="postal_code">Código Postal (CEP)</label>
                        <input
                          type="text"
                          name="postal_code"
                          id="postal_code"
                          class="form-control"
                          placeholder="CEP"
                          value="{{ $address->postal_code }}"
                        disabled/>
                      </div>

                      <div class="mb-1 col-md-4 others" style="display: none;">
                        <label class="form-label" for="country">País</label>
                        <select class="select2 w-100" name="country" id="country">
                          @foreach($countries as $country)
                              <option value="{{ $country->id }}" {{ $country->id ==  $address->city->state->country->id ? 'selected' : '' }} >{{ $country->name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="mb-1 col-md-4 others" style="display: none;">
                        <label class="form-label" for="state">Estado</label>
                        <select class="select2 w-100" name="state" id="state">
                          @foreach($states as $state)
                              <option value="{{ $state->id }}" {{ $state->id ==  $address->city->state->id ? 'selected' : '' }} >{{ $state->uf . ' - ' . $state->name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="mb-1 col-md-4 others" style="display: none;">
                        <label class="form-label" for="city_id">Cidade</label>
                        <select class="select2 w-100"  id="city_id" name="city_id" data-default="{{ old('city_id') }}">
                          @foreach($cities as $city)
                              <option value="{{ $city->id }}" {{ $city->id ==  $address->city->id ? 'selected' : '' }} >{{ $city->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    @endforeach
                  </div>



                  </div>
              </form>
            </div>
          </div>
        <!-- /Register-->
        </div>
      </div>
    </div>

  </div>

  
<!-- item -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Vincular Item ao Vencedor</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal" method="POST" action="{{ route('winner_add_itens', $winner_selected->person->id) }}">
            @csrf()
            <div class="row">
              <div class="col-12">
                <div class="col-sm-12 mb-1">
                  <label class="form-label" for="items">Itens</label>
                  <select class="select2 form-select" id="items" name="items[]" multiple>
                    @foreach($winner_selected->bidding->items as  $item)
                      @if($item->person_id != $winner_selected->person->id)
                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1">Salvar</button>
                <button type="reset" class="btn btn-outline-secondary">Resetar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Remover Item do Vencedor</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal" method="POST" action="{{ route('winner_remove_itens') }}">
            @csrf()
            <div class="row">
              <div class="col-12">
                <div class="col-sm-12 mb-1">
                  <label class="form-label" for="remove_items">Itens</label>
                  <select class="select2 form-select" id="remove_items" name="remove_items[]" multiple>
                    @foreach($winner_selected->bidding->items as  $item)
                      @if($item->person_id == $winner_selected->person->id)
                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1">Salvar</button>
                <button type="reset" class="btn btn-outline-secondary">Resetar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Itens - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-datatable">
        @if (count($winner_selected->bidding->items) >= 1)
          <table class="dt-advanced-search-bond table">
            <thead>
              <tr>
                <th></th>
                <th>Item</th>
                <th>Quantidade</th>
                <th>Custo</th>
                <th>Vencedor</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Item</th>
                <th>Quantidade</th>
                <th>Custo</th>
                <th>Vencedor</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($winner_selected->bidding->items as $item)
                @if($item->person_id == $winner_selected->person_id)
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                      <td class="control sorting_1" tabindex="0" ></td>
                      <td style="display: none;">{{ $item->name }}</td>
                      <td style="display: none;">{{ $item->quantity }}</td>
                      <td style="display: none;">{{ $item->value }}</td>
                      <td style="display: none;">{{ $item->person->full_name }}</td>
                      <td style="display: none;">{{ $item->created_at }}</td>
                      <td style="display: none;">
                        <a href="{{ route('licitacao_items.show', $item->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                      </td>
                    </tr>
                @endif
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Itens Armazenados.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- item ends -->
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/departament/departament.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/bidding-items.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/address/address.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/person/types_show.js')) }}"></script>
<script src="{{asset(mix('js/scripts/pages/auth-register.js'))}}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
