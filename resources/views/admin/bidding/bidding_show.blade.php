@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Licitação')

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
              <form class="auth-register-form mt-2" action="{{ route('licitacoes.update', $bidding->id) }}" method="POST" >
                @csrf()
                @method('PUT')
                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Dados da Licitação</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="title">Nome</label>
                      <input type="text" name="title" id="title" class="form-control" value="{{ $bidding->title }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="status">Status</label>
                      <select class="form-select" id="status" name="status" required>
                        <option value="" class="">Selecione</option>
                        <option value="DRAFT" {{ $bidding->status == 'DRAFT' ? 'selected' : '' }} >Desenvolvendo</option>
                        <option value="PENDING" {{ $bidding->status == 'PENDING' ? 'selected' : '' }} >Pendente</option>
                        <option value="PUBLISHED" {{ $bidding->status == 'PUBLISHED' ? 'selected' : '' }} >Publicada</option>
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="modality_id">Modalidades</label>
                      <select class="form-select" id="modality_id" name="modality_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($modalities as $modality)
                          <option value="{{ $modality->id }}" {{ $bidding->modality_id===$modality->id ? 'selected' : '' }} >{{ $modality->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="situation_id">Situações</label>
                      <select class="form-select" id="situation_id" name="situation_id" >
                        <option value="" class="">Selecione</option>
                        @foreach($situations as $situation)
                          <option value="{{ $situation->id }}" {{ $bidding->situation_id===$situation->id ? 'selected' : '' }} >{{ $situation->title }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="bidding">Licitação</label>
                      <input type="text" name="bidding" id="bidding" class="form-control" value="{{ $bidding->bidding }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="value_max">Valor Estimativa</label>
                      <input type="text" class="form-control value_max"  value="{{ str_replace('.',',', $bidding->value_max) }}" id="value_max" name="value_max" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="local">Local</label>
                      <input type="text" name="local" id="local" class="form-control" value="{{ $bidding->local }}" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="content">Objeto</label>
                      <input type="text" name="content" id="content" class="form-control" value="{{ $bidding->content }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="process">Processo</label>
                      <input type="text" name="process" id="process" class="form-control" value="{{ $bidding->process }}" />
                    </div>

                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="published_at">Data de Publicação do Edital</label>
                      <input type="date" name="published_at" id="published_at" class="form-control" value="{{ date('Y-m-d',strtotime($bidding->published_at)) }}" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="realized_at">Data da licitação</label>
                      <input type="date" name="realized_at" id="realized_at" class="form-control" value="{{ date('Y-m-d',strtotime($bidding->realized_at)) }}" />
                    </div>


                  </div>
                  <div class="col-12 mt-1 pb-4">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                    <form method="POST" name="form-delete" action="{{ route('licitacoes.destroy', $bidding->id) }}">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger" style="position: relative; float: left;" 
                          onclick="return confirm('Tem certeza que deseja deletar a Licitação?');">Deletar
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
 
<!-- Vencedor -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cadastrar Novo Vencedor</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal" method="POST" action="{{ route('licitacao_vencedores.store') }}">
            @csrf()
            <input type="text" name="bidding_id" value="{{ $bidding->id }}" hidden />
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-12 mb-1">
                    <label class="form-label" for="possible_winner">Vencedor</label>
                    <select class="select2 form-select" id="possible_winner" name="person_id" >
                      <option value="" class="">Selecione</option>
                        @foreach($possible_winners as $possible_winner)
                          <option value="{{ $possible_winner->id }}" >{{ $possible_winner->full_name }}</option>
                        @endforeach
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
          <h4 class="card-title">Ver Itens de Vencedores  - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-datatable">
        @if (count($bidding->winners) >= 1)
          <table class="dt-advanced-search-winner table">
            <thead>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Email</th>
                <th>Registro</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Email</th>
                <th>Registro</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($bidding->winners as $winner)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                      <td class="control sorting_1" tabindex="0" ></td>
                      <td style="display: none;">{{ isset($winner->person->social_name) ? Str::limit($winner->person->social_name, 20) : (isset($winner->person->full_name) ? Str::limit($winner->person->full_name, 20) : '') }}</td>
                      <td style="display: none;">
                        <div class="">
                          @if(isset($winner->person))
                            @php $i = 1; @endphp
                            @foreach($winner->person->emails as $email)
                              @if($i == 1)
                                <span class="badge rounded-pill bg-primary">{{ isset($email->email) ? $email->email . ' / ' . $email->type : '' }}</span>
                              @endif
                              @if($i == 2)
                                <span class="badge rounded-pill bg-secondary">{{ isset($email->email) ? $email->email . ' / ' . $email->type : '' }}</span>
                              @endif
                              @if($i == 3)
                                <span class="badge rounded-pill bg-success">{{ isset($email->email) ? $email->email . ' / ' . $email->type : '' }}</span>
                                @php $i = 0; @endphp
                              @endif
                              @php $i++; @endphp
                            @endforeach
                          @else
                            <span class="badge rounded-pill bg-danger">{{ ' - ' }}</span>
                          @endif
                        </div>
                      </td>
                      <td style="display: none;">
                        <div class="">
                          @if(isset($winner->person))
                            @php $i = 1; @endphp
                            @foreach($winner->person->documents as $document)
                              @if($i == 1)
                                <span class="badge rounded-pill bg-primary">{{ isset($document->document) ? $document->document . ' / ' . $document->document_type->type : '' }}</span>
                              @endif
                              @if($i == 2)
                                <span class="badge rounded-pill bg-secondary">{{ isset($document->document) ? $document->document . ' / ' . $document->document_type->type : '' }}</span>
                              @endif
                              @if($i == 3)
                                <span class="badge rounded-pill bg-success">{{ isset($document->document) ? $document->document . ' / ' . $document->document_type->type : '' }}</span>
                                @php $i = 0; @endphp
                              @endif
                              @php $i++; @endphp
                            @endforeach
                          @else
                            <span class="badge rounded-pill bg-danger">{{ ' - ' }}</span>
                          @endif
                        </div>
                      </td>
                      <td style="display: none;">{{isset($winner->created_at) ? (($winner->created_at)->format('d/m/Y H:m:s')) : ''}}</td>
                    <td style="display: none;">
                      <a href="{{ route('winner_itens', $winner->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                      
                      <form method="POST" name="form-delete" action="{{ route('licitacao_vencedores.destroy', $winner->id) }}">
                          @csrf()
                          @method('delete')
                          <button type="submit" class="btn btn-danger" style="position: relative; float: left;" 
                            onclick="return confirm('Tem certeza que deseja deletar o vencedor?');">Deletar
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
                Não existem Vencedores Armazenados.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Vencedor ends -->

  <!-- Files Upload -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Adicionar Arquivos desta Licitação</h4>
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
            <input type="text" name="type" id="type" class="form-control" value="bidding" hidden />
            <input type="text" name="id" id="id" class="form-control" value="{{ $bidding->id }}" hidden />

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
        @if (count($bidding->files) >= 1)
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
              @foreach($bidding->files as $file)
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


<!-- item -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cadastrar Novo Item</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal" method="POST" action="{{ route('licitacao_items.store') }}">
            @csrf()
            <input type="text" name="bidding_id" value="{{ $bidding->id }}" hidden />
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-12 mb-1">
                    <label class="form-label" for="name">Item</label>
                    <input type="text" name="name" id="name" class="form-control" />
                  </div>
                  <div class="col-sm-6 mb-1">
                    <label class="form-label" for="quantity">Quantidade</label>
                    <input type="text" name="quantity" id="quantity" class="form-control quantity" />
                  </div>
                  <div class="col-sm-6 mb-1">
                    <label class="form-label" for="value">Custo</label>
                    <input type="text" name="value" id="value" class="form-control value" />
                  </div>
                  <div class="col-sm-12 mb-1">
                    <label class="form-label" for="person_id">Vencedor</label>
                    <select class="form-select" id="person_id" name="person_id" >
                        @foreach($possible_winners as $possible_winner)
                          <option value="{{ $possible_winner->id }}" >{{ $possible_winner->full_name }}</option>
                        @endforeach
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
          <h4 class="card-title">Itens - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-datatable">
        @if (count($bidding->items) >= 1)
          <table class="dt-advanced-search-bond table">
            <thead>
              <tr>
                <th></th>
                <th>Item</th>
                <th>Quantidade</th>
                <th>Custo</th>
                <th>Vencedor</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Item</th>
                <th>Quantidade</th>
                <th>Custo</th>
                <th>Vencedor</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($bidding->items as $item)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $item->name }}</td>
                    <td style="display: none;">{{ $item->quantity }}</td>
                    <td style="display: none;">{{ $item->value }}</td>
                    <td style="display: none;"></td>
                    <td style="display: none;">{{ $item->created_at }}</td>
                    <td style="display: none;">
                      <a href="{{ route('licitacao_items.show', $item->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Itens Armazenados.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- item ends -->
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
<script src="{{ asset(mix('js/scripts/forms/bidding-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/bidding-winners.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/bidding-items.js')) }}"></script>
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
