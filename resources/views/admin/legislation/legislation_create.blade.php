@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Legislação')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
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
              <form class="auth-register-form mt-2" action="{{ route('legislacoes.store') }}" method="POST" >
                @csrf()
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Nova Legislação</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="ementa">Ementa<strong>*</strong></label>
                      <input type="text" name="ementa" id="ementa" class="form-control" placeholder="Ementa" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="number">Número</label>
                      <input type="number" class="form-control" placeholder="10" id="number" name="number" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="number_complement">Complemento</label>
                      <input type="text" class="form-control" placeholder="complemento" id="number_complement" name="number_complement" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="category_id">Categorias<strong>*</strong><tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar previamente a categoria"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="category_id" name="category_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}" >{{ $category->category }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="situation_id">Situações<strong>*</strong><tag data-bs-toggle="tooltip" title="Não se esqueça de cadastar previamente as situações"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="situation_id" name="situation_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($situations as $situation)
                          <option value="{{ $situation->id }}" >{{ $situation->situation }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-8 mb-1">
                      <label class="form-label" for="select2-multiple">Assuntos<strong>*</strong> <tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar previamente os assuntos"><i data-feather='info'></i></tag></label>
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
                      <label class="form-label" for="status">Status<strong>*</strong></label>
                      <select class="form-select" id="status" name="status" required>
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT"  >Desenvolvendo</option>
                        <option value="PENDING"  >Pendente</option>
                        <option value="PUBLISHED"  >Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="information">Informação</label>
                      <textarea type="text" class="form-control" placeholder="Informações sobre a lei ou decreto" id="information" name="information" ></textarea>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="select2-multiple">Unidades<strong>* </strong><tag data-bs-toggle="tooltip" title="Qual unidade esta em vigor"><i data-feather='info'></i></tag></label>
                      <select class="select2 form-select" id="units" name="units[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($units as  $unit)
                            <option value="{{ $unit->id }}" {{ (in_array($unit->id, old('unit', [])) || isset($legislation) && $legislation->units->contains($unit->id)) ? 'selected' : '' }} >{{ $unit->name }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="select2-multiple">Autores<strong>* </strong><tag data-bs-toggle="tooltip" title="Selecione o autor"><i data-feather='info'></i></tag></label>
                      <select class="select2 form-select" id="authors" name="authors[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($authors as  $author)
                            <option value="{{ $author->id }}" {{ (in_array($author->id, old('author', [])) || isset($legislation) && $legislation->authors->contains($author->id)) ? 'selected' : '' }} >{{ $author->author }}</option>
                          @endforeach
                        </optgroup>
                      </select>
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
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/forms/legislation-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
