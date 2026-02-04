@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Legislação')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
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
              <form class="auth-register-form mt-2" action="{{ route('legislacoes.store') }}" method="POST" >
                @csrf()
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Nova Legislação</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="ementa">Ementa</label>
                      <input type="text" name="ementa" id="ementa" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="number">Valor Bruto</label>
                      <input type="text" class="form-control number" placeholder="10" id="number" name="number" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="number_complement">Complemento</label>
                      <input type="text" class="form-control number" placeholder="10" id="number_complement" name="number_complement" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="category_id">Categorias</label>
                      <select class="form-select" id="category_id" name="category_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}" >{{ $category->category }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="situation_id">Situações</label>
                      <select class="form-select" id="situation_id" name="situation_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}" >{{ $category->category }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-8 mb-1">
                      <label class="form-label" for="select2-multiple">Assuntos</label>
                      <select class="select2 form-select" id="subjects" name="subjects[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($subjects as  $subject)
                            <option value="{{ $subject->id }}" {{ (in_array($subject->id, old('subject', [])) || isset($legislation) && $legislation->subjects->contains($subject->id)) ? 'selected' : '' }} >{{ $subject->subject }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="date">Data de Recolhimento</label>
                      <input type="date" name="date" id="date" class="form-control" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="initial_term">Início</label>
                      <input type="date" name="initial_term" id="initial_term" class="form-control" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="final_term">Fim</label>
                      <input type="date" name="final_term" id="final_term" class="form-control" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="active">Status</label>
                      <select class="form-select" id="active" name="active" >
                        <option value="" class="">Selecione</option>
                        <option value="0" >Desativado</option>
                        <option value="1" >Ativado</option>
                      </select>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="information">Informação</label>
                      <textarea type="text" class="form-control number" placeholder="10" id="information" name="information" ></textarea>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="select2-multiple">Departamentos</label>
                      <select class="select2 form-select" id="departaments" name="departaments[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($departaments as  $departament)
                            <option value="{{ $departament->id }}" {{ (in_array($departament->id, old('departament', [])) || isset($legislation) && $legislation->departaments->contains($departament->id)) ? 'selected' : '' }} >{{ $departament->departament }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="select2-multiple">Autores</label>
                      <select class="select2 form-select" id="authors" name="authors[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($authors as  $author)
                            <option value="{{ $author->id }}" {{ (in_array($author->id, old('author', [])) || isset($legislation) && $legislation->authors->contains($author->id)) ? 'selected' : '' }} >{{ $author->author }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Conteúdo do Documento</label>
                      <div id="full-wrapper">
                        <div id="full-container">
                          <div class="editor">
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
<script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/forms/legislation-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-quill-editor.js')) }}"></script>
@endsection
