@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Atalho')

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
          <h4 class="card-title">Cadastrar Novo Atalho</h4>
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
          <form class="form form-horizontal" method="POST" action="{{ route('web_atalhos.store') }}" enctype="multipart/form-data">
            @csrf()
            <div class="row">
              <div class="col-md-12 mb-1">
                <label class="col-form-label" for="title">Nome<strong>*</strong></label>
                <input type="text" id="title" class="form-control" name="title" placeholder="Nome do Unidade" required />
              </div>
              <div class="col-md-12 mb-1">
                <label class="col-form-label" for="link_url">Link<strong>*</strong></label>
                <input type="text" id="link_url" class="form-control" name="link_url" placeholder="Link de Acesso" required />
              </div>
              <div class="col-md-12 mb-1">
                <label class="col-form-label" for="order">Ordem<strong>*</strong><tag data-bs-toggle="tooltip" title="Ordem a aparecer no site"><i data-feather='info'></i></tag></label>
                <input type="number" id="order" class="form-control" name="order" required />
              </div>
              <div class="col-md-12 mb-1">
                <label class="form-label">Ícone<strong>*</strong></label>
                <input type="file" class="form-control" id="image_icon" name="image_icon" required>
              </div>
              <div class="col-md-12 mb-1">
                <label class="form-label" for="status">Status<strong>*</strong></label>
                <select class="form-select" id="status" name="status" >
                  <option value="" class="">Selecione</option>
                  <option value="DRAFT"  >Desenvolvendo</option>
                  <option value="PENDING"  >Pendente</option>
                  <option value="PUBLISHED"  >Publicada</option>
                </select>
              </div>
              <div class="col-sm-12">
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
          <h4 class="card-title">Atalhos - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-body mt-2">
          <form class="dt_adv_search" method="POST" >
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Name:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-title"
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
        @if (count($shortcut_webs) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Ordem</th>
                <th>Ícone</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Ordem</th>
                <th>Ícone</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($shortcut_webs as $shortcut)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $shortcut->title }}</td>
                    <td style="display: none;">{{ $shortcut->order }}</td>
                    <td style="display: none;">
                      <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/shortcutweb/' . $shortcut->img_url)}}"
                        alt="avatar img"
                      />
                    </td>
                    <td style="display: none;">{{ $shortcut->status == 'PENDING' ? 'Pendente' : ($shortcut->status == 'DRAFT' ? 'Editando' : 'Publicado') }}</td>
                    <td style="display: none;">{{ $shortcut->created_at }}</td>
                    <td style="display: none;">
                      <a href="{{ route('web_atalhos.show', $shortcut->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Imagens Armazenadas.
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
  <script src="{{ asset(mix('js/scripts/tables/gallery.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
@endsection
