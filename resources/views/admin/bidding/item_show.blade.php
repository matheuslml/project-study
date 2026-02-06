@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Item')

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

<!-- item -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Dados do Item</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal" method="POST" action="{{ route('licitacao_items.update',  $item_selected->id) }}">
            @csrf()
            @method('PUT')
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-12 mb-1">
                    <label class="form-label" for="name">Item</label>
                    <input type="text" value="{{ $item_selected->name }}" name="name" id="name" class="form-control" />
                  </div>
                  <div class="col-sm-6 mb-1">
                    <label class="form-label" for="quantity">Quantidade</label>
                    <input type="text" value="{{ $item_selected->quantity }}" name="quantity" id="quantity" class="form-control quantity" />
                  </div>
                  <div class="col-sm-6 mb-1">
                    <label class="form-label" for="value">Custo</label>
                    <input type="text" value="{{ $item_selected->value }}" name="value" id="value" class="form-control value" />
                  </div>
                  <div class="col-sm-12 mb-1">
                    <label class="form-label" for="person_id">Vencedor</label>
                    <select class="form-select" id="person_id" name="person_id" >
                      <option value="" class="">Selecione</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
          </form>
                <form method="POST" name="form-delete" action="{{ route('licitacao_items.destroy', $item_selected->id) }}">
                    @csrf()
                    @method('delete')
                    <button type="submit" class="btn btn-danger" style="position: relative; float: left;" 
                      onclick="return confirm('Tem certeza que deseja deletar o Item?');">Deletar
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
          <h4 class="card-title">Itens da Licitação: {{ $bidding->title }} - Busca Avançada</h4>
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
                    <td style="display: none;">{{ isset($item->person) ? $item->person->full_name : '' }}</td>
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
<script src="{{ asset(mix('js/scripts/forms/bidding-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/tables/bidding-items.js')) }}"></script>
@endsection
