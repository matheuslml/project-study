@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Página')

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
              <form class="auth-register-form mt-2" action="{{ route('paginas.update', $blank_page->id) }}" method="POST" enctype="multipart/form-data">
                @csrf()
                @method('PUT')
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Cadastrar Nova Página</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-8 mb-1">
                      <label class="form-label" for="title">Assunto</label>
                      <input type="text" value="{{ $blank_page->title }}" name="title" id="title" class="form-control" required />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="meta_keywords">Nome da Página</label>
                      <input type="text" value="{{ $blank_page->meta_keywords }}" name="meta_keywords" id="meta_keywords" class="form-control" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="description">Descrição</label>
                      <textarea  name="description" id="description" class="form-control"  >{{ $blank_page->description }}</textarea>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="blank_page_type_id">Categoria</label>
                      <select class="form-select" id="blank_page_type_id" name="blank_page_type_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($types as $type)
                          <option value="{{ $type->id }}" {{ $type->id == $blank_page->blank_page_type_id ? 'selected' : '' }} >{{ $type->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="status">Status</label>
                      <select class="form-select" id="status" name="status" >
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT" {{ $blank_page->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                        <option value="PENDING" {{ $blank_page->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                        <option value="PUBLISHED" {{ $blank_page->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="link_url">Link<tag data-bs-toggle="tooltip" title="Link para domínio externo"><i data-feather='info'></i></tag></label>
                      <input type="text" value="{{ $blank_page->link_url }}" name="link_url" id="link_url" class="form-control" />
                    </div>
                    <div class="col-md-2 mb-1">
                        <label class="form-label" for="only_link">Apenas link<tag data-bs-toggle="tooltip" title="Selecione para ter apenas o link externo"><i data-feather='info'></i></tag></label>
                        <input class="form-check-input form-control" type="checkbox"  id="only_link" name="only_link" {{ $blank_page->only_link ? 'checked' : '' }}>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Imagem da Thumb</label>
                      <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/blankpages/' . $blank_page->image)}}"
                        alt="avatar img"
                      />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Alterar Imagem para Thumb</label>
                      <input type="file" class="form-control" id="image" name="image" >
                    </div>

                    <div class="col-md-12 mb-1" hidden>
                      <textarea  name="content" id="content" class="form-control" >{!! html_entity_decode($blank_page->body, ENT_QUOTES, 'UTF-8') !!}</textarea>
                    </div>


                    <div class="col-sm-12">
                      <label class="form-label" for="category_id">Conteúdo</label>
                      <div id="full-wrapper">
                        <div id="full-container">
                          <div class="editor" id="editor-data">
                          {!! html_entity_decode($blank_page->body, ENT_QUOTES, 'UTF-8') !!}
                          </div>
                        </div>
                      </div>
                    </div>







                  </div>
                  <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                    <form method="POST" name="form-delete" action="{{ route('paginas.destroy', $blank_page->id) }}">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                          onclick="return confirm('Tem certeza que deseja deletar a Página?');">Deletar
                        </button>
                    </form>
                  </div>
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


  <script src="{{ asset(mix('js/scripts/forms/bidding-agreement-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>


@endsection
