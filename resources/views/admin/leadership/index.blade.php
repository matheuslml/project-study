@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Lideranças')

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
<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cadastrar Nova Liderança</h4>
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
          <form class="form form-horizontal" method="POST" action="{{ route('liderancas.store') }}" enctype="multipart/form-data">
            @csrf()
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="name">Nome<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="name" class="form-control" name="name" placeholder="Nome do Unidade" required />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="occupation">Ocupação<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="occupation" class="form-control" name="occupation" placeholder="Nome do Unidade" required />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="order">Ordem<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="number" id="order" class="form-control" name="order" required />
                  </div>
                </div>
              </div>
              <div class="col-md-12 mb-1">
                <label class="form-label">Foto<tag data-bs-toggle="tooltip" title="Tamanho ideal 740x740px"><i data-feather='info'></i></tag></label>
                <input type="file" class="form-control" id="photo" name="photo" required>
              </div>
              <div class="col-md-12 mb-1">
                <label class="form-label" for="type">Tipo<strong>*</strong></label>
                <select class="form-select" id="type" name="type" required>
                  <option value="" class="">Selecione</option>
                  <option value="HEADSHIP"  >Chefia</option>
                  <option value="EMPLOYEE"  >Funcionário</option>
                </select>
              </div>
              <div class="col-md-12 mb-1">
                <label class="form-label" for="status">Status<strong>*</strong></label>
                <select class="form-select" id="status" name="status" required>
                  <option value="" class="">Selecione</option>
                  <option value="DRAFT"  >Desenvolvendo</option>
                  <option value="PENDING"  >Pendente</option>
                  <option value="PUBLISHED"  >Publicada</option>
                </select>
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
    <div class="col-md-8 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Lideranças - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-body mt-2">
          <form class="dt_adv_search" method="POST" >
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Name:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-name"
                  data-column="1"
                  placeholder="digite o nome"
                  data-column-index="0"
                />
              </div>
            </div>
          </form>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($leaderships) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Foto</th>
                <th>Ocupação</th>
                <th>Ordem</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Foto</th>
                <th>Ocupação</th>
                <th>Ordem</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($leaderships as $leadership)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $leadership->name }}</td>
                    <td style="display: none;">
                      <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/leadership/' . $leadership->photo)}}"
                        alt="avatar img"
                      />
                    </td>
                    <td style="display: none;">{{ $leadership->occupation }}</td>
                    <td style="display: none;">{{ $leadership->order }}</td>
                    <td style="display: none;">{{ $leadership->type == 'HEADSHIP' ? 'Chefia': 'Funcionário' }}</td>
                    <td style="display: none;">{{ $leadership->status == 'PENDING' ? 'Pendente' : ($leadership->status == 'DRAFT' ? 'Editando' : 'Publicado') }}</td>
                    <td style="display: none;">{{ $leadership->created_at }}</td>
                    <td style="display: none;">
                      <a href="{{ route('liderancas.show', $leadership->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Lideranças Armazenadas.
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
  <script src="{{ asset(mix('js/scripts/tables/leaderships.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
@endsection
