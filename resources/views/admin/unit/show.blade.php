@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Unidade')

@section('vendor-style')
  {{-- Page Css files --}}
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

@endsection

@section('page-style')
  {{-- Page Css files --}}
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
              <form class="auth-register-form mt-2" action="{{ route('unidades.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf()
                @method('PUT')
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Unidade</h2>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-8 mb-1">
                      <label class="form-label" for="name">Unidade<strong>*</strong></label>
                      <input type="text" name="name" id="name" class="form-control" value="{{ $unit->name }}" />
                    </div>
                    <div class="col-md-2 mb-1">
                      <label class="form-label" for="sigla">Sigla<strong>* </strong><tag data-bs-toggle="tooltip" title="Abreviação da instituição"><i data-feather='info'></i></tag></label>
                      <input type="text" class="form-control" id="sigla" name="sigla" value="{{ $unit->sigla }}" />
                    </div>
                    <div class="col-md-2 mb-1">
                      <label class="form-label" for="web">Principal<strong>* </strong></label>
                      <select class="select2 form-select" id="web" name="web" >
                        <option value="0" {{ $unit->web == false ? 'selected' : '' }}>Não</option>
                        <option value="1" {{ $unit->web == true ? 'selected' : '' }}>Sim</option>
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="organization_id">Organização<strong>*</strong></label>
                      <select class="select2 form-select" id="organization_id" name="organization_id" >
                        <option value="" class="">organizações</option>
                        @foreach($organizations as $organization)
                          <option value="{{ $organization->id }}" {{ $organization->id == $unit->organization_id ? 'selected' : '' }}>{{ $organization->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="phone">Telefone<strong>* </strong><tag data-bs-toggle="tooltip" title="Seguir o formato +xx(xx) xxxx-xxxx "><i data-feather='info'></i></tag></label>
                      <input type="text" class="form-control" id="phone" name="phone" value="{{ $unit->phone }}" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="email">E-mail<strong>* </strong></label>
                      <input type="text" class="form-control" id="email" name="email" value="{{ $unit->email }}" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="document">CNPJ<strong>* </strong></label>
                      <input type="text" class="form-control document" id="document" name="document" value="{{ $unit->document }}" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="operation">Horário de Funcionamento<strong>* </strong><tag data-bs-toggle="tooltip" title="EX: segunda a sexta das 08h as 17h"><i data-feather='info'></i></tag></label>
                      <input type="text" class="form-control" id="operation" name="operation" value="{{ $unit->operation }}" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="address">Endereço<strong>* </strong></label>
                      <input type="text" class="form-control" id="address" name="address" value="{{ $unit->address }}" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="google_maps_link">Link do Google Maps<strong>* </strong><tag data-bs-toggle="tooltip" title="EX:https://goo.gl/maps/HbEHhQafzyGBtK9H7"><i data-feather='info'></i></tag></label>
                      <input type="text" class="form-control" id="google_maps_link" name="google_maps_link" value="{{ $unit->google_maps_link }}" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="google_maps_iframe">SRC do IFRAME do Google Maps<strong>* </strong><tag data-bs-toggle="tooltip" title="Informações detro da SRC. de https:// até BR antes das aspas"><i data-feather='info'></i></tag></label>
                      <textarea type="text" class="form-control" id="google_maps_iframe" name="google_maps_iframe" >{{ $unit->google_maps_iframe }}</textarea>
                    </div>
                    @if(isset($unit->logo))
                      <div class="col-md-3 mb-1">
                        <label class="form-label">Imagem da Logo</label>
                        <img
                          class="img-fluid rounded mb-75"
                          src="{{asset('storage/images/units/' . $unit->logo)}}"
                          alt="avatar img"
                        />
                      </div>
                    @endif
                    <div class="col-md-9 mb-1">
                      <label class="form-label">Imagem para Logo</label>
                      <input type="file" class="form-control" id="logo" name="logo" >
                    </div>
                    @if(isset($unit->icon))
                      <div class="col-md-3 mb-1">
                        <label class="form-label">Imagem do Ícone</label>
                        <img
                          class="img-fluid rounded mb-75"
                          src="{{asset('storage/images/units/' . $unit->icon)}}"
                          alt="avatar img"
                        />
                      </div>
                    @endif
                    <div class="col-md-9 mb-1">
                      <label class="form-label">Imagem para Ícone</label>
                      <input type="file" class="form-control" id="icon" name="icon" >
                    </div>

                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                    <form method="POST" name="form-delete" action="{{ route('unidades.destroy', $unit->id) }}">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger" style="position: relative; float: left;" 
                          onclick="return confirm('Tem certeza que deseja deletar o Tipo de Receita?');">Deletar
                        </button>
                    </form>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  
  
<!-- social media -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-4 ">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cadastrar Nova Mídia Social</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal" method="POST" action="{{ route('unidade_social_media_add') }}">
            @csrf()
            <input type="text" name="unit_id" value="{{ $unit->id }}" hidden />
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-12 mb-1">
                    <label class="form-label" for="social_media_add">Mídia<strong>*</strong</label>
                    <select class="select2 form-select" id="social_media_add" name="social_media_id" >
                      <option value="" class="">Selecione</option>
                        @foreach($social_media as $media_add)
                          <option value="{{ $media_add->id }}" >{{ $media_add->title }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-12 mb-1">
                    <label class="form-label" for="url">URL<strong>*</strong><tag data-bs-toggle="tooltip" title="Ex: https://www.facebook.com.br/chainligh"><i data-feather='info'></i></tag></label>
                    <input type="text" class="form-control" id="url" name="url"  />
                  </div>
                </div>
              </div>
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1">Salvar</button>
                <button type="reset" class="btn btn-outline-secondary">Limpar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Ver Mídias Sociais  - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-datatable">
        @if (count($unit->socialMedia) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Mídia Social</th>
                <th>URL</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Mídia Social</th>
                <th>URL</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($unit->socialMedia as $media_unit)
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                        <td class="control sorting_1" tabindex="0" ></td>
                        <td style="display: none;">{{ isset($media_unit) ? $media_unit->title : '' }}</td>
                        <td style="display: none;">
                        <input type="text" class="form-control" name="id" value="{{ $media_unit->pivot->url }}" />
                        </td>
                        <td style="display: none;">{{isset($media_unit->created_at) ? (($media_unit->created_at)->format('d/m/Y H:m:s')) : ''}}</td>
                        <td style="display: none;">
                          
                          <a href="{{ route('unidade_social_media_delete', $media_unit->pivot->id) }}" title="Editar" class="btn btn-danger btn-sm" style="color: white; "><i data-feather="trash" class="font-small-4"></i></a>
                        </td>
                    </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Mídias Sociais Armazenadas.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Vencedor ends -->  

<!-- sobre media -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-12 ">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cadastrar Dados Sobre a Unidade</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal" method="POST" action="{{ route('sobres.update', isset($unit->about) ? $unit->about->id : 0) }}" enctype="multipart/form-data">
            @csrf()
            @method('PUT')
            <input type="text" name="unit_id" value="{{ $unit->id }}" hidden />

            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Título<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" value="{{ isset($unit->about->title) ? $unit->about->title : '' }}" id="title" class="form-control" name="title" required />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="sub_title">Sub Título<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" value="{{ isset($unit->about->sub_title) ? $unit->about->sub_title :  '' }}" id="sub_title" class="form-control" name="sub_title" required />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="sub_title">Data de Fundação<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input
                      type="date"
                      id="founded_at"
                      name="founded_at"
                      class="form-control"
                      value="{{ isset($unit->about->founded_at) ? date('Y-m-d',strtotime($unit->about->founded_at)) : '' }}"
                    />
                    
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="description">Descrição<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <textarea type="text" id="description" class="form-control" name="description" required >{{ isset($unit->about->description) ? $unit->about->description : '' }}</textarea>
                  </div>
                </div>
              </div>
              @if(isset($unit->about->image))
                <div class="col-md-12 mb-1">
                  <label class="form-label">Imagem</label>
                  <img
                    class="img-fluid rounded mb-75"
                    src="{{asset('storage/images/about/' . $unit->about->image)}}"
                    alt="avatar img"
                  />
                </div>
              @endif
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="image">Imagem<strong>*</strong><tag data-bs-toggle="tooltip" title="Tamanho: 1280 x 720 px"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="file" class="form-control" id="image" name="image" >
                  </div>
                </div>
              </div>

              <div class="col-md-12 mb-1">
                <label class="form-label" for="status">Status<strong>*</strong></label>
                <select class="form-select" id="status" name="status" required>
                  <option value="" class="">Selecione</option>
                  <option value="DRAFT" {{ isset($unit->about) ? ($unit->about->status == 'DRAFT' ? 'selected' : '') :  '' }} >Desenvolvendo</option>
                  <option value="PENDING" {{ isset($unit->about) ? ($unit->about->status == 'PENDING' ? 'selected' : '') :  '' }} >Pendente</option>
                  <option value="PUBLISHED" {{ isset($unit->about) ? ($unit->about->status == 'PUBLISHED' ? 'selected' : '') : '' }} >Publicada</option>
                </select>
              </div>

              <div class="col-md-12 mb-1" hidden>
                <textarea  name="content" id="content" class="form-control" >{!! isset($unit->about) ? html_entity_decode($unit->about->body, ENT_QUOTES, 'UTF-8') : '' !!}</textarea>
              </div>


              <div class="col-sm-12">
                <label class="form-label" for="category_id">Conteúdo<strong>*</strong> </label>
                <div id="full-wrapper">
                  <div id="full-container">
                    <div class="editor" id="editor-data">
                    {!! isset($unit->about) ? html_entity_decode($unit->about->body, ENT_QUOTES, 'UTF-8') : '' !!}
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 mt-2">
                <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Vencedor ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>

  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/news-editor.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/tables/unit-social-media.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/expenses-input-mask.js')) }}"></script>
@endsection
