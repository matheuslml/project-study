@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Liderança')

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
              <form class="auth-register-form mt-2" action="{{ route('liderancas.update', $leadership->id) }}" method="POST" enctype="multipart/form-data">
                @csrf()
                @method('PUT')
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Liderança</h2>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="name">Nome<strong>*</strong></label>
                      <input type="text" name="name" id="name" class="form-control" value="{{ $leadership->name }}" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="occupation">Ocupação<strong>*</strong></label>
                      <input type="text" name="occupation" id="occupation" class="form-control" value="{{ $leadership->occupation }}" />
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="order">Ordem<strong>* </strong><tag data-bs-toggle="tooltip" title="Abreviação da instituição"><i data-feather='info'></i></tag></label>
                      <input type="number" class="form-control" id="order" name="order" value="{{ $leadership->order }}" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Foto</label>
                      <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/leadership/' . $leadership->photo)}}"
                        alt="avatar img"
                      />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Foto</label>
                      <input type="file" class="form-control" id="photo" name="photo" >
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="type">Tipo<strong>*</strong></label>
                      <select class="form-select" id="type" name="type" required>
                        <option value="" class="">Selecione</option>
                        <option value="HEADSHIP"  {{ $leadership->type == 'HEADSHIP' ? 'selected' : '' }}>Chefia</option>
                        <option value="EMPLOYEE" {{ $leadership->type == 'EMPLOYEE' ? 'selected' : '' }} >Funcionário</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="status">Status</label>
                      <select class="form-select" id="status" name="status" >
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT" {{ $leadership->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                        <option value="PENDING" {{ $leadership->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                        <option value="PUBLISHED" {{ $leadership->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                      </select>
                    </div>

                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                    <form method="POST" name="form-delete" action="{{ route('liderancas.destroy', $leadership->id) }}">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                          onclick="return confirm('Tem certeza que deseja deletar o galeria?');">Deletar
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
  <script src="{{ asset(mix('js/scripts/tables/unit-social-media.js')) }}"></script>
@endsection
