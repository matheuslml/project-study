@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Programa')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">

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
              <form class="auth-register-form mt-2" action="{{ route('projetos.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf()
                @method('PUT')
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Programa</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="title">Assunto</label>
                      <input type="text" value="{{ $project->title }}" name="title" id="title" class="form-control" required />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="sub_title">Sub Título</label>
                      <input type="text" value="{{ $project->sub_title }}" name="sub_title" id="sub_title" class="form-control" required />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="description">Descrição</label>
                      <textarea  name="description" maxlength="80" id="description" class="form-control" required >{{ $project->description }}</textarea>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="category_id">Categoria</label>
                      <select class="form-select" id="category_id" name="category_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}" {{ $category->id == $project->category_id ? 'selected' : '' }} >{{ $category->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="responsible_id">Responsável<tag data-bs-toggle="tooltip" title="Não se esqueça de cadastrar previamente a categoria"><i data-feather='info'></i></tag></label>
                      <select class="form-select" id="responsible_id" name="responsible_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($responsibles as $responsible)
                          <option value="{{ $responsible->id }}" {{ $responsible->id == $project->project_responsible_id ? 'selected' : '' }} >{{ $responsible->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="amount">Quantidade<strong>*</strong></label>
                      <input type="integer" value="{{ $project->amount }}" name="amount" id="amount" class="form-control" required />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="term">Data de Conclusão</label>
                      <input type="date" value="{{ date('Y-m-d',strtotime($project->term)) }}" name="term" id="term" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="status">Status</label>
                      <select class="form-select" id="status" name="status" >
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT" {{ $project->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                        <option value="PENDING" {{ $project->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                        <option value="PUBLISHED" {{ $project->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Imagem da Thumb</label>
                      <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/projects/' . $project->thumb)}}"
                        alt="avatar img"
                      />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Alterar Imagem para Thumb</label>
                      <input type="file" class="form-control" id="thumb" name="thumb" >
                    </div>

                    <div class="col-md-12 mb-1" hidden>
                      <textarea  name="content" id="content" class="form-control" >{!! html_entity_decode($project->body, ENT_QUOTES, 'UTF-8') !!}</textarea>
                    </div>


                    <div class="col-sm-12">
                      <label class="form-label" for="category_id">Conteúdo</label>
                      <div id="full-wrapper">
                        <div id="full-container">
                          <div class="editor" id="editor-data">
                          {!! html_entity_decode($project->body, ENT_QUOTES, 'UTF-8') !!}
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>
                  <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                    <form method="POST" name="form-delete" action="{{ route('projetos.destroy', $project->id) }}">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                          onclick="return confirm('Tem certeza que deseja deletar o Projeto?');">Deletar
                        </button>
                    </form>
                  </div>
            </div>
          </div>
        <!-- /Register-->
        </div>
      </div>
    </div>
  </div>

<!-- Advanced Search -->
<section id="advanced-search-datatable-progresses">
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Progressos - Busca Avançada</h4>
            </div>
            <hr class="my-0" />
            <div class="card-datatable">
            @if (count($progresses) >= 1)
                <table class="dt-advanced-search-progresses table">
                <thead>
                    <tr>
                    <th></th>
                    <th>Programa</th>
                    <th>Registrado em</th>
                    <th>Sistema</th>
                    </tr>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th></th>
                    <th>Programa</th>
                    <th>Registrado em</th>
                    <th>Sistema</th>
                    </tr>
                    </tr>
                </tfoot>
                <tbody>
                    @php $i = 0; @endphp
                    @foreach($progresses as $progress)
                    @if($i == 0)
                        @php $i = 1; @endphp
                        <tr class="odd">
                    @else
                        @php $i = 0; @endphp
                        <tr class="even">
                    @endif
                        <td class="control sorting_1" tabindex="0" ></td>
                        <td style="display: none;">{{ $progress->project->title }}</td>
                        <td style="display: none;">{{ $progress->created_at }}</td>
                        <td style="display: none;">
                            <a href="{{ route('projeto_progressos.show', $progress->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                @else
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Aviso</h4>
                    <div class="alert-body">
                    Não existem Progressos Armazenados.
                    </div>
                </div>
                @endif
            </div>
            </div>
        </div>
    </div>
</section>

<!-- Advanced Search -->
  <section id="advanced-search-datatable">
    <div class="row">

    <div class="col-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Adicionar Imagem ao Programa</h4>
          </div>
          <div class="card-body">
            <p class="card-text">
              Selecione a Imagem para fazer upload.
            </p>

            <form action="{{ route('projeto_medias.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf()
              <input type="text" name="project_id" id="project_id" class="form-control" value="{{ $project->id }}" hidden />

              <div class="col-12 mb-2">
                  <div class="row hdtuto control-group lst increment" >
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Imagem (Obrigatório)</label>
                      <input type="file" name="media_project" class="form-control" />
                    </div>
                  </div>
              </div>
              <div class="col-12" style="position: relative; float: left;">
                <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 30px;"
                  onclick="return confirm('Tem certeza que deseja salvar a imagem?');">SALVAR IMAGEM
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card">
          <div class="card-header border-bottom">
            <h4 class="card-title">Lista de Imagens - Busca Avançada</h4>
          </div>
          <!--Search Form -->
          <div class="card-body mt-2">
            <form class="dt_adv_search" method="POST">
              <div class="row g-1 mb-md-1">
                <div class="col-md-4">
                  <label class="form-label">Nome:</label>
                  <input
                    type="text"
                    class="form-control dt-input dt-title"
                    data-column="1"
                    placeholder="digite o nome"
                    data-column-index="0"
                  />
                </div>
              </div>
            </form>
          </div>
          <hr class="my-0" />
          <div class="card-datatable">
          @if (count($project->projectMedia) >=1)
            <table class="dt-advanced-search table">
              <thead>
                <tr>
                  <th></th>
                  <th>Imagem</th>
                  <th>Registrado em</th>
                  <th>Sistema</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Imagem</th>
                  <th>Registrado em</th>
                  <th>Sistema</th>
                </tr>
              </tfoot>
              <tbody>
                @php $i = 0; @endphp
                @foreach($project->projectMedia as $media)
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                      <td class="control sorting_1" tabindex="0" ></td>
                      <td style="display: none;">
                        <img
                          class="img-fluid rounded mb-75"
                          src="{{asset('storage/images/projects/' . $media->url)}}"
                          alt="avatar img"
                        /></td>
                      <td style="display: none;">{{ $media->created_at }}</td>
                      <td style="display: none;">
                        <form method="POST" name="form-delete" action="{{ route('projeto_medias.destroy', $media->id) }}">
                            @csrf()
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm" style="position: relative; float: left; color: white;"
                              onclick="return confirm('Tem certeza que deseja deletar a Media?');"><i data-feather="trash" class="font-small-4"></i>
                            </button>
                        </form>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            @else
              <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Aviso</h4>
                <div class="alert-body">
                  Não existem Arquivos Armazenados.
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- users list ends -->

<!-- Upload File -->
<section>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Adicionar Arquivos deste Programa</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Selecione os Arquivos para fazer upload, você pode subir um ou mais arquivos de uma vez.
          </p>

          <div class=" col-12 mb-2">
            <button id="select-files" class="btn btn-outline-primary btn-clone mb-1">
              <i data-feather="file"></i> Clique aqui para adicionar mais arquivos
            </button>
          </div>

          <form action="{{ route('arquivos.store') }}" method="POST" enctype="multipart/form-data" >
          @csrf()
            <input type="text" name="type" id="type" class="form-control" value="project" hidden />
            <input type="text" name="id" id="id" class="form-control" value="{{ $project->id }}" hidden />

            <div class="col-12 mb-2 files-inputs">
              <h4 class="card-title">Arquivos</h4>
                <div class="row hdtuto control-group lst increment">
                  <div class="col-md-6 mb-1">
                    <label class="form-label">Arquivo (Obrigatório)</label>
                    <input type="file" name="files[document][]" class="form-control" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label">Nome do Arquivo (Obrigatório)</label>
                    <input type="text" name="files[title][]" class="form-control" />
                  </div>
                </div>

                <div class=" clone hide " hidden>
                    <div class="row deletar hdtuto control-group lst ">
                      <div class="col-md-5 mb-1">
                        <label class="form-label">Arquivo (Obrigatório)</label>
                        <input type="file" name="files[document][]" class="form-control" />
                      </div>
                      <div class="col-md-6 mb-1">
                        <label class="form-label">Nome do Arquivo (Obrigatório)</label>
                        <input type="text" name="files[title][]" class="form-control" />
                      </div>
                      <button class="col-md-1 btn btn-danger btn-delete mt-2" style="width: auto; height: 50%;" type="button"><i data-feather="delete"></i></button>

                    </div>
                </div>
            </div>
            <div class="col-12" style="position: relative; float: left;">
              <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 30px;"
                onclick="return confirm('Tem certeza que deseja salvar os arquivos?');">SALVAR ARQUIVOS
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </section>
  <!-- button file upload ends -->

  <!-- Advanced Search -->
  <section id="advanced-search-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Lista de Arquivos - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-body mt-2">
          <form class="dt_adv_search" method="POST">
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Nome:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-title"
                  data-column="1"
                  placeholder="digite o nome"
                  data-column-index="0"
                />
              </div>
            </div>
          </form>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($project->files) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Arquivo</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Arquivo</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($project->files as $file)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $file->title }}</td>
                    <td style="display: none;">{{ $file->created_at }}</td>
                    <td style="display: none;">
                      <a href="{{ route('arquivos.show', $file->id) }}" title="Ver" class="btn btn-info btn-sm" style="color: white; "><i data-feather="search" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Arquivos Armazenados.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- button file upload ends -->

@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>

  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>


  <script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/file-uploaders/dropzone.min.js')) }}"></script>
@endsection

@section('page-script')
  <script src="{{ asset(mix('js/scripts/forms/projects-editor.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/tables/project_media.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/forms/bidding-agreement-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/revenue-files.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/progresses.js')) }}"></script>
  <script type="text/javascript">
      $(document).ready(function() {
        $(".btn-clone").click(function(){
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
        });
        $(".files-inputs").on("click",".btn-delete",function(){
            $(this).parent('.deletar').remove();
        });
      });
  </script>
@endsection
