@extends('admin/layouts/contentLayoutMaster')

@section('title', 'RAS')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css'))}}">
@endsection

@section('content')
<!-- users list start -->
<section class="app-user-list">
  <div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($orderlies) }}</h3>
            <span>Total de RAS</span>
          </div>
          <div class="avatar bg-light-primary p-50">
            <span class="avatar-content">
              <i data-feather="user" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($cops) }}</h3>
            <span>Total de Guardas</span>
          </div>
          <div class="avatar bg-light-danger p-50">
            <span class="avatar-content">
              <i data-feather="user-plus" class="font-medium-4"></i>
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
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">RAS - Busca Avançada</h4>
        </div>
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
        <!--Search Form -->
        <div class="card-body mt-2">
          <form class="dt_adv_search" method="POST">
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Título:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-title"
                  data-column="1"
                  placeholder="digite o nome"
                  data-column-index="0"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Tipo:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-type"
                  data-column="2"
                  placeholder=""
                  data-column-index="1"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Status:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-active"
                  data-column="3"
                  placeholder=""
                  data-column-index="2"
                />
              </div>
            </div>
            <div class="row g-1">
              <div class="col-md-4">
                <label class="form-label">Registrado em:</label>
                <div class="mb-0">
                  <input
                    type="text"
                    class="form-control dt-date flatpickr-range dt-input dt-created-at"
                    data-column="5"
                    placeholder="StartDate to EndDate"
                    data-column-index="4"
                    name="dt_date"
                  />
                  <input
                    type="hidden"
                    class="form-control dt-date start_date dt-input dt-created-at"
                    data-column="5"
                    data-column-index="4"
                    name="value_from_start_date"
                  />
                  <input
                    type="hidden"
                    class="form-control dt-date end_date dt-input dt-created-at"
                    name="value_from_end_date"
                    data-column="5"
                    data-column-index="4"
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($orderlies) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Título</th>
                <th>Tipo</th>
                <th>Vagas</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Título</th>
                <th>Tipo</th>
                <th>Vagas</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($orderlies as $orderly)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $orderly->title }}</td>
                    <td style="display: none;">{{ $orderly->ordelyTime->period }}</td>
                    <td style="display: none;">{{ $orderly->vacancy }}</td>
                    <td style="display: none;">
                    {{ $orderly->active == 1 ? 'Ativo' : 'Desativado' }}
                    </td>
                    <td style="display: none;">{{ $orderly->created_at }}</td>
                    <td style="display: none;">
                      <a href="{{ route('ras.show', $orderly->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="search" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem RAS Armazenados.
              </div>
            </div>
          @endif
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
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/orderlies.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>
  <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js'))}}"></script>
@endsection
