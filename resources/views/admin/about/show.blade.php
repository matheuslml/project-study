@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Sobre da Unidade')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- sobre media -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-8 ">
      <div class="card">
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
        <div class="card-header">
          <h4 class="card-title">Dados Sobre a Unidade: {{ $about->unit->name }}</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal" method="POST" action="{{ route('sobres.update', $about->id) }}" enctype="multipart/form-data">
            @csrf()
            @method('PUT')
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Título<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="title" value="{{ $about->title }}" class="form-control" name="title" required />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="sub_title">Sub Título<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="sub_title" value="{{ $about->sub_title }}" class="form-control" name="sub_title" required />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="description">Descrição<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <textarea type="text" id="description" class="form-control" name="description" >{{ $about->description }}</textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label">Imagem</label>
                <img
                  class="img-fluid rounded mb-75"
                  src="{{asset('storage/images/about/' . $about->image)}}"
                  alt="avatar img"
                />
              </div>
              <div class="col-6">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="image">Imagem<strong>*</strong><tag data-bs-toggle="tooltip" title="Tamanho: 1280 x 720 px"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="file" class="form-control" id="image" name="image" >
                  </div>
                </div>
              </div>

              <div class="col-md-12 mb-1">
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="status" name="status" >
                  <option value="" class="">Selecione</option>
                  <option value="DRAFT" {{ $about->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                  <option value="PENDING" {{ $about->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                  <option value="PUBLISHED" {{ $about->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                </select>
              </div>

              <div class="col-md-12 mb-1" hidden>
                <textarea  name="content" id="content" class="form-control" >{!! html_entity_decode($about->body, ENT_QUOTES, 'UTF-8') !!}</textarea>
              </div>


              <div class="col-sm-12">
                <label class="form-label" for="category_id">Conteúdo<strong>*</strong> </label>
                <div id="full-wrapper">
                  <div id="full-container">
                    <div class="editor" id="editor-data">
                    {!! html_entity_decode($about->body, ENT_QUOTES, 'UTF-8') !!}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                </form>
                <form method="POST" name="form-delete" action="{{ route('sobres.destroy', $about->id) }}">
                    @csrf()
                    @method('delete')
                    <button type="submit" class="btn btn-danger" style="position: relative; float: left;" 
                      onclick="return confirm('Tem certeza que deseja deletar?');">Deletar
                    </button>
                </form>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4 ">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Lista de Unidades</h4>
        </div>
        <div class="card-body">
        <div class="card-datatable">
        @if (count($units) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($units as $unit)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $unit->sigla }}</td>
                    <td style="display: none;">
                      <a href="{{ route('sobres.show', $unit->about->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Unidades Armazenadas no Sistema.
              </div>
            </div>
          @endif
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Vencedor ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>

  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/news-editor.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/tables/unit-about.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
