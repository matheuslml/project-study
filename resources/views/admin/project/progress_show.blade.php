@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Progresso')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">

  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- Advanced Search -->
<section id="advanced-search-datatable-progresses">
  <div class="row">
    <div class="col-md-5 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Dados do Progresso</h4>
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
          <form class="form form-horizontal" method="POST" action="{{ route('projeto_progressos.update', $progress_selected->id) }}">
            @csrf()
            @method('PUT')
            <div class="">
                <div class=" row">
                  <div class="col-md-6 mb-1">
                      <label class="form-label" for="percentage">Porcentagem<strong>*</strong></label>
                      <input type="integer" value="{{ $progress_selected->percentage }} " name="percentage" id="percentage" class="form-control" required />
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="status">Status<strong>*</strong></label>
                      <select class="form-select" id="status" name="status" >
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT" {{ $progress_selected->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                        <option value="PENDING" {{ $progress_selected->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                        <option value="PUBLISHED" {{ $progress_selected->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                      </select>
                    </div>

                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="project_id">Projetos <tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar previamente o Projeto"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="project_id" name="project_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($projects as $project)
                          <option value="{{ $project->id }}" {{ $project->id == $progress_selected->project_id ? 'selected' : '' }} >{{ $project->title }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-12 mb-1" hidden>
                      <textarea  name="content" id="content" class="form-control" >{!! html_entity_decode($progress_selected->body, ENT_QUOTES, 'UTF-8') !!}</textarea>
                    </div>


                    <div class="col-md-12 mb-2">
                      <label class="form-label" >Conteúdo<strong>*</strong> </label>
                      <div id="full-wrapper">
                        <div id="full-container">
                          <div class="editor" id="editor-data">
                            {!! html_entity_decode($progress_selected->body, ENT_QUOTES, 'UTF-8') !!}
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
          </form>
                <form method="POST" name="form-delete" action="{{ route('projeto_progressos.destroy', $progress_selected->id) }}">
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
    <div class="col-md-7 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Progressos - Busca Avançada</h4>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($progresses) >= 1)
          <table class="dt-advanced-search-progresses table">
            <thead>
              <tr>
                <th></th>
                <th>Programa</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Programa</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($progresses as $progress)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $progress->project->title }}</td>
                    <td style="display: none;">{{ $progress->created_at }}</td>
                    <td style="display: none;">
                      <a href="{{ route('projeto_progressos.show', $progress->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Progressos Armazenados.
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
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>

  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/projects-editor.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/progresses.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
