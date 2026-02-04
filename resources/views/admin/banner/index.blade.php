@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Banners')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')

  <div class="row match-height">
    @foreach($banner_types as $banner_type)
      <div class="col-md-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{ $banner_type->title }}</h4>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li>
                  <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-content collapse ">
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
                <form class="form form-horizontal" method="POST" action="{{ route('banners.update', $banner_type->id) }}" enctype="multipart/form-data">
                  @csrf()
                  @method('PUT')
                  <div class="row">
                    <div class="col-md-9 mb-1">
                      <label class="form-label" for="title">Título<strong>*</strong></label>
                      <input type="text" name="title" id="title" class="form-control" value="{{ isset($banner_type->banner) ? $banner_type->banner->title : $banner_type->title }}" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="status">Status<strong>*</strong></label>
                      <select class="form-select" id="status" name="status" >
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT" {{ isset($banner_type->banner) ? ($banner_type->banner->status == 'DRAFT' ? 'selected' : '') : '' }} >Desenvolvendo</option>
                        <option value="PENDING" {{ isset($banner_type->banner) ? ($banner_type->banner->status == 'PENDING' ? 'selected' : '') : '' }} >Pendente</option>
                        <option value="PUBLISHED" {{ isset($banner_type->banner) ? ($banner_type->banner->status == 'PUBLISHED' ? 'selected' : '') : '' }} >Publicada</option>
                      </select>
                    </div>
                    @if(isset($banner_type->banner))
                      <div class="col-md-12 mb-1">
                        <label class="form-label">Imagem<strong>*</strong><tag data-bs-toggle="tooltip" title="Tamanho sugerido 1500x330"><i data-feather='info'></i></tag></label>
                        <img
                          class="img-fluid rounded mb-75"
                          src="{{asset('storage/images/banners/' . $banner_type->banner->image)}}"
                          alt="avatar img"
                        />
                      </div>
                    @endif
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Imagem<strong>*</strong><tag data-bs-toggle="tooltip" title="Tamanho sugerido 1500x330"><i data-feather='info'></i></tag></label>
                      <input type="file" class="form-control" id="image" name="image" >
                    </div>

                    <div class="col-sm-2 offset-sm-10">
                      <button type="submit" class="btn btn-primary me-1" style="width: 100%">Salvar</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach

  </div>
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>

  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
