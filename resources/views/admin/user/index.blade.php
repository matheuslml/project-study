@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Usuários')

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
<!-- users list start -->
<section class="app-user-list">
  <div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($users) }}</h3>
            <span>Total de Usuários</span>
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
            <h3 class="fw-bolder mb-75">{{ count($users) }}</h3>
            <span>Total de Administradores</span>
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
          <h4 class="card-title">Usuários - Busca Avançada</h4>
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
                <label class="form-label">Name:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-full-name"
                  data-column="1"
                  placeholder="Digite o nome"
                  data-column-index="0"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Email:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-email"
                  data-column="2"
                  placeholder="email@example.com"
                  data-column-index="1"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Registro:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-register"
                  data-column="3"
                  placeholder="Web designer"
                  data-column-index="2"
                />
              </div>
            </div>
            <div class="row g-1">
              <div class="col-md-4">
                <label class="form-label">Departamento:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-departament"
                  data-column="4"
                  placeholder="Departamento"
                  data-column-index="3"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Status:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-status"
                  data-column="6"
                  placeholder="Ativo"
                  data-column-index="5"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Registrado em:</label>
                <div class="mb-0">
                  <input
                    type="text"
                    class="form-control dt-date flatpickr-range dt-input dt-created-at"
                    data-column="5"
                    placeholder="Data"
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
        @if (count($users) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Registro</th>
                <th>Departamento</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Registro</th>
                <th>Departamento</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($users as $user)
                @if(isset($user->person->full_name))
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                      <td class="control sorting_1" tabindex="0" ></td>
                      <td style="display: none;">{{ isset($user->person->social_name) ? Str::limit($user->person->social_name, 20) : Str::limit($user->person->full_name, 20) }}</td>
                      <td style="display: none;">{{ $user->email }}</td>
                      <td style="display: none;">
                        <div class="">
                          @if(isset($user->person))
                            @php $i = 1; @endphp
                            @foreach($user->person->documents as $document)
                              @if($i == 1)
                                <span class="badge rounded-pill bg-primary">{{ isset($document->document) ? $document->document . ' / ' . $document->document_type->type : '' }}</span>
                              @endif
                              @if($i == 2)
                                <span class="badge rounded-pill bg-secondary">{{ isset($document->document) ? $document->document . ' / ' . $document->document_type->type : '' }}</span>
                              @endif
                              @if($i == 3)
                                <span class="badge rounded-pill bg-success">{{ isset($document->document) ? $document->document . ' / ' . $document->document_type->type : '' }}</span>
                                @php $i = 0; @endphp
                              @endif
                              @php $i++; @endphp
                            @endforeach
                          @else
                            <span class="badge rounded-pill bg-danger">{{ ' - ' }}</span>
                          @endif
                        </div>
                      </td>
                      <td style="display: none;">
                        <div class="">
                          @if(isset($user->person))
                            @php $i = 1; @endphp
                            @foreach($user->person->departaments as $departament)
                              @if($i == 1)
                                <span class="badge rounded-pill bg-primary">{{ isset($departament->departament) ? $departament->departament : '' }}</span>
                              @endif
                              @if($i == 2)
                                <span class="badge rounded-pill bg-secondary">{{ isset($departament->departament) ? $departament->departament : '' }}</span>
                              @endif
                              @if($i == 3)
                                <span class="badge rounded-pill bg-success">{{ isset($departament->departament) ? $departament->departament : '' }}</span>
                                @php $i = 0; @endphp
                              @endif
                              @php $i++; @endphp
                            @endforeach
                          @else
                            <span class="badge rounded-pill bg-danger">{{ ' - ' }}</span>
                          @endif
                        </div>
                      </td>
                      <td style="display: none;">
                        <span class="badge bg-light-{{ isset($user->person->status) ? ( $user->person->status == 'active' ? 'success' : 'danger' ) : 'warning'}}">
                          {{ isset($user->person->status) ? ( $user->person->status == 'active' ? 'Ativo' : 'Bloqueado' ) : '-'}}
                        </span>
                      </td>
                      <td style="display: none;">{{isset($user->created_at) ? (($user->created_at)->format('d/m/Y H:m:s')) : ''}}</td>
                      <td style="display: none;">

                        <div class="btn-group">
                          <a href="{{ route('pessoas.show',  $user->id) }}" class="btn btn-info">
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
            <i class="fas fa-times"></i> Não existem Funcionários Armazenados.
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
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/users.js')) }}"></script>
@endsection
