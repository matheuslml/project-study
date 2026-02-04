@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Relatórios')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
  <div class="row match-height">
    <!-- Medal Card -->
    <div class="col-xl-4 col-md-6 col-12">
      <div class="card ">
        <div class="card-body">
          <h5>Relatórios de Contratações Públicas</h5>
          <p class="card-text font-small-3">Você pode escolher dentre a lista de relatórios qual deseja fazer.</p>
        </div>
      </div>
    </div>
    <!--/ Medal Card -->

    <!-- Statistics Card -->
    <div class="col-xl-8 col-md-6 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">Quantidade de Cadastros</h4>
        </div>
        <div class="card-body statistics-body">
          <div class="row">
            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{ count($direct_hires) }}</h4>
                  <p class="card-text font-small-3 mb-0">C. Diretas</p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{ count($agreements) }}</h4>
                  <p class="card-text font-small-3 mb-0">Contratos</p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{ count($biddings) }}</h4>
                  <p class="card-text font-small-3 mb-0">Licitações</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Statistics Card -->
  </div>

  <div class="row match-height">
    <div class="col-lg-4 col-12">
    </div>

    <!-- Revenue Report Card -->
    <div class="col-lg-8 col-12">
      <div class="col-md-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Contratações Diretas</h4>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li>
                  <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-content collapse ">
            <div class="card-body">
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
                <form class="form form-horizontal" method="POST" action="{{ route('report_direct_hires_pdf') }}">
                  @csrf()
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="title">Tipo de Data</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="direct_hire_type" name="direct_hire_type" required>
                            <option value="day" >Diário</option>
                            <option value="month" >Mensal</option>
                            <option value="year" >Anual</option>
                            <option value="between" >escolher Datas</option>
                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="winner">Vencedores</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="direct_hire_winner_id" name="direct_hire_winner_id">
                            <option value="" selected>Todas</option>
                            @foreach($direct_hire_winners as $winner)
                              <option value="{{ $winner->id }}" >{{ $winner->full_name }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="direct_hire_modality">Modalidades</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="direct_hire_modality_id" name="direct_hire_modality_id">
                            <option value="" selected>Todas</option>
                            @foreach($direct_hire_modalities as $modality)
                              <option value="{{ $modality->id }}" >{{ $modality->title }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="direct_hire_situation">Situações</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="direct_hire_situation_id" name="direct_hire_situation_id">
                            <option value="" selected>Todas</option>
                            @foreach($direct_hire_situations as $situation)
                              <option value="{{ $situation->id }}" >{{ $situation->title }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row dh_hiddenday" >
                        <div class="col-sm-3">
                          <label class="col-form-label" for="day">Dia</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="date"
                            name="direct_hire_day"
                            id="direct_hire_day"
                            class="form-control"
                          />
                        </div>
                      </div>

                      <div class="mb-1 row dh_hiddenmonth"  style="display: none;">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="month">Mês</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="direct_hire_month" name="direct_hire_month" >
                            <option value="1" >Janeiro</option>
                            <option value="2" >Fevereiro</option>
                            <option value="3" >Março</option>
                            <option value="4" >Abril</option>
                            <option value="5" >Maio</option>
                            <option value="6" >Junho</option>
                            <option value="7" >Julho</option>
                            <option value="8" >Agosto</option>
                            <option value="9" >Setembro</option>
                            <option value="10" >Outubro</option>
                            <option value="11" >Novembro</option>
                            <option value="12" >Dezembro</option>
                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row dh_hiddenyear"  style="display: none;">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="year">Ano</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="text"
                            name="direct_hire_year"
                            id="direct_hire_year"
                            class="form-control"
                          />
                        </div>
                      </div>

                      <div class="mb-1 row dh_hiddenbetween"  style="display: none;">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="date_start">Data de Início</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="date"
                            name="direct_hire_date_start"
                            id="direct_hire_date_start"
                            class="form-control"
                          />
                        </div>
                      </div>

                      <div class="mb-1 row dh_hiddenbetween"  style="display: none;"  >
                        <div class="col-sm-3">
                          <label class="col-form-label" for="date_end">Data Final</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="date"
                            name="direct_hire_date_end"
                            id="direct_hire_date_end"
                            class="form-control"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-9 offset-sm-3">
                      <button type="submit" class="btn btn-primary me-1">Gerar PDF</button>
                      <button type="reset" class="btn btn-outline-secondary">Resetar</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Contratos</h4>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li>
                  <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-content collapse ">
            <div class="card-body">
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
                <form class="form form-horizontal" method="POST" action="{{ route('report_agreements_pdf') }}">
                  @csrf()
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="title">Tipo de Data</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="agreement_type" name="agreement_type" required>
                            <option value="day" >Diário</option>
                            <option value="month" >Mensal</option>
                            <option value="year" >Anual</option>
                            <option value="between" >escolher Datas</option>
                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="bidding">Licitações</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="agreement_bidding_id" name="agreement_bidding_id">
                            <option value="" selected>Todas</option>
                            @foreach($biddings as $bidding)
                              <option value="{{ $bidding->id }}" >{{ $bidding->title }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="agreement_origin">Origens</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="agreement_origin_id" name="agreement_origin_id">
                            <option value="" selected>Todas</option>
                            @foreach($agreement_origins as $origin)
                              <option value="{{ $origin->id }}" >{{ $origin->title }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="agreement_type">Tipos</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="agreement_type_id" name="agreement_type_id">
                            <option value="" selected>Todas</option>
                            @foreach($agreement_types as $type)
                              <option value="{{ $type->id }}" >{{ $type->title }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="agreement_situation">Situações</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="agreement_situation_id" name="agreement_situation_id">
                            <option value="" selected>Todas</option>
                            @foreach($agreement_situations as $situation)
                              <option value="{{ $situation->id }}" >{{ $situation->title }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row ag_hiddenday" >
                        <div class="col-sm-3">
                          <label class="col-form-label" for="day">Dia</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="date"
                            name="agreement_day"
                            id="agreement_day"
                            class="form-control"
                          />
                        </div>
                      </div>

                      <div class="mb-1 row ag_hiddenmonth"  style="display: none;">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="month">Mês</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="agreement_month" name="agreement_month" >
                            <option value="1" >Janeiro</option>
                            <option value="2" >Fevereiro</option>
                            <option value="3" >Março</option>
                            <option value="4" >Abril</option>
                            <option value="5" >Maio</option>
                            <option value="6" >Junho</option>
                            <option value="7" >Julho</option>
                            <option value="8" >Agosto</option>
                            <option value="9" >Setembro</option>
                            <option value="10" >Outubro</option>
                            <option value="11" >Novembro</option>
                            <option value="12" >Dezembro</option>
                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row ag_hiddenyear"  style="display: none;">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="year">Ano</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="text"
                            name="agreement_year"
                            id="agreement_year"
                            class="form-control"
                          />
                        </div>
                      </div>

                      <div class="mb-1 row ag_hiddenbetween"  style="display: none;">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="date_start">Data de Início</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="date"
                            name="agreement_date_start"
                            id="agreement_date_start"
                            class="form-control"
                          />
                        </div>
                      </div>

                      <div class="mb-1 row ag_hiddenbetween"  style="display: none;"  >
                        <div class="col-sm-3">
                          <label class="col-form-label" for="date_end">Data Final</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="date"
                            name="agreement_date_end"
                            id="agreement_date_end"
                            class="form-control"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-9 offset-sm-3">
                      <button type="submit" class="btn btn-primary me-1">Gerar PDF</button>
                      <button type="reset" class="btn btn-outline-secondary">Resetar</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Licitações</h4>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li>
                  <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-content collapse ">
            <div class="card-body">
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
                <form class="form form-horizontal" method="POST" action="{{ route('report_biddings_pdf') }}">
                  @csrf()
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="title">Tipo de Data</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="bidding_type" name="bidding_type" required>
                            <option value="day" >Diário</option>
                            <option value="month" >Mensal</option>
                            <option value="year" >Anual</option>
                            <option value="between" >escolher Datas</option>
                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="bidding">Licitações</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="bidding_bidding_id" name="bidding_bidding_id">
                            <option value="" selected>Todas</option>
                            @foreach($biddings as $bidding)
                              <option value="{{ $bidding->id }}" >{{ $bidding->title }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="bidding_modality">Modalidades</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="bidding_modality_id" name="bidding_modality_id">
                            <option value="" selected>Todas</option>
                            @foreach($bidding_modalities as $modality)
                              <option value="{{ $modality->id }}" >{{ $modality->title }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="bidding_situation">Situações</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="bidding_situation_id" name="bidding_situation_id">
                            <option value="" selected>Todas</option>
                            @foreach($bidding_situations as $situation)
                              <option value="{{ $situation->id }}" >{{ $situation->title }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row bd_hiddenday" >
                        <div class="col-sm-3">
                          <label class="col-form-label" for="day">Dia</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="date"
                            name="bidding_day"
                            id="bidding_day"
                            class="form-control"
                          />
                        </div>
                      </div>

                      <div class="mb-1 row bd_hiddenmonth"  style="display: none;">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="month">Mês</label>
                        </div>
                        <div class="col-sm-9">
                          <select class=" form-select" id="bidding_month" name="bidding_month" >
                            <option value="1" >Janeiro</option>
                            <option value="2" >Fevereiro</option>
                            <option value="3" >Março</option>
                            <option value="4" >Abril</option>
                            <option value="5" >Maio</option>
                            <option value="6" >Junho</option>
                            <option value="7" >Julho</option>
                            <option value="8" >Agosto</option>
                            <option value="9" >Setembro</option>
                            <option value="10" >Outubro</option>
                            <option value="11" >Novembro</option>
                            <option value="12" >Dezembro</option>
                          </select>
                        </div>
                      </div>

                      <div class="mb-1 row bd_hiddenyear"  style="display: none;">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="year">Ano</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="text"
                            name="bidding_year"
                            id="bidding_year"
                            class="form-control"
                          />
                        </div>
                      </div>

                      <div class="mb-1 row bd_hiddenbetween"  style="display: none;">
                        <div class="col-sm-3">
                          <label class="col-form-label" for="date_start">Data de Início</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="date"
                            name="bidding_date_start"
                            id="bidding_date_start"
                            class="form-control"
                          />
                        </div>
                      </div>

                      <div class="mb-1 row bd_hiddenbetween"  style="display: none;"  >
                        <div class="col-sm-3">
                          <label class="col-form-label" for="date_end">Data Final</label>
                        </div>
                        <div class="col-sm-9">
                          <input
                            type="date"
                            name="bidding_date_end"
                            id="bidding_date_end"
                            class="form-control"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-9 offset-sm-3">
                      <button type="submit" class="btn btn-primary me-1">Gerar PDF</button>
                      <button type="reset" class="btn btn-outline-secondary">Resetar</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Revenue Report Card -->
  </div>
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script>
    let selectDirectHire = $('select[name=direct_hire_type]');
    let selectAgreement = $('select[name=agreement_type]');
    let selectBidding = $('select[name=bidding_type]');

    if (selectDirectHire.length) {
        selectDirectHire.on('change', function() {
            let idType = $(this).val();
            if (idType == "day") {
              $(".dh_hiddenday").show();
              $(".dh_hiddenmonth").hide();
              $(".dh_hiddenyear").hide();
              $(".dh_hiddenbetween").hide();
            } 
            
            if (idType == "month") {
              $(".dh_hiddenday").hide();
              $(".dh_hiddenmonth").show();
              $(".dh_hiddenyear").show();
              $(".dh_hiddenbetween").hide();
            } 
            
            if (idType == "year") {
              $(".dh_hiddenday").hide();
              $(".dh_hiddenmonth").hide();
              $(".dh_hiddenyear").show();
              $(".dh_hiddenbetween").hide();
            } 

            if (idType == "between") {
              $(".dh_hiddenday").hide();
              $(".dh_hiddenmonth").hide();
              $(".dh_hiddenyear").hide();
              $(".dh_hiddenbetween").show();
            } 
        });
    }

    if (selectAgreement.length) {
        selectAgreement.on('change', function() {
            let idType = $(this).val();
            if (idType == "day") {
              $(".ag_hiddenday").show();
              $(".ag_hiddenmonth").hide();
              $(".ag_hiddenyear").hide();
              $(".ag_hiddenbetween").hide();
            } 
            
            if (idType == "month") {
              $(".ag_hiddenday").hide();
              $(".ag_hiddenmonth").show();
              $(".ag_hiddenyear").show();
              $(".ag_hiddenbetween").hide();
            } 
            
            if (idType == "year") {
              $(".ag_hiddenday").hide();
              $(".ag_hiddenmonth").hide();
              $(".ag_hiddenyear").show();
              $(".ag_hiddenbetween").hide();
            } 

            if (idType == "between") {
              $(".ag_hiddenday").hide();
              $(".ag_hiddenmonth").hide();
              $(".ag_hiddenyear").hide();
              $(".ag_hiddenbetween").show();
            } 
        });
    }

  if (selectBidding.length) {
      selectBidding.on('change', function() {
          let idType = $(this).val();
          if (idType == "day") {
            $(".bd_hiddenday").show();
            $(".bd_hiddenmonth").hide();
            $(".bd_hiddenyear").hide();
            $(".bd_hiddenbetween").hide();
          } 
          
          if (idType == "month") {
            $(".bd_hiddenday").hide();
            $(".bd_hiddenmonth").show();
            $(".bd_hiddenyear").show();
            $(".bd_hiddenbetween").hide();
          } 
          
          if (idType == "year") {
            $(".bd_hiddenday").hide();
            $(".bd_hiddenmonth").hide();
            $(".bd_hiddenyear").show();
            $(".bd_hiddenbetween").hide();
          } 

          if (idType == "between") {
            $(".bd_hiddenday").hide();
            $(".bd_hiddenmonth").hide();
            $(".bd_hiddenyear").hide();
            $(".bd_hiddenbetween").show();
          } 
      });
  }
  </script>
@endsection