@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Unidades')

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
          <h4 class="card-title">Cadastrar Nova Unidade</h4>
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
          <form class="form form-horizontal" method="POST" action="{{ route('unidades.store') }}" enctype="multipart/form-data">
            @csrf()
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="name">Nome<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="name" class="form-control" name="name" placeholder="Nome do Unidade" required />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="sigla">Sigla<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="sigla" class="form-control" name="sigla" placeholder="sigla" required />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="code">Organização<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <select class="select2 form-select" id="organization_id" name="organization_id" required>
                      @foreach($organizations as $organization)
                        @if($organization->active == 1)
                          <option value="{{ $organization->id }}" >{{ $organization->title }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="phone">Telefone<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="phone" class="form-control" name="phone" placeholder="22 9999 9999" required/>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="email">E-mail<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="email" class="form-control" name="email" placeholder="email@email.com.br" required/>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="document">CNPJ<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="document" class="form-control document" name="document" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="operation">Horário de Funcionamento<strong>* </strong></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="operation" class="form-control" name="operation" placeholder="Segunda a Sexta de 8 as 17H" required/>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="address">Endereço<strong>* </strong><tag data-bs-toggle="tooltip" title="ex: Rua.Rua,01,Bairo,cidade-Estado,CEP"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="address" class="form-control" name="address" placeholder="Rua.Rua,01,Bairro..." required/>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="google_maps_link">Link do Google Maps<strong>* </strong><tag data-bs-toggle="tooltip" title="ex: https://goo.gl/maps/HbEHhQafzyGBtK9H7"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" id="google_maps_link" class="form-control" name="google_maps_link" placeholder="https://goo.gl/maps/HbEHhQafzyGBtK9H7" required/>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="google_maps_iframe">SRC do IFrame do Google Maps<strong>* </strong><tag data-bs-toggle="tooltip" title="Informações detro da SRC. de https:// até BR antes das aspas"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <textarea type="text" id="google_maps_iframe" class="form-control" name="google_maps_iframe" placeholder="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d772.253946648147!2d-42.01870907043553!3d-22.96938676172656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x97193ee442555b%3A0x337036ed87f7756f!2sMarina%20dos%20Anjos!5e0!3m2!1spt-BR!2sbr!4v1655134359252!5m2!1spt-BR!2sbr" required></textarea>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="web">Unidade Principal?<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <select class="select2 form-select" id="web" name="web" required>
                      <option value="0" >Não</option>
                      <option value="1" >Sim</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12 mb-1">
                <label class="form-label">Imagem para Logo</label>
                <input type="file" class="form-control" id="logo" name="logo" >
              </div>
              <div class="col-md-12 mb-1">
                <label class="form-label">Imagem para Ícone</label>
                <input type="file" class="form-control" id="icon" name="icon" >
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
          <h4 class="card-title">Unidades - Busca Avançada</h4>
        </div>
        <!--Search Form -->
        <div class="card-body mt-2">
          <form class="dt_adv_search" method="POST" >
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Name:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-name"
                  data-column="1"
                  placeholder="digite o nome"
                  data-column-index="0"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Sigla:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-sigla"
                  data-column="3"
                  placeholder="sigla"
                  data-column-index="2"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Organização:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-organizarion"
                  data-column="4"
                  placeholder="Arraial do Cabo"
                  data-column-index="3"
                />
              </div>
            </div>
          </form>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($units) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Principal</th>
                <th>Organização</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Principal</th>
                <th>Organização</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($units as $unit)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $unit->sigla }}</td>
                    <td style="display: none;">{{ $unit->web == true ? 'sim' : 'não' }}</td>
                    <td style="display: none;">{{ $unit->organization->title }}</td>
                    <td style="display: none;">{{ $unit->created_at }}</td>
                    <td style="display: none;">
                      <a href="{{ route('unidades.show', $unit->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Unidades Armazenadas.
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
  <script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/units.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/forms/expenses-input-mask.js')) }}"></script>
@endsection
