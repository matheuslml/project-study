@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Licenciamento Ambiental')

@section('vendor-style')

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">

  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">

@endsection

@section('content')
  <div class="row">

    <!-- Register-->
    <div class="col-lg-12  ">
      <div class="card ">
        <div class="card-body ">
          <!-- Register-->
          <div class="col-lg-12 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
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
              <div class="content-header mb-5">
                  <h2 class="fw-bolder mb-75">Cadastrar Novo Relatório de Licenciamento Ambiental</h2>
              </div>
            </div>
           <!-- Upload File -->
            <section>
                <div class="row px-3">
                    <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <h4 class="card-title">Adicionar Arquivo</h4>
                        </div>
                        <div class="card-body">
                        <p class="card-text">
                            Selecione o Arquivo para fazer upload.
                        </p>

                        <form action="{{ route('arquivos.store') }}" method="POST" enctype="multipart/form-data" >
                        @csrf()
                            <input type="text" name="type" id="type" class="form-control" value="enviromental_licensing" hidden />

                            <div class="col-12 mb-2 files-inputs">
                                <div class="row hdtuto control-group lst increment">
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Arquivo (Obrigatório)</label>
                                    <input type="file" name="files[document][]" class="form-control" />
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Nome do Arquivo (Obrigatório)</label>
                                    <input type="text" name="files[title][]" class="form-control" />
                                </div>
                                </div>

                                <div class=" clone hide " hidden>
                                    <div class="row deletar hdtuto control-group lst ">
                                    <div class="col-md-5 mb-1">
                                        <label class="form-label">Arquivo (Obrigatório)</label>
                                        <input type="file" name="files[document][]" class="form-control" />
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label class="form-label">Nome do Arquivo (Obrigatório)</label>
                                        <input type="text" name="files[title][]" class="form-control" />
                                    </div>
                                    <button class="col-md-1 btn btn-danger btn-delete mt-2" style="width: auto; height: 50%;" type="button"><i data-feather="delete"></i></button>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12" style="position: relative; float: left;">
                            <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 30px;"
                                onclick="return confirm('Tem certeza que deseja salvar os arquivos?');">SALVAR ARQUIVOS
                            </button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
            <!-- button file upload ends -->

<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Arquivo Cadastrado</h4>
        </div>
        <div class="card-body">
        @if (isset($enviromental_licensing->file))
          <p>Nome do Arquivo: {{ $enviromental_licensing->file->title }} - Data de Criação: {{ $enviromental_licensing->file->created_at }}</p>
          <a href="{{ route('arquivos.show', $enviromental_licensing->file->id) }}" title="Ver" class="btn btn-info btn-sm" style="color: white; "><i data-feather="search" class="font-small-4"></i> Abrir</a>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Arquivos Armazenados.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->
          </div>
        <!-- /Register-->

        </div>
      </div>
    </div>

  </div>



@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>


  <script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
@endsection

@section('page-script')
  <script src="{{ asset(mix('js/scripts/forms/projects-editor.js')) }}"></script>


  <script src="{{ asset(mix('js/scripts/forms/bidding-agreement-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/revenue-files.js')) }}"></script>


@endsection
