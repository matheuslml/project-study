@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Projeto')

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
              <form class="auth-register-form mt-2" action="{{ route('unid_conservacao.store') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Cadastrar Nova Unidade de Conservação</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="title">Unidade<strong>*</strong></label>
                      <input type="text"  name="title" id="title" class="form-control" required />
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="creation">Criação<strong>*</strong></label>
                      <input type="text"  name="creation" id="creation" class="form-control" required />
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="creation_link">LInk da Criação<strong>*</strong></label>
                      <input type="text"  name="creation_link" id="creation_link" class="form-control" required />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label"   for="localization">Localização<strong>*</strong></label>
                      <input type="text"  name="localization" id="localization" class="form-control" required />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="area">Area<strong>*</strong></label>
                      <input type="text" name="area" id="area" class="form-control" required />
                    </div>
                    
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="objective">Objetivo<strong>*</strong></label>
                      <textarea name="objective" id="objective" class="form-control"   required ></textarea>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="select2-multiple">Cidades de abrangência<strong>*</strong> <tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar previamente as cidades de abrangencia"><i data-feather='info'></i></tag></label>
                      <select class="select2 form-select" id="coverages" name="coverages[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($coverages as $coverage)
                            <option value="{{ $coverage->id }}" >{{ $coverage->city }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="status">Status<strong>*</strong></label>
                      <select class="form-select" id="status" name="status" >
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT">Desenvolvendo</option>
                        <option value="PENDING">Pendente</option>
                        <option value="PUBLISHED">Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Imagem para Thumb</label>
                      <input type="file" class="form-control" id="thumb" name="thumb" >
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="thumb_description">Descrição da Imagem<strong>*</strong></label>
                      <input type="text"  name="thumb_description" id="thumb_description" class="form-control" required />
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="type_id">Tipo de Unidade<strong>*</strong></label>
                      <select class="form-select" id="type_id" name="type_id" >
                        <option value="" class="">Selecione</option>
                        <option value="1">Proteção Integral</option>
                        <option value="2">Uso Estável</option>
                      </select>
                    </div>
                    <div class="content-header mb-2">
                      <h3 class="fw-bolder my-5 ">Informações da Sede</h3>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="address">Endereço<strong>*</strong></label>
                      <input type="text"  name="address" id="address" class="form-control" required />
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="phone">Telefone<strong>*</strong></label>
                      <input type="text"  name="phone" id="phone" class="form-control" required />
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="opening_hours">Horario de Funcionamento<strong>*</strong></label>
                      <input type="text"  name="opening_hours" id="opening_hours" class="form-control" required />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label"  for="email">E-mail<strong>*</strong></label>
                      <input type="text" name="email" id="email" class="form-control" required />
                    </div>
                    

                    <div class="col-md-12 mb-1" hidden>
                      <textarea  name="content" id="content" class="form-control" ></textarea>
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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
@endsection

@section('page-script')
  <script src="{{ asset(mix('js/scripts/forms/projects-editor.js')) }}"></script>


  <script src="{{ asset(mix('js/scripts/forms/bidding-agreement-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>


@endsection