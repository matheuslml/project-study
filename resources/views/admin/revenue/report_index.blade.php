@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Relatórios')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- users list start -->
<section class="app-user-list">
  <div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($revenues) }}</h3>
            <span>Total de Receitas</span>
          </div>
          <div class="avatar bg-light-primary p-50">
            <span class="avatar-content">
              <i data-feather="user" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Gerar Relatório de Receitas</h4>
          <p>selecione as datas, para gerar um relatório com todos as Receitas deste período selecionado.</p>
        </div>
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
          <form class="form form-horizontal" method="POST" action="{{ route('report_revenues_pdf') }}">
            @csrf()
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Tipo de Data</label>
                  </div>
                  <div class="col-sm-9">
                    <select class=" form-select" id="type" name="type" required>
                      <option value="day" >Diário</option>
                      <option value="month" >Mensal</option>
                      <option value="year" >Anual</option>
                      <option value="between" >escolher Datas</option>
                    </select>
                  </div>
                </div>

                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Tipos de Receitas</label>
                  </div>
                  <div class="col-sm-9">
                    <select class=" form-select" id="type_id" name="type_id" required>
                      <option value="0" selected>Todas</option>
                      @foreach($types as $type)
                        <option value="{{ $type->id }}" >{{ $type->title }}</option>
                      @endforeach

                    </select>
                  </div>
                </div>

                <div class="mb-1 row hiddenday" >
                  <div class="col-sm-3">
                    <label class="col-form-label" for="day">Dia</label>
                  </div>
                  <div class="col-sm-9">
                    <input
                      type="date"
                      name="day"
                      id="day"
                      class="form-control"
                    />
                  </div>
                </div>

                <div class="mb-1 row hiddenmonth"  style="display: none;">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="month">Mês</label>
                  </div>
                  <div class="col-sm-9">
                    <select class=" form-select" id="month" name="month" >
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

                <div class="mb-1 row hiddenyear"  style="display: none;">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="year">Ano</label>
                  </div>
                  <div class="col-sm-9">
                    <input
                      type="text"
                      name="year"
                      id="year"
                      class="form-control"
                    />
                  </div>
                </div>

                <div class="mb-1 row hiddenbetween"  style="display: none;">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="date_start">Data de Início</label>
                  </div>
                  <div class="col-sm-9">
                    <input
                      type="date"
                      name="date_start"
                      id="date_start"
                      class="form-control"
                    />
                  </div>
                </div>

                <div class="mb-1 row hiddenbetween"  style="display: none;"  >
                  <div class="col-sm-3">
                    <label class="col-form-label" for="date_end">Data Final</label>
                  </div>
                  <div class="col-sm-9">
                    <input
                      type="date"
                      name="date_end"
                      id="date_end"
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
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script>
    let selectType = $('select[name=type]');

    if (selectType.length) {
        selectType.on('change', function() {
            let idType = $(this).val();
            if (idType == "day") {
              $(".hiddenday").show();
              $(".hiddenmonth").hide();
              $(".hiddenyear").hide();
              $(".hiddenbetween").hide();
            } 
            
            if (idType == "month") {
              $(".hiddenday").hide();
              $(".hiddenmonth").show();
              $(".hiddenyear").show();
              $(".hiddenbetween").hide();
            } 
            
            if (idType == "year") {
              $(".hiddenday").hide();
              $(".hiddenmonth").hide();
              $(".hiddenyear").show();
              $(".hiddenbetween").hide();
            } 

            if (idType == "between") {
              $(".hiddenday").hide();
              $(".hiddenmonth").hide();
              $(".hiddenyear").hide();
              $(".hiddenbetween").show();
            } 
        });
    }
  </script>
@endsection