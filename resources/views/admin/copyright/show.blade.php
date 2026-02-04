@extends('admin/layouts/contentLayoutMaster')

@section('title', 'copyright')

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
              <form class="auth-register-form mt-2" action="{{ route('copyrights.update', $copyright_selected->id) }}" method="POST" enctype="multipart/form-data">
                @csrf()
                @method('PUT')
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Copyright</h2>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-8 mb-1">
                      <label class="form-label" for="company_name">Nome<strong>*</strong></label>
                      <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $copyright_selected->company_name }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="year">Ano<strong>*</strong></label>
                      <input type="text" name="year" id="year" class="form-control" value="{{ $copyright_selected->year }}" />
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="link_url">Link<strong>*</strong></label>
                      <input type="text" name="link_url" id="link_url" class="form-control" value="{{ $copyright_selected->link_url }}" />
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="status">Status</label>
                      <select class="form-select" id="status" name="status" >
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT" {{ $copyright_selected->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                        <option value="PENDING" {{ $copyright_selected->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                        <option value="PUBLISHED" {{ $copyright_selected->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Logo Antiga<strong>*</strong><tag data-bs-toggle="tooltip" title="Tamanho 370x300px"><i data-feather='info'></i></tag></label>
                      <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/copyrights/' . $copyright_selected->logo_url)}}"
                        alt="avatar img"
                      />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Logo</label>
                      <input type="file" class="form-control" id="logo" name="logo" >
                    </div>

                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                    <form method="POST" name="form-delete" action="{{ route('copyrights.destroy', $copyright_selected->id) }}">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                          onclick="return confirm('Tem certeza que deseja deletar o Copyright?');">Deletar
                        </button>
                    </form>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
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
