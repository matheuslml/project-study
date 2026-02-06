@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Vencedores')

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
          <h4 class="card-title">Cadastrar Novo Vencedor</h4>
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
          <div class="row">
            <a href="{{ route('licitacao_vencedores.create') }}" class="btn btn-primary me-1">Cadastrar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Vencedores - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-datatable">
        @if (count($person) >= 1)
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
              @foreach($person as $person)
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                        <td class="control sorting_1" tabindex="0" ></td>
                        <td style="display: none;">{{ isset($person->social_name) ? Str::limit($person->social_name, 20) : Str::limit($person->full_name, 20) }}</td>
                        <td style="display: none;">
                          <div class="">
                            @if(isset($person))
                              @php $i = 1; @endphp
                              @foreach($person->emails as $email)
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
                            @if(isset($person))
                              @php $i = 1; @endphp
                              @foreach($person->documents as $document)
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
                        <td style="display: none;">{{isset($person->created_at) ? (($person->created_at)->format('d/m/Y H:m:s')) : ''}}</td>
                      <td style="display: none;">
                        <a href="{{ route('licitacao_vencedores.show', $person->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
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
  <script src="{{ asset(mix('js/scripts/tables/bidding-winners.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
@endsection
