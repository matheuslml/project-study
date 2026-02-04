@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Galeria')

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
              <form class="auth-register-form mt-2" action="{{ route('galeria_imagens.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf()
                @method('PUT')
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Galeria</h2>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-8 mb-1">
                      <label class="form-label" for="title">Título<strong>*</strong></label>
                      <input type="text" name="title" id="title" class="form-control" value="{{ $gallery->title }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="gallery_type_id">Tipo<strong>*</strong></label>
                      <select class="form-select" id="gallery_type_id" name="gallery_type_id" required>
                        <option value="" class="">Selecione</option>
                        @foreach ($gallery_types as $gallery_type)
                          <option value="{{ $gallery_type->id }}" {{ ($gallery->gallery_type_id == $gallery_type->id) ? 'selected' : ''}} >{{ $gallery_type->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="order">Ordem<strong>* </strong><tag data-bs-toggle="tooltip" title="Abreviação da instituição"><i data-feather='info'></i></tag></label>
                      <input type="number" class="form-control" id="order" name="order" value="{{ $gallery->order }}" />
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="status">Status</label>
                      <select class="form-select" id="status" name="status" >
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT" {{ $gallery->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                        <option value="PENDING" {{ $gallery->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                        <option value="PUBLISHED" {{ $gallery->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Thumbnail<strong>*</strong><tag data-bs-toggle="tooltip" title="Tamanho 370x300px"><i data-feather='info'></i></tag></label>
                      <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/gallery/' . $gallery->image_small)}}"
                        alt="avatar img"
                      />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Thumbnail</label>
                      <input type="file" class="form-control" id="image_small" name="image_small" >
                    </div>
                      <div class="col-md-12 mb-1">
                        <label class="form-label">Imagem<strong>*</strong><tag data-bs-toggle="tooltip" title="Foto de tamanho normal"><i data-feather='info'></i></tag></label>
                        <img
                          class="img-fluid rounded mb-75"
                          src="{{asset('storage/images/gallery/' . $gallery->image_large)}}"
                          alt="avatar img"
                        />
                      </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Imagem</label>
                      <input type="file" class="form-control" id="image_large" name="image_large" >
                    </div>

                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                    <form method="POST" name="form-delete" action="{{ route('galeria_imagens.destroy', $gallery->id) }}">
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
@endsection
