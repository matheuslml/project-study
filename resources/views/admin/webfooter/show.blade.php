@extends('admin/layouts/contentLayoutMaster')

@section('title', 'WebFooter')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<section id="advanced-search-datatable">
    <div class="row">

        <!-- Register-->
        <div class="col-md-8">
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
                    <form class="auth-register-form mt-2" action="{{ route('webfooters.update', $web_footer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf()
                        @method('PUT')
                        <div class="content-header mb-2">
                            <h2 class="fw-bolder mb-75">WebFooter</h2>
                        </div>
                            <div class="col-md-4 mb-1">
                            <label class="form-label" for="status">Cadastrar Logos<strong>*</strong></label>
                            <a href="{{ route('web_footer_logo_create', $web_footer->id) }}" class="btn btn-primary w-100 ">Cadastrar Logos no Rodapé</a>
                            </div>

                            <div class="col-md-4 mb-1">
                            <label class="form-label" for="status">Status<strong>*</strong></label>
                            <select class="form-select" id="status" name="status" >
                                <option value="" class="">Selecione</option>
                                <option value="DRAFT" {{ $web_footer->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                                <option value="PENDING" {{ $web_footer->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                                <option value="PUBLISHED" {{ $web_footer->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                            </select>
                            </div>

                            <div class="col-md-12 mb-1">
                                <label class="form-label" for="status">Ícone Antigo<strong>*</strong></label>
                                <img
                                  class="img-fluid rounded mb-75"
                                  src="{{asset('storage/images/webfooters/' . $web_footer->float_icon_url)}}"
                                  alt="avatar img"
                                />
                            </div>
                            <div class="col-md-12 mb-1">
                                <label class="form-label" for="float_icon_url">Ícone Novo (80x100 px)<strong>*</strong></label>
                                <input type="file" id="float_icon_url" class="form-control" name="float_icon_url" />
                            </div>

                            <div class="col-md-12 mb-1" hidden>
                            <textarea  name="content_left" id="content_left" class="form-control" >{!! html_entity_decode($web_footer->content_left, ENT_QUOTES, 'UTF-8') !!}</textarea>
                            </div>


                            <div class="col-sm-12">
                            <label class="form-label" for="content_left">Conteúdo da Esquerda<strong>*</strong> </label>
                            <div id="full-wrapper-left">
                                <div id="full-container-left">
                                <div class="editor-left" id="editor-left">
                                    {!! html_entity_decode($web_footer->content_left, ENT_QUOTES, 'UTF-8') !!}
                                </div>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-12 mb-1" hidden>
                            <textarea  name="content_right" id="content_right" class="form-control" >{!! html_entity_decode($web_footer->content_right, ENT_QUOTES, 'UTF-8') !!}</textarea>
                            </div>


                            <div class="col-sm-12 mt-2">
                            <label class="form-label" for="content_right">Conteúdo da Direita<strong>*</strong> </label>
                            <div id="full-wrapper-right">
                                <div id="full-container-right">
                                <div class="editor-right" id="editor-right">
                                    {!! html_entity_decode($web_footer->content_right, ENT_QUOTES, 'UTF-8') !!}
                                </div>
                                </div>
                            </div>
                            </div>

                        </div>
                        <div class="col-12 mt-1 pb-4">
                            <button class="btn btn-primary w-100 mt-2" type="submit" tabindex="5">Editar</button>
                        </div>
                    </div>
                </div>
                <!-- /Register-->
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header border-bottom">
                <h4 class="card-title">WebFooters - Busca Avançada</h4>
                </div>
                <hr class="my-0" />
                <div class="card-datatable">
                @if (count($web_footers) >= 1)
                <table class="dt-advanced-search table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Status</th>
                        <th>Registrado em</th>
                        <th>Sistema</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Status</th>
                        <th>Registrado em</th>
                        <th>Sistema</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @php $i = 0; @endphp
                    @foreach($web_footers as $web_footer)
                        @if($i == 0)
                        @php $i = 1; @endphp
                        <tr class="odd">
                        @else
                        @php $i = 0; @endphp
                        <tr class="even">
                        @endif
                            <td class="control sorting_1" tabindex="0" ></td>
                            <td style="display: none;">{{ $web_footer->status == 'PENDING' ? 'Pendente' : ($web_footer->status == 'DRAFT' ? 'Editando' : 'Publicado') }}</td>
                            <td style="display: none;">{{ $web_footer->created_at }}</td>
                            <td style="display: none;">
                            <a href="{{ route('webfooters.show', $web_footer->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Aviso</h4>
                    <div class="alert-body">
                        Não existem WebFooter Armazenadas.
                    </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</section>




@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
  <script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
@endsection

@section('page-script')
  <script src="{{ asset(mix('js/scripts/forms/webfooter-editor.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/webfooter.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
