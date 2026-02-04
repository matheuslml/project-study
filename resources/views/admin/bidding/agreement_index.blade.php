@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Contratos')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- agreements list start -->
<section class="app-user-list">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cadastrar Novo Contrato</h4>
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
            <a href="{{ route('licitacao_contratos.create') }}" class="btn btn-primary me-1">Cadastrar</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cadastrar Novo Tipo de Contrato</h4>
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
            <a href="{{ route('licitacao_contrato_tipos.index') }}" class="btn btn-primary me-1">Cadastrar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Contratos - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-body mt-2">
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
          <form class="dt_adv_search" method="POST">
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Contrato:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-title"
                  data-column="1"
                  placeholder="digite a Contrato"
                  data-column-index="0"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Origem:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-origin"
                  data-column="2"
                  data-column-index="2"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Tipo:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-type"
                  data-column="2"
                  data-column-index="3"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Assinado em:</label>
                <div class="mb-0">
                  <input
                    type="text"
                    class="form-control dt-date flatpickr-range dt-input dt-signature-at"
                    data-column="3"
                    placeholder="StartDate to EndDate"
                    data-column-index="4"
                    name="dt_date"
                  />
                  <input
                    type="hidden"
                    class="form-control dt-date start_date dt-input dt-signature-at"
                    data-column="3"
                    data-column-index="4"
                    name="value_from_start_date"
                  />
                  <input
                    type="hidden"
                    class="form-control dt-date end_date dt-input dt-signature-at"
                    name="value_from_end_date"
                    data-column="3"
                    data-column-index="4"
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($agreements) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Contrato</th>
                <th>Tipo</th>
                <th>Origem</th>
                <th>Status</th>
                <th>Diário</th>
                <th>Assinado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Contrato</th>
                <th>Tipo</th>
                <th>Origem</th>
                <th>Status</th>
                <th>Diário</th>
                <th>Assinado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($agreements as $agreement)
                @if(isset($agreement->title))
                  @if($i == 0)
                    @php $i = 1; @endphp
                    <tr class="odd">
                  @else
                    @php $i = 0; @endphp
                    <tr class="even">
                  @endif
                      <td class="control sorting_1" tabindex="0" ></td>
                      <td style="display: none;">{{ $agreement->title }}</td>
                      <td style="display: none;">{{ $agreement->agreementType->title }}</td>
                      <td style="display: none;">{{ $agreement->agreementOrigin->title }}</td>
                      <td style="display: none;">{{ $agreement->status == 'PENDING' ? 'Pendente' : ($agreement->status == 'DRAFT' ? 'Editando' : 'Publicado') }}</td>
                      <td style="display: none;">{{isset($agreement->date_diary) ? (($agreement->date_diary)->format('d/m/Y H:m:s')) : ''}}</td>
                      <td style="display: none;">{{isset($agreement->date_signature) ? (($agreement->date_signature)->format('d/m/Y H:m:s')) : ''}}</td>
                      <td style="display: none;">

                        <div class="btn-group">
                          <a href="{{ route('licitacao_contratos.show', $agreement->id) }}" class="btn btn-info">
                                    <i data-feather="search"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  @endif
              @endforeach
            </tbody>
          </table>
          @else
          <div class="alert alert-info" role="alert">
            <i class="fas fa-times"></i> Não existem Contratos Armazenadas.
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- agreements list ends -->
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
  <script src="{{ asset(mix('js/scripts/tables/bidding-agreements.js')) }}"></script>
@endsection
