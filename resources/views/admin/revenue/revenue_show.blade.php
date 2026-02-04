@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Receita')

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
              <form class="auth-register-form mt-2" action="{{ route('receitas.update', $revenue->id) }}" method="POST" >
                @csrf()
                @method('PUT')
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Receita</h2>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-9 mb-1">
                      <label class="form-label" for="description">Descrição</label>
                      <input type="text" name="description" id="description" class="form-control" value="{{ $revenue->description }}" />
                    </div>
                    <div class="col-md-3 mb-1">
                      <label class="form-label" for="status">Status</label>
                      <select class="form-select" id="status" name="status" required>
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT" {{ $revenue->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                        <option value="PENDING" {{ $revenue->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                        <option value="PUBLISHED" {{ $revenue->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="value">Valor Bruto</label>
                      <input type="text" class="form-control current-balance" placeholder="10,000.00" id="value" name="value" value="{{ str_replace('.',',', $revenue->value) }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="type_id">Lista de Tipos</label>
                      <select class="form-select" id="type_id" name="type_id" >
                        <option value="" class="">Tipos</option>
                        @foreach($types as $type)
                          <option value="{{ $type->id }}" {{ $type->id == $revenue->type_id ? 'selected' : '' }}>{{ $type->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="referent">Referente</label>
                      <input type="text" name="referent" id="referent" class="form-control" value="{{ $revenue->referent }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="receipt_at">Data de Recolhimento</label>
                      <input type="date" name="receipt_at" id="receipt_at" class="form-control" value="{{ date('Y-m-d',strtotime($revenue->receipt_at)) }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="collection_initial_at">Início da Arrecadação</label>
                      <input type="date" name="collection_initial_at" id="collection_initial_at" class="form-control" value="{{ date('Y-m-d',strtotime($revenue->collection_initial_at)) }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="collection_final_at">Fim da Arrecadação</label>
                      <input type="date" name="collection_final_at" id="collection_final_at" class="form-control" value="{{ date('Y-m-d',strtotime($revenue->collection_final_at)) }}" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="notes">Anotações</label>
                      <textarea type="text" name="notes" id="notes" class="form-control">{{ $revenue->notes }}</textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                    <form method="POST" name="form-delete" action="{{ route('receitas.destroy', $revenue->id) }}">
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
  
  <!-- Files Upload -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Adicionar Arquivos desta Receita</h4>
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
            <input type="text" name="type" id="type" class="form-control" value="revenue" hidden />
            <input type="text" name="id" id="id" class="form-control" value="{{ $revenue->id }}" hidden />

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
        @if (count($revenue->files) >= 1)
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
              @foreach($revenue->files as $file)
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
  <script src="{{ asset(mix('js/scripts/forms/expense-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
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
