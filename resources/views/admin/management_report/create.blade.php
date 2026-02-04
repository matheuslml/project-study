@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Relatório de Gestão')

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
              <form class="auth-register-form mt-2" action="{{ route('relatorio_de_gestao.store') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                  <div class="content-header my-5">
                      <h2 class="fw-bolder mb-75">Cadastrar Novo Relatório de Gestão</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="management_report_type_id">Tipo de Relatório<strong>*</strong></label>
                        <select class="form-select" id="management_report_type_id" name="management_report_type_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($management_report_types as $type)
                            <option value="{{$type->id}}">{{$type->type}}</option>
                        @endforeach
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
                </div>
                <div class="row mt-2">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="initial_date">Data Inicial<strong>*</strong></label>
                        <input type="date"  name="initial_date" id="initial_date" class="form-control" required />
                      </div>
                      <div class="col-md-6 mb-1">
                          <label class="form-label" for="final_date">Data Final<strong>*</strong></label>
                          <input type="date"  name="final_date" id="final_date" class="form-control" required />
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
