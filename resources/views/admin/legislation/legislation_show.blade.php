@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Legislação')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
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
              <form class="auth-register-form mt-2" action="{{ route('legislacoes.update', $legislation->id) }}" method="POST" >
                @csrf()
                @method('PUT')
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Legislação</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="ementa">Ementa</label>
                      <input type="text" name="ementa" id="ementa" class="form-control" value="{{ $legislation->ementa }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="number">Número</label>
                      <input type="text" class="form-control number"  value="{{ $legislation->number }}" id="number" name="number" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="number_complement">Complemento</label>
                      <input type="text" class="form-control number"  value="{{ $legislation->number_complement }}" id="number_complement" name="number_complement" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="category_id">Categorias</label>
                      <select class="form-select" id="category_id" name="category_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}"  {{ $legislation->category->id===$category->id ? 'selected' : '' }} >{{ $category->category }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="situation_id">Situações</label>
                      <select class="form-select" id="situation_id" name="situation_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($situations as $situation)
                          <option value="{{ $situation->id }}" {{ $legislation->situation->id===$situation->id ? 'selected' : '' }} >{{ $situation->situation }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-8 mb-1">
                      <label class="form-label" for="select2-multiple">Assuntos</label>
                      <select class="select2 form-select" id="subjects" name="subjects[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($subjects as  $subject)
                            <option value="{{ $subject->id }}" {{ (in_array($subject->id, old('subject', [])) || isset($legislation) && $legislation->subjects->contains($subject->id)) ? 'selected' : '' }} >{{ $subject->subject }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="date">Data de Recolhimento</label>
                      <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d',strtotime($legislation->date)) }}" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="initial_term">Início</label>
                      <input type="date" name="initial_term" id="initial_term" class="form-control" value="{{ date('Y-m-d',strtotime($legislation->initial_term)) }}" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="final_term">Fim</label>
                      <input type="date" name="final_term" id="final_term" class="form-control" value="{{ date('Y-m-d',strtotime($legislation->final_term)) }}" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="status">Status</label>
                      <select class="form-select" id="status" name="status" required>
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT" {{ $legislation->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                        <option value="PENDING" {{ $legislation->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                        <option value="PUBLISHED" {{ $legislation->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="information">Informação</label>
                      <textarea type="text" class="form-control number" placeholder="10" id="information" name="information" >{{ $legislation->information }}</textarea>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="select2-multiple">Unidades</label>
                      <select class="select2 form-select" id="units" name="units[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($units as  $unit)
                            <option value="{{ $unit->id }}" {{ (in_array($unit->id, old('unit', [])) || isset($legislation) && $legislation->units->contains($unit->id)) ? 'selected' : '' }} >{{ $unit->name }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                    </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="select2-multiple">Autores</label>
                      <select class="select2 form-select" id="authors" name="authors[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($authors as  $author)
                            <option value="{{ $author->id }}" {{ (in_array($author->id, old('author', [])) || isset($legislation) && $legislation->authors->contains($author->id)) ? 'selected' : '' }} >{{ $author->author }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                    </div>


                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                    <form method="POST" name="form-delete" action="{{ route('legislacoes.destroy', $legislation->id) }}">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                          onclick="return confirm('Tem certeza que deseja deletar a Legislação?');">Deletar
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

<!-- vinculo -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cadastrar Novo Vínculo</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal" method="POST" action="{{ route('legislacao_vinculos.store') }}">
            @csrf()
            <input type="text" name="base_id" value="{{ $legislation->id }}" hidden />
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-12 mb-1">
                    <label class="form-label" for="vinculo_id">Legislações</label>
                    <select class="form-select" id="vinculo_id" name="vinculo_id" >
                      <option value="" class="">Selecione</option>
                      @foreach($legislations as $legislation)
                        <option value="{{ $legislation->id }}"  >{{ $legislation->ementa }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-12 mb-1">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-select" id="status" name="status" >
                      <option value="" class="">Selecione</option>
                      <option value="REVOGADO"  >Revogado</option>
                      <option value="ALTERADO"  >Alterado</option>
                      <option value="VINCULADO"  >Vínculo</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1">Salvar</button>
                <button type="reset" class="btn btn-outline-secondary">Resetar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Vínculos - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-datatable">
        @if (count($legislation->bonds) >= 1)
          <table class="dt-advanced-search-bond table">
            <thead>
              <tr>
                <th></th>
                <th>Base</th>
                <th>Vínculo</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Base</th>
                <th>Vínculo</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($legislation->bonds as $bond)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $bond->base->ementa }}</td>
                    <td style="display: none;">{{ $bond->vinculo->ementa }}</td>
                    <td style="display: none;">{{ $bond->created_at }}</td>
                    <td style="display: none;">
                      <a href="{{ route('legislacao_vinculos.show', $bond->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Situações Armazenadas.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- vinculo ends -->


  <!-- Files Upload -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Adicionar Arquivos desta Legislação</h4>
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
            <input type="text" name="type" id="type" class="form-control" value="legislation" hidden />
            <input type="text" name="id" id="id" class="form-control" value="{{ $legislation->id }}" hidden />

            <div class="col-12 mb-2 files-inputs">
              <h4 class="card-title">Arquivos</h4>
                <div class="row hdtuto control-group lst increment" >
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
        @if (count($legislation->files) >= 1)
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
              @foreach($legislation->files as $file)
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
<!-- users list ends -->
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
  <script src="{{ asset(mix('vendors/js/file-uploaders/dropzone.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/forms/legislation-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/legislation-bonds.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/revenue-files.js')) }}"></script>
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
