@extends('admin/layouts/contentLayoutMaster')

@section('title', 'ontratações Diretas')

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
<!-- direct_hires list start -->
<section class="app-user-list">
  <div class="row">

    <div class="col-lg-4 col-sm-6">
      <div class="card">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-body  text-center ps-sm-0">
              <a
                href="{{ route('contratacoes_diretas.create') }}"
                class="stretched-link text-nowrap add-new-role"
              >
                <span class="btn btn-primary mb-1">Nova Contratação Direta</span>
              </a>
              <p class="mb-0">Formulário da Contratação Direta</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($direct_hires) }}</h3>
            <span>Total de ontratações Diretas</span>
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
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Contratações Diretas - Busca Avançada</h4>
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
                <label class="form-label">Contratação:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-title"
                  data-column="1"
                  placeholder="digite a Contratação"
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
        @if (count($direct_hires) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Contratação</th>
                <th>Modalidade</th>
                <th>Situação</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Contratação</th>
                <th>Modalidade</th>
                <th>Situação</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($direct_hires as $direct_hire)
                @if(isset($direct_hire->title))
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                      <td class="control sorting_1" tabindex="0" ></td>
                      <td style="display: none;">{{ $direct_hire->title }}</td>
                      <td style="display: none;">{{ $direct_hire->modality->title }}</td>
                      <td style="display: none;">{{ $direct_hire->situation->title }}</td>
                      <td style="display: none;">{{ $direct_hire->status == 'PENDING' ? 'Pendente' : ($direct_hire->status == 'DRAFT' ? 'Editando' : 'Publicado') }}</td>
                      <td style="display: none;">{{isset($direct_hire->created_at) ? (($direct_hire->created_at)->format('d/m/Y H:m:s')) : ''}}</td>
                      <td style="display: none;">

                        <div class="btn-group">
                          <a href="{{ route('contratacoes_diretas.show', $direct_hire->id) }}" class="btn btn-info">
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
            <i class="fas fa-times"></i> Não existem ontratações Diretas Armazenadas.
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- direct_hires list ends -->
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
  <script src="{{ asset(mix('js/scripts/tables/biddings.js')) }}"></script>
@endsection
