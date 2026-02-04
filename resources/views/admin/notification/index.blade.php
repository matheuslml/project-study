@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Notificações')

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
            <h3 class="fw-bolder mb-75">{{ count($not_readeds) }}</h3>
            <span>Não Lidas</span>
          </div>
          <div class="avatar bg-light-primary p-50">
            <span class="avatar-content">
              <i data-feather="alert-circle" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($readeds) }}</h3>
            <span>Notificações Lidas</span>
          </div>
          <div class="avatar bg-light-danger p-50">
            <span class="avatar-content">
              <i data-feather="check-circle" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($notifications) }}</h3>
            <span>Total Recebidas</span>
          </div>
          <div class="avatar bg-light-success p-50">
            <span class="avatar-content">
              <i data-feather="archive" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($sendeds) }}</h3>
            <span>Total Enviadas</span>
          </div>
          <div class="avatar bg-light-warning p-50">
            <span class="avatar-content">
              <i data-feather="send" class="font-medium-4"></i>
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
    @can('Criar Notificações')
      <div class="col-md-6 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Enviar Nova Notificação</h4>
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
            <form class="form form-horizontal" method="POST" action="{{ route('notificacoes.store') }}">
              @csrf()
              <input type="text" id="type_id" class="form-control" name="type_id" value="1" hidden required/>
              <input type="text" id="status_id" class="form-control" name="status_id" value="2" hidden required/>
              <input type="text" id="sender_id" class="form-control" name="sender_id" value="{{Auth::user()->id}}" hidden required/>
              <div class="row">
                <div class="col-12">
                  <div class="mb-1 row">
                    <div class="col-sm-3">
                      <label class="col-form-label" for="title">Título</label>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" id="title" class="form-control" name="title" placeholder="Título da Notificação" required/>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-1 row">
                    <div class="col-sm-3">
                      <label class="col-form-label" for="title">Agendar Notificação</label>
                    </div>
                    <div class="col-sm-9">
                      <input
                        type="date"
                        name="scheduled_at"
                        id="scheduled_at"
                        class="form-control"
                      />
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-1 row">
                    <div class="col-sm-3">
                      <label class="col-form-label" for="users">Usuário</label>
                    </div>
                    <div class="col-sm-9">
                      <label for="permission">
                          <span class="btn btn-primary mr-1 mb-1 select-all">Marcar Todos</span>
                          <span class="btn btn-primary mr-1 mb-1 deselect-all">Desmarcar todos</span>
                      </label>
                      <select class="select2 form-select" id="users" name="users[]" multiple="multiple" required>
                        @foreach($users as $user)
                          @if(isset($user->person))
                            <option value="{{ $user->id }}" >{{ $user->person->full_name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-1 row">
                    <div class="col-sm-3">
                      <label class="col-form-label" for="content">Conteúdo</label>
                    </div>
                    <div class="col-sm-9">
                      <textarea id="content" class="form-control" name="content" placeholder="conteúdo" /></textarea>
                    </div>
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
    @endcan
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Suas Notificações - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-body mt-2">
          <form class="dt_adv_search" method="POST">
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Usuário:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-user"
                  data-column="1"
                  placeholder="digite o nome"
                  data-column-index="0"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Notificação:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-notification"
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
                <label class="form-label">Tipo:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-type"
                  data-column="4"
                  placeholder=""
                  data-column-index="3"
                />
              </div>
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
        @if (count($notifications) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Usuário</th>
                <th>Notificação</th>
                <th>Status</th>
                <th>Tipo</th>
                <th>Conteúdo</th>
                <th>Registrado em</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Usuário</th>
                <th>Notificação</th>
                <th>Status</th>
                <th>Tipo</th>
                <th>Conteúdo</th>
                <th>Enviado em</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($notifications as $notification)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" onclick="readNotification('{{ $notification->id }}')" ></td>
                    <td style="display: none;">{{ isset($notification->sender->person) ? $notification->sender->person->full_name : $notification->sender->name }}</td>
                    <td style="display: none;">{{ $notification->title }}</td>
                    <td style="display: none;">{{ $notification->status->status }}</td>
                    <td style="display: none;">{{ $notification->type->title }}</td>
                    <td style="display: none;">{{ $notification->content }}</td>
                    <td style="display: none;">{{ isset($notification->scheduled_at) ? $notification->scheduled_at : $notification->created_at }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Notificações Armazenados.
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
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/notifications.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/notifications/notifications.js')) }}"></script>
@endsection