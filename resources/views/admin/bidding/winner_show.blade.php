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
              <form class="auth-register-form mt-2" action="{{ route('pessoas.update', $person->id) }}" method="POST" enctype="multipart/form-data">
                @csrf()
                @method('PUT')
                  <div class="content-header mb-2 mt-2">
                        <h2 class="fw-bolder mb-75">Dados do Vencedor</h2>
                  </div>
                  <div class="row">
                    <div class="mb-1 col-md-4">
                      <label class="form-label" for="personable_type">Tipo de Pessoa</label>
                      <select class="form-select input-admin" id="personable_type" name="personable_type" onchange="type_person();">
                        <option value="" class="">Tipos</option>
                        <option value="pj" {{ $person->personable_type==='App\Models\LegalPerson' ? 'selected' : '' }} >Pessoa Jurídica</option>
                        <option value="pf" {{ $person->personable_type==='App\Models\IndividualPerson' ? 'selected' : '' }} >Pessoa Física</option>
                      </select>
                    </div>
                    <div class="mb-1 col-md-8 pf " style="display: none;">
                      <label class="form-label" for="person_name">Nome Completo</label>
                      <input type="text" value="{{ $person->full_name }}" name="person_name" id="person_name" class="form-control" placeholder="nome" />
                    </div>

                    <div class="mb-1 col-md-8 pj" style="display: none;">
                      <label class="form-label" for="company_name">Nome da Empresa</label>
                      <input type="text" value="{{ $person->personable->company_name }}" name="company_name" id="company_name" class="form-control" placeholder="nome" />
                    </div>
                    <div class="mb-1 col-md-6 pj" style="display: none;">
                      <label class="form-label" for="legal_responsible">Nome do Representante Legal</label>
                      <input type="text" value="{{ $person->personable->legal_responsible }}" name="legal_responsible" id="legal_responsible" class="form-control" placeholder="nome" />
                    </div>
                    <div class="mb-1 col-md-6 pf" style="display: none;">
                      <label class="form-label" for="social_name">Nome Social (apelido, alcunha, designação, etc) </label>
                      <input type="text" value="{{ $person->social_name }}" name="social_name" id="social_name" class="form-control" placeholder="nome social" />
                    </div>
                    @foreach($person->emails as $email)
                      <div class="col-md-6 mb-1 others" style="display: none;">
                        <label class="form-label" for="email">E-mail - {{ $email->type }}</label>
                        <input type="text"name="emails[id][]" value="{{ $email->id }}" hidden>
                        <input type="email" value="{{ $email->email }}" name="emails[email][]" class="form-control" placeholder="email@email.com" aria-label="email" />
                      </div>
                    @endforeach
                    @foreach($person->documents as $document)
                      <div class="col-md-6 mb-1 others" style="display: none;">
                        <label class="form-label" for="document">Documento - {{ $document->document_type->type }}</label>
                        <input type="text"name="documents[id][]" value="{{ $document->id }}" hidden>
                        <input type="text"name="documents[document_type][]" value="{{ $document->document_type->id }}" hidden>
                        <input type="text" value="{{ $document->document }}" name="documents[document][]" class="form-control" />
                      </div>
                    @endforeach
                    <div class="col-md-4 mb-1 pf" style="display: none;">
                      <label class="form-label" for="genre">Gênero</label>
                      <select class="form-select input-admin" id="genre" name="genre" >
                        <option value="" class="">Tipos</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $genre->id ==  $person->genre ? 'selected' : '' }} >{{ $genre->type }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1 pf" style="display: none;">
                      <label class="form-label" for="matrial_status">Estado Civíl</label>
                      <select class="form-select input-admin" id="matrial_status" name="matrial_status" >
                        <option value="" class="">Tipos</option>
                        @foreach($matrial_statuses as $matrial_status)
                            <option value="{{ $matrial_status->id }}" {{ $matrial_status->id ==  $person->matrial_status ? 'selected' : '' }} >{{ $matrial_status->type }}</option>
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
                        value="{{ date('Y-m-d',strtotime($person->personable->birthdate)) }}"
                      />
                    </div>

                    @foreach($person->phones as $phone)
                      <div class="col-md-4 mb-1 others" style="display: none;">
                        <label class="form-label" for="phone">Celular - {{ $phone->type }}</label>
                        <input type="text"name="phones[id][]" value="{{ $phone->id }}" hidden>
                        <input type="phone" value="{{ $phone->phone }}" name="phones[phone][]" class="form-control" />
                      </div>
                    @endforeach
                    @foreach($person->addresses as $address)
                      <div class="col-6 mb-1 others" style="display: none;">
                        <label class="form-label" for="street">Endereço</label>
                        <input
                          type="text"
                          name="street"
                          id="street"
                          class="form-control"
                          value="{{ $address->street }}"
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
                          value="{{ $address->number }}"
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
                          value="{{ $address->complement }}"
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
                          value="{{ $address->neighborhood }}"
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
                          value="{{ $address->postal_code }}"
                        />
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
                  <div class="col-sm-6 offset-sm-5 mt-2">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
              </form>
                    <form method="POST" name="form-delete" action="{{ route('pessoas.destroy', $person->id) }}">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                          onclick="return confirm('Tem certeza que deseja deletar a pessoa?');">Deletar
                        </button>
                    </form>
                  </div>
            </div>
          </div>
        <!-- /Register-->
        </div>
      </div>
    </div>

  </div>


<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Licitações Vínculadas ao Vencedor - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-body mt-2">
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
          <form class="dt_adv_search" method="POST">
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Licitação:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-title"
                  data-column="1"
                  placeholder="digite a Licitação"
                  data-column-index="0"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Modalidade:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-modality"
                  data-column="2"
                  data-column-index="2"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Situação:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-situation"
                  data-column="2"
                  data-column-index="3"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Registrado em:</label>
                <div class="mb-0">
                  <input
                    type="text"
                    class="form-control dt-date flatpickr-range dt-input dt-created-at"
                    data-column="3"
                    placeholder="StartDate to EndDate"
                    data-column-index="4"
                    name="dt_date"
                  />
                  <input
                    type="hidden"
                    class="form-control dt-date start_date dt-input dt-created-at"
                    data-column="3"
                    data-column-index="4"
                    name="value_from_start_date"
                  />
                  <input
                    type="hidden"
                    class="form-control dt-date end_date dt-input dt-created-at"
                    name="value_from_end_date"
                    data-column="3"
                    data-column-index="4"
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($biddings_winner) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Licitação</th>
                <th>Modalidade</th>
                <th>Situação</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Licitação</th>
                <th>Modalidade</th>
                <th>Situação</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($biddings_winner as $bidding_winner)
                @if(isset($bidding_winner->bidding->title))
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                      <td class="control sorting_1" tabindex="0" ></td>
                      <td style="display: none;">{{ $bidding_winner->bidding->title }}</td>
                      <td style="display: none;">{{ $bidding_winner->bidding->modality->title }}</td>
                      <td style="display: none;">{{ $bidding_winner->bidding->situation->title }}</td>
                      <td style="display: none;">{{isset($bidding_winner->bidding->created_at) ? (($bidding_winner->bidding->created_at)->format('d/m/Y H:m:s')) : ''}}</td>
                      <td style="display: none;">

                        <div class="btn-group">
                          <a href="{{ route('licitacoes.show', $bidding_winner->bidding->id) }}" class="btn btn-info">
                                    <i data-feather="search"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  @endif
              @endforeach
            </tbody>
          </table>
          @else
          <div class="alert alert-info" role="alert">
            <i class="fas fa-times"></i> Não existem Licitações Armazenadas.
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- biddings list ends -->
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
  <script src="{{ asset(mix('js/scripts/tables/biddings.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/address/address.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/person/types_show.js')) }}"></script>
<script src="{{asset(mix('js/scripts/pages/auth-register.js'))}}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
