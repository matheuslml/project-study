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
    <!-- fazer aqui a verificação por rules -->
    @role('Guarda')
      @if(Auth::user()->orderlies->contains($orderly_selected->id))
        @foreach(Auth::user()->orderlies as $orderly)
          @if(($orderly->id == $orderly_selected->id) && ($orderly->pivot->status == 'aguardando'))
            <div class="col-lg-3 col-sm-6">
                  <div class="card bg-warning text-white">
                      <div class="card-body d-flex align-items-center justify-content-between">
                          <div>
                              <h3 class="fw-bolder mb-75 text-white">AGUARDANDO CONFIRMAÇÃO</h3>
                              <span>espere a confirmação</span>
                          </div>
                          <div class="avatar bg-light-primary p-50">
                              <span class="avatar-content" >
                              <i data-feather="user-check" class="font-medium-4 text-white"></i>
                              </span>
                          </div>
                      </div>
                  </div>
            </div>
          @endif
          @if(($orderly->id == $orderly_selected->id) && ($orderly->pivot->status == 'pré cadastrado'))
            <div class="col-lg-3 col-sm-6">
                <a class="avatar-content" href="{{ route('cop_preconfirm', [$orderly_selected->id, Auth::user()->id]) }}">
                  <div class="card bg-info text-white">
                      <div class="card-body d-flex align-items-center justify-content-between">
                          <div>
                              <h3 class="fw-bolder mb-75 text-white">PRÉ CADASTRADO</h3>
                              <span>confirme o pré cadastro</span>
                          </div>
                          <div class="avatar bg-light-primary p-50">
                              <span class="avatar-content" >
                              <i data-feather="user-check" class="font-medium-4 text-white"></i>
                              </span>
                          </div>
                      </div>
                  </div>
                </a>
            </div>
          @endif
          @if(($orderly->id == $orderly_selected->id) && ($orderly->pivot->status == 'confirmado'))
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-success text-white">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75 text-white">CADASTRADO</h3>
                            <span>cadastro confirmado</span>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <span class="avatar-content" >
                            <i data-feather="user-check" class="font-medium-4 text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
          @endif
        @endforeach
      @endif
      @if(!(Auth::user()->orderlies->contains($orderly_selected->id)) && ($orderly_selected->type != 'limitada'))
          <div class="col-lg-3 col-sm-6">
              <a class="avatar-content" href="{{ route('cop_register', [$orderly_selected->id, Auth::user()->id]) }}">
                  <div class="card">
                      <div class="card-body d-flex align-items-center justify-content-between">
                          <div>
                              <h3 class="fw-bolder mb-75">CADASTRE-SE</h3>
                              <span>pré-registro de guardas</span>
                          </div>
                          <div class="avatar bg-light-primary p-50">
                              <span class="avatar-content" >
                              <i data-feather="user-plus" class="font-medium-4"></i>
                              </span>
                          </div>
                      </div>
                  </div>
              </a>
          </div>
      @endif
    @endrole
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($cops) }}</h3>
            <span>Total de Guardas</span>
          </div>
          <div class="avatar bg-light-info p-50">
            <span class="avatar-content">
              <i data-feather="users" class="font-medium-4"></i>
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
            <span>Guardas Confirmados</span>
          </div>
          <div class="avatar bg-light-success p-50">
            <span class="avatar-content">
              <i data-feather="user-check" class="font-medium-4"></i>
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
            <span>Guardas Aguardando</span>
          </div>
          <div class="avatar bg-light-danger p-50">
            <span class="avatar-content">
              <i data-feather="user-minus" class="font-medium-4"></i>
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
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">RAS Cadastrado</h4>
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
          <form class="form form-horizontal" method="POST" action="{{ route('ras.update', $orderly_selected->id) }}">
            @csrf()
            @method('PUT')
            <input type="text" id="admin_id" name="admin_id" value="{{ Auth::user()->id }}" hidden/>
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Título</label>
                  </div>
                  <div class="col-sm-9">
                    <input 
                        type="text" 
                        id="title" 
                        class="form-control" 
                        name="title" 
                        value="{{ $orderly_selected->title }}" 
                        @role('Guarda')
                        {{ 'disabled' }}
                        @endrole
                    />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row ">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="vacancy">Vagas</label>
                    </div>
                    <div class="input-group" style="width: 50%;">
                        <input 
                            type="number" 
                            class="touchspin-min-max" 
                            id="vacancy" 
                            name="vacancy" 
                            value="{{ $orderly_selected->vacancy }}" 
                            @role('Guarda')
                            {{ 'disabled' }}
                            @endrole
                        />
                    </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="departament_id">Tipo</label>
                  </div>
                  <div class="col-sm-9">
                    <select class="select2 form-select" id="time_id" name="time_id" 
                      @role('Guarda')
                        {{ 'disabled' }}
                      @endrole>
                        @foreach($times as $time)
                            <option value="{{ $time->id }}" {{ $orderly_selected->time_id === $time->id ? 'selected' : '' }}>{{ $time->period }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="departament_id">Inicía em</label>
                  </div>
                  <div class="col-sm-9">
                    <input
                        type="text"
                        id="started_at"
                        name="started_at"
                        class="form-control flatpickr-date-time" 
                        value="{{ isset($orderly_selected->started_at) ? $orderly_selected->started_at : '' }}"
                        @role('Guarda')
                        {{ 'disabled' }}
                        @endrole
                    />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="departament_id">Finaliza em</label>
                  </div>
                  <div class="col-sm-9">
                    <input
                        type="text"
                        id="ended_at"
                        name="ended_at"
                        class="form-control flatpickr-date-time"
                        value="{{ isset($orderly_selected->ended_at) ? $orderly_selected->ended_at : '' }}"
                        @role('Guarda')
                        {{ 'disabled' }}
                        @endrole
                    />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="active">Status</label>
                  </div>
                  <div class="col-sm-9">
                    <select class="select2 form-select" id="active" name="active" 
                        @role('Guarda')
                        {{ 'disabled' }}
                        @endrole>
                      <option value="0" {{ $orderly_selected->active === 0 ? 'selected' : '' }}>Desativado</option>
                      <option value="1" {{ $orderly_selected->active === 1 ? 'selected' : '' }}>Ativado</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="type">Classificação</label>
                  </div>
                  <div class="col-sm-9">
                    <select class="select2 form-select" id="type" name="type" 
                        @role('Guarda')
                        {{ 'disabled' }}
                        @endrole>
                        <option value="aberta" {{$orderly_selected->type === 'aberta' ? 'selected' : '' }}>Aberta</option>
                        <option value="limitada" {{$orderly_selected->type === 'limitada' ? 'selected' : '' }}>Limitada</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="location">Localização</label>
                  </div>
                  <div class="col-sm-9">
                    <input
                        type="text"
                        id="location"
                        name="location"
                        value="{{ $orderly_selected->location }}"
                        class="form-control"
                        @role('Guarda')
                        {{ 'disabled' }}
                        @endrole
                    />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="description">Descrição</label>
                  </div>
                  <div class="col-sm-9">
                    <textarea
                    data-length="400"
                    class="form-control char-textarea"
                    id="description"
                    name="description"
                    rows="3"
                    style="height: 100px"
                        @role('Guarda')
                        {{ 'disabled' }}
                        @endrole
                    >{{ $orderly_selected->description }}</textarea>
                  </div>
                </div>
              </div>
              <div class="col-sm-9 offset-sm-3">
                <button 
                    type="submit" 
                    class="btn btn-primary me-1" 
                    style="position: relative; float: left;"
                        @role('Guarda')
                        {{ 'hidden' }}
                        @endrole
                    >Editar</button>
                </form>
                <form method="POST" name="form-delete" action="{{ route('ras.destroy', $orderly_selected->id) }}">
                    @csrf()
                    @method('delete')
                    <button 
                        type="submit" 
                        class="btn btn-danger me-1" 
                        style="position: relative; float: left;"
                        @role('Guarda')
                        {{ 'hidden' }}
                        @endrole
                        >Deletar</button>
                </form>
                <a 
                    href="{{ route('cop_register', [$orderly_selected->id, Auth::user()->id]) }}" 
                    class="btn btn-primary me-1" 
                    style="position: relative; float: left;"
                        @role('Guarda')
                        {{ !(Auth::user()->orderlies->contains($orderly_selected->id)) && ($orderly_selected->type != 'limitada') ?  : 'hidden' }}
                        @endrole
                        @role('Administrador')
                        {{ 'hidden' }}
                        @endrole
                    >Cadastre-se</a>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-12">
    @role('Administrador')
      <div class="card">
          <div class="card-header">
            <h4 class="card-title">Cadastrar Guardas</h4>
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
            <form class="form form-horizontal" method="POST" action="{{ route('cop_add') }}">
              @csrf()
              <input type="text" id="orderly_id" name="orderly_id" value="{{ $orderly_selected->id }}" hidden/>
              <div class="row">
                <div class="col-12">
                  <div class="mb-1 row">
                    <div class="col-sm-3">
                      <label class="col-form-label" for="departament_id">Adicionar Guardas</label>
                    </div>
                    <div class="col-sm-9">
                      <select class="select2 form-select" id="cops" name="cops[]" multiple>
                          @foreach($cops_all as $cop)
                            @if(!($cop->orderlies->contains($orderly_selected->id)))
                              <option value="{{ $cop->id }}" >{{ isset($cop->person->social_name) ? $cop->person->social_name : $cop->person->full_name }}</option>
                            @endif
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-9 offset-sm-3">
                  <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Cadastrar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header border-bottom">
            <h4 class="card-title">Guardas - Cadastrados</h4>
          </div>
          <!--Search Form -->
          <div class="card-body mt-2">
            <form class="dt_adv_search" method="POST">
              <div class="row g-1 mb-md-1">
                <div class="col-md-4">
                  <label class="form-label">Guarda:</label>
                  <input
                    type="text"
                    class="form-control dt-input dt-cop"
                    data-column="1"
                    placeholder="digite o nome"
                    data-column-index="0"
                  />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Matrícula:</label>
                  <input
                    type="text"
                    class="form-control dt-input dt-code"
                    data-column="2"
                    placeholder=""
                    data-column-index="1"
                  />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Status:</label>
                  <input
                    type="text"
                    class="form-control dt-input dt-status"
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
          @if (count($cops) >= 1)
            <table class="dt-advanced-search table">
              <thead>
                <tr>
                  <th></th>
                  <th>Guarda</th>
                  <th>Matrícula</th>
                  <th>Status</th>
                  <th>Registrado em</th>
                  <th>Sistema</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Guarda</th>
                  <th>Matrícula</th>
                  <th>Status</th>
                  <th>Registrado em</th>
                  <th>Sistema</th>
                </tr>
              </tfoot>
              <tbody>
                @php $i = 0; @endphp
                @foreach($cops as $cop)
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                      <td class="control sorting_1" tabindex="0" ></td>
                      <td style="display: none;">{{ $cop->person->full_name }}</td>
                      <td style="display: none;">{{ $cop->person->documents->where('document_type_id', 8)->first()->document }}</td>
                      <td style="display: none;">{{ $cop->orderlies->first()->pivot->status }}</td>
                      <td style="display: none;">{{ $cop->orderlies->first()->pivot->created_at }}</td>
                      <td style="display: none;">
                        <a href="{{ route('pessoas.show', $cop->id) }}" title="Ver" class="btn btn-info btn-sm" style="color: white; "><i data-feather="search" class="font-small-4"></i></a>
                        
                        <div class="btn-group dropup dropdown-icon-wrapper">
                          <button
                            type="button"
                            class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i data-feather="more-vertical" class="dropdown-icon"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a 
                              href="{{ route('cop_confirm', [$orderly_selected->id, $cop->id, Auth::user()->id]) }}" 
                              class="dropdown-item" 
                              data-bs-toggle="tooltip" 
                              data-bs-placement="left"  
                              title="Confirmar">
                              <i data-feather="user-check"></i>
                            </a>
                            <a href="{{ route('cop_rejected', [$orderly_selected->id, $cop->id, Auth::user()->id]) }}" 
                              class="dropdown-item" 
                              data-bs-toggle="tooltip" 
                              data-bs-placement="left"  
                              title="Rejeitar">
                              <i data-feather="user-minus"></i>
                            </a>
                            <a href="{{ route('cop_canceled', [$orderly_selected->id, $cop->id, Auth::user()->id]) }}" 
                              class="dropdown-item" 
                              data-bs-toggle="tooltip" 
                              data-bs-placement="left"  
                              title="Cancelar">
                              <i data-feather="user-x"></i>
                            </a>
                            <a href="{{ route('cop_missed', [$orderly_selected->id, $cop->id, Auth::user()->id]) }}" 
                              class="dropdown-item" 
                              data-bs-toggle="tooltip" 
                              data-bs-placement="left"  
                              title="Faltou">
                              <i data-feather="x"></i>
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            @else
              <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Aviso</h4>
                <div class="alert-body">
                  Não existem Guardas Armazenados.
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    @endrole
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
  <script src="{{ asset(mix('js/scripts/tables/orderly-cops.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>
  <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/components/components-tooltips.js'))}}"></script>
@endsection
