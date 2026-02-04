@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Assunto')

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
<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Dados do Vínculo</h4>
        </div>
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
          <form class="form form-horizontal" method="POST" action="{{ route('legislacao_vinculos.update', $bond->id) }}">
            @csrf()
            @method('PUT')
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="base_id">Base</label>
                  </div>
                  <div class="col-sm-9">
                    <select class="form-select" id="base_id" name="base_id" >
                      <option value="" class="">Selecione</option>
                      @foreach($legislations as $legislation)
                        <option value="{{ $legislation->id }}"  
                          {{ $bond->base_id == $legislation->id ? 'selected' : '' }} 
                        >{{ $legislation->ementa }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="vinculo_id">Vínculo</label>
                  </div>
                  <div class="col-sm-9">
                    <select class="form-select" id="vinculo_id" name="vinculo_id" >
                      <option value="" class="">Selecione</option>
                      @foreach($legislations as $legislation)
                        <option value="{{ $legislation->id }}"  
                          {{ $bond->vinculo_id == $legislation->id ? 'selected' : '' }} 
                        >{{ $legislation->ementa }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
          </form>
                <form method="POST" name="form-delete" action="{{ route('legislacao_vinculos.destroy', $bond->id) }}">
                    @csrf()
                    @method('delete')
                    <button type="submit" class="btn btn-danger" style="position: relative; float: left;" 
                      onclick="return confirm('Tem certeza que deseja deletar o Vínculo?');">Deletar
                    </button>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Tipos de Receita - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-body mt-2">
          <form class="dt_adv_search" method="POST" >
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Tipo:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-title"
                  data-column="1"
                  placeholder="digite o tipo"
                  data-column-index="0"
                />
              </div>
            </div>
          </form>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($bond->base->bonds) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Base</th>
                <th>Vínculo</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Base</th>
                <th>Vínculo</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($bond->base->bonds as $td_bond)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $td_bond->base->ementa }}</td>
                    <td style="display: none;">{{ $td_bond->vinculo->ementa }}</td>
                    <td style="display: none;">
                      <a href="{{ route('legislacoes.show', $td_bond->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Vínculos Armazenados.
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
  <script src="{{ asset(mix('js/scripts/tables/expense-types.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
