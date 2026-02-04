@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Legislações')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- legislations list start -->
<section class="app-user-list">
  <div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($legislations) }}</h3>
            <span>Total de Legislações</span>
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
            <h3 class="fw-bolder mb-75">{{ count($legislations) }}</h3>
            <span>Total de Adm</span>
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
          <h4 class="card-title">Legislações - Busca Avançada</h4>
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
                <label class="form-label">Legislação:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-title"
                  data-column="1"
                  placeholder="digite a Legislação"
                  data-column-index="0"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Categoria:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-category"
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
        @if (count($legislations) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Legislação</th>
                <th>Categoria</th>
                <th>Situação</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Legislação</th>
                <th>Categoria</th>
                <th>Situação</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($legislations as $legislation)
                @if(isset($legislation->ementa))
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                      <td class="control sorting_1" tabindex="0" ></td>
                      <td style="display: none;">{{ $legislation->ementa }}</td>
                      <td style="display: none;">{{ $legislation->category->category }}</td>
                      <td style="display: none;">{{ $legislation->situation->situation }}</td>
                      <td style="display: none;">{{ $legislation->status == 'PENDING' ? 'Pendente' : ($legislation->status == 'DRAFT' ? 'Editando' : 'Publicado') }}</td>
                      <td style="display: none;">{{isset($legislation->created_at) ? (($legislation->created_at)->format('d/m/Y H:m:s')) : ''}}</td>
                      <td style="display: none;">

                        <div class="btn-group">
                          <a href="{{ route('legislacoes.show', $legislation->id) }}" class="btn btn-info">
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
            <i class="fas fa-times"></i> Não existem Legislações Armazenadas.
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- legislations list ends -->
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
  <script src="{{ asset(mix('js/scripts/tables/legislations.js')) }}"></script>
@endsection
