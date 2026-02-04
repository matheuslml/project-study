@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Web Footer Logos')

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
          <h4 class="card-title">Cadastrar Logos do Rodapé</h4>
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
          <form class="form form-horizontal" method="POST" action="{{ route('webfooter_logos.store') }}" enctype="multipart/form-data">
            @csrf()

            <input type="text" value="{{ $web_footer->id }}" id="web_footer_id" name="web_footer_id" hidden />
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Título<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="title" class="form-control" name="title" placeholder="Título da Logo" />
                  </div>
                </div>
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="link_url">Link<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="link_url" class="form-control" name="link_url" />
                  </div>
                </div>
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="status">Status<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <select class="form-select" id="status" name="status" >
                      <option value="" class="">Selecione</option>
                      <option value="DRAFT"  >Desenvolvendo</option>
                      <option value="PENDING"  >Pendente</option>
                      <option value="PUBLISHED"  >Publicada</option>
                    </select>
                  </div>
                </div>
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Logo<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="file" id="logo" class="form-control" name="logo" />
                  </div>
                </div>
              </div>
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Salvar</button>
          </form>
                <form method="POST" name="form-delete" action="{{ route('webfooter_logos.destroy', $web_footer->id) }}">
                    @csrf()
                    @method('delete')
                    <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                      onclick="return confirm('Tem certeza que deseja deletar a Categoria?');">Deletar
                    </button>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Logos - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-body mt-2">
          <form class="dt_adv_search" method="POST" >
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Título:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-title"
                  data-column="1"
                  placeholder="digite o title"
                  data-column-index="0"
                />
              </div>
            </div>
          </form>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (isset($web_footer->logos))
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Título</th>
                <th>status</th>
                <th>logo</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Título</th>
                <th>status</th>
                <th>logo</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($web_footer->logos as $logo)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $logo->title }}</td>
                    <td style="display: none;">{{ $logo->status }}</td>
                    <td style="display: none;">
                        <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/webfooters/' . $logo->logo_url)}}"
                        alt="avatar img"
                        />
                    </td>
                    <td style="display: none;">{{ $logo->created_at }}</td>
                    <td style="display: none;">
                      <a href="{{ route('webfooter_logos.show', $logo->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Categorias Armazenadas.
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
  <script src="{{ asset(mix('js/scripts/tables/webfooterlogos.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
