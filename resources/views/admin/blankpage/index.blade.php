@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Páginas em Branco')

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
<!-- blank_pages list start -->
<section class="app-blank_page-list">
  <div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{ count($blank_pages) }}</h3>
            <span>Total de Páginas</span>
          </div>
          <div class="avatar bg-light-primary p-50">
            <span class="avatar-content">
              <i data-feather="blank_page" class="font-medium-4"></i>
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
          <h4 class="card-title">Páginas em Branco - Busca Avançada</h4>
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
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($blank_pages) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Título</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Título</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($blank_pages as $blank_page)
                @if(isset($blank_page->title))
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                      <td class="control sorting_1" tabindex="0" ></td>
                      <td style="display: none;">{{ $blank_page->title }}</td>
                      <td style="display: none;">{{$blank_page->meta_keywords}}</td>
                      <td style="display: none;">{{ isset($blank_page->type) ? $blank_page->type->title : '' }}</td>
                      <td style="display: none;">{{ $blank_page->status == 'PENDING' ? 'Pendente' : ($blank_page->status == 'DRAFT' ? 'Editando' : 'Publicado') }}</td>
                      <td style="display: none;">{{isset($blank_page->created_at) ? (($blank_page->created_at)->format('d/m/Y H:m:s')) : ''}}</td>
                      <td style="display: none;">

                        <div class="btn-group">
                          <a href="{{ route('paginas.show', $blank_page->id) }}" class="btn btn-info">
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
            <i class="fas fa-times"></i> Não existem Páginas em Branco Armazenadas.
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- blank_pages list ends -->
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
  <script src="{{ asset(mix('js/scripts/tables/news.js')) }}"></script>
@endsection
