@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Despesa')

@section('vendor-style')

<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
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
              <form class="auth-register-form mt-2" action="{{ route('atos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados do Novo Ato</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="title">Título<strong>*</strong></label>
                      <input type="text" name="title" id="title" class="form-control" required />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="status">Status<strong>*</strong></label>
                      <select class="form-select" id="status" name="status" required>
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT"  >Desenvolvendo</option>
                        <option value="PENDING"  >Pendente</option>
                        <option value="PUBLISHED"  >Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="act_type">Tipo<strong>*</strong></label>
                      <select class="form-select" id="act_type" name="act_type" required>
                        <option value="" class="">Selecione</option>
                        <option value="OFFICIAL"  >Oficial</option>
                        <option value="NEWS"  >Notícias</option>
                        <option value="OTHER"  >Outro</option>
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="genre">Lista de Tópicos<strong>* </strong><tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar previamente os tópicos dos atos"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="act_topic_id" name="act_topic_id" >
                        <option value="" class="">Selecione</option>
                        @foreach ($act_topics as $topic)
                              <option value="{{ $topic['id'] }}" >{{ $topic['title'] }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="published_at">Data de Publicação</label>
                      <input type="datetime-local" name="published_at" id="published_at" class="form-control" />
                    </div>

                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="order">Ordem</label>
                      <input type="number" name="order" id="order" class="form-control" required />
                    </div>

                    <div class="col-md-12 mb-1" hidden>
                      <textarea  name="content" id="content" class="form-control" ></textarea>
                    </div>


                    <div class="col-sm-12">
                      <label class="form-label" for="">Conteúdo </label>
                      <div id="full-wrapper">
                        <div id="full-container">
                          <div class="editor" id="editor-data">
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <button class="btn btn-primary w-100 mt-2" type="submit" tabindex="5">Cadastrar</button>
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
<script src="{{ asset(mix('js/scripts/forms/news-editor.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/expense-input-mask.js')) }}"></script>
@endsection
