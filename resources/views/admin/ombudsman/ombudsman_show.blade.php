@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Unidade')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-8 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Dados da Manifestação</h4>
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
          <div class="row">
            <div class="col-12">
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="title">Manifestação</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" value="{{ $ombudsman->title }}" id="title" class="form-control" name="title" placeholder="Nome da Maifestação" disabled />
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="name">Nome do Manifestante</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" value="{{ $ombudsman->name }}" id="name" class="form-control" name="name" placeholder="Nome" disabled/>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="email">E-mail</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" value="{{ $ombudsman->email }}" id="email" class="form-control" name="email" placeholder="E-mail" disabled/>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="access_id">Acesso</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" value="{{ $ombudsman->type_access->title }}" id="access_id" class="form-control" name="access_id" placeholder="Acesso" disabled/>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="request_id">Requerimento</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" value="{{ $ombudsman->type_request->title }}" id="request_id" class="form-control" name="request_id" placeholder="Requerimento" disabled/>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="content">Mensagem</label>
                </div>
                <div class="col-sm-9">
                  <textarea  id="content" class="form-control" name="content" placeholder="Mensagem" disabled>{{ $ombudsman->content }}</textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
