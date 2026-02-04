@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Notícia')

@section('vendor-style')
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
              <form class="auth-register-form mt-2" action="{{ route('diarios_oficiais.store') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Cadastrar Novo Diário Oficial</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="edition">Edição<strong>*</strong></label>
                      <input type="text" name="edition" id="edition" class="form-control" required />
                    </div>
                    <div class="col-md-3 mb-1">
                        <div class="form-check form-switch pt-2">
                            <input class="form-check-input" type="checkbox" name="extra_edition" id="extra_edition">
                            <label class="form-check-label" for="extra_edition">Edição Extra</label>
                      </div>
                    </div>

                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="published_at">Data de Publicação</label>
                      <input type="date" name="published_at" id="published_at" class="form-control" />
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
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="certificate">Certificados Digitais<strong>*</strong></label>
                      <select class="form-select" id="certificate" name="certificate" required>
                        <option value="" class="">Selecione</option>
                        @foreach($certificates as $certificate)
                            <option value="{{ $certificate->id }}" {{ $certificate->id == 1 ? 'selected' : '' }}  >{{ $certificate->name . ' - ' . $certificate->description }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="description">Descrição<strong>*</strong></label>
                      <textarea  name="description" id="description" class="form-control" ></textarea>
                    </div>
                    <div class="col-md-12 pt-2 mb-1">
                        <h3>Deseja subir o Arquivo diagramado em PDF ou gerar um Diário Oficial Utilizando Atos Pendentes Cadastrados?</h3>
                    </div>
                    <div class="col-md-12 mb-2 ">
                        <div class="form-check mb-1">
                            <input class="form-check-input" value="FILE" type="radio" name="type" id="type_file" onclick="checkType('file')" checked>
                            <label class="form-check-label" for="type1">
                            PDF
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="ACTS" type="radio" name="type" id="type_acts"onclick="checkType('acts')">
                            <label class="form-check-label" for="type2">
                            Atos Pendentes
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-1"  id="div_file" >
                      <label class="form-label">PDF</label>
                      <input type="file" class="form-control" id="file" name="file" >
                    </div>
                    <div class="col-md-12 mb-1"  id="div_acts" style="display: none;">
                      <label class="form-label" for="select2-multiple">Atos<tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar os Atos previamente"><i data-feather='info'></i></tag></label>
                      <select class="select2 form-select" id="acts" name="acts[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($acts as  $act)
                            <option value="{{ $act->id }}" >{{ $act->title }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                    </div>

                  </div>
                  <div class="col-12 mt-1 pb-4">
                    <button class="btn btn-primary w-100 mt-2" type="submit" id="submit_button" tabindex="5">Cadastrar</button>
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


  <script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>

@endsection

@section('page-script')

    <script src="{{ asset(mix('js/scripts/official_diary/types_show.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/bidding-agreement-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

@endsection
