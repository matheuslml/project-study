@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Projeto')

@section('vendor-style')

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
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
              <form class="auth-register-form mt-2" action="{{ route('info_sensiveis.store') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Cadastrar Sigílo</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="title">Assunto<strong>*</strong></label>
                      <input type="text" name="title" id="title" class="form-control" required />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="description">Descrição<strong>*</strong></label>
                      <textarea name="description" maxlength="60" id="description" class="form-control" required ></textarea>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="category_id">Grau de Sigilo<tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar previamente a categoria"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="category_id" name="category_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}"  >{{ $category->degree }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="responsible_id">Responsável<tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar o responsável"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="responsible_id" name="responsible_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($responsibles as $responsible)
                          <option value="{{ $category->id }}"  >{{ $responsible->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-12 mb-1">
                      <label class="form-label">Arquivo de Sigílo</label>
                      <input type="file" class="form-control" id="file" name="file" >
                    </div>

                    <div class="col-md-12 mb-1" hidden>
                      <textarea  name="content" id="content" class="form-control" ></textarea>
                    </div>


                    <div class="col-sm-12">
                      <label class="form-label" for="category_id">Conteúdo<strong>*</strong> </label>
                      <div id="full-wrapper">
                        <div id="full-container">
                          <div class="editor" id="editor-data">
                          </div>
                        </div>
                      </div>
                    </div>







                  </div>
                  <div class="col-12 mt-1 pb-4">
                    <button class="btn btn-primary w-100 mt-2" type="submit" tabindex="5">Cadastrar</button>
                  </div>
              </form>
            </div>
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
  <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
@endsection

@section('page-script')
  <script src="{{ asset(mix('js/scripts/forms/projects-editor.js')) }}"></script>


  <script src="{{ asset(mix('js/scripts/forms/bidding-agreement-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>


@endsection
