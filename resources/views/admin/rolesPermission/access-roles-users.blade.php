@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Regras de Usuários')

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<h3>Lista de Regras</h3>
<p class="mb-2">
  As regras provém acesso determinados menus e ferramentas de acordo <br />
  no nível de acesso do usuário.
</p>

<!-- Role cards -->
<div class="row">
  @foreach($roles as $role)
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <span>Total {{ count($role->users) }} usuários</span>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              @foreach($role->users as $user)
                <li
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  title="{{ isset($user->person) ? isset($user->person->social_name) ? $user->person->social_name : $user->person->full_name : $user->name }}"
                  class="avatar avatar-sm pull-up"
                >
                  <img class="rounded-circle" src="{{ isset($user->profile_photo_path) ? asset($user->profile_photo_path) : asset('images/portrait/small/avatar-icon.png') }}" alt="Avatar" />
                </li>
              @endforeach
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
            <div class="role-heading">
              <h4 class="fw-bolder">{{ $role->name }}</h4>
              <a href="{{ route('roles.edit', $role) }}" class="role-edit-modal" >
                <small class="fw-bolder">Editar Regra</small>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
<!--/ Role cards -->

<h3 class="mt-50">Adicionar Usuários</h3>
<p class="mb-2">selecione os usuários para serem vinculados a regra.</p>
<!-- table -->
<div class="card col-6">
  <div class="card-body ">
    <!-- Add role form -->
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
    <form action="{{ route('user_rule_store') }}" method="POST">
      <fieldset>
      @csrf
        <input type="text"id="user_id" name="user_id" value="{{ $user_finded->id }}" hidden/>

        <div class="col-md-12">
          <label class="form-label" for="name">Nome do Usuário</label>
          <h2>{{ isset($user_finded->person) ? $user_finded->person->full_name : $user_finded->name}}</h2>
        </div>
        <div class="col-12">
          <h4 class="mt-2 pt-50">Regras</h4>
          <!-- Permission table -->
          <div class="table-responsive">
            <table class="table table-flush-spacing">
              <tbody>
                <tr>
                  <td class="fw-bolder">
                    Acesso Master
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Permitir acesso a todo o sistema">
                      <i data-feather="info"></i>
                    </span>
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input check-all" type="checkbox" id="checktAll" />
                      <label class="form-check-label" for="checktAll"> Todos </label>
                    </div>
                  </td>
                </tr>
                  @foreach($roles_list as $id => $roles_list)
                    <tr>
                      <td class="fw-bolder">{{ $roles_list }}</td>
                      <td class=""></td>
                      <td>
                        <div class="d-flex">
                          <div class="form-check">
                            <input 
                            class="form-check-input check-input" 
                            value="{{$id}}" 
                            type="checkbox" 
                            name="roles_list[]"
                            {{ (in_array($id, old('roles_list', [])) || isset($user_finded) && $user_finded->roles()->pluck('id', 'name')->contains($id)) ? 'checked' : '' }} 
                            />
                            <label class="form-check-label" for="roleManagementCreate"> Selecionar </label>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- Permission table -->
        </div>
        <div class="col-12 text-center mt-2">
          <button type="submit" class="btn btn-primary me-1">Criar</button>
          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
              Limpar
          </button>
        </div>
      </fieldset>
    </form>
    <!--/ Add role form -->
  </div>
</div>
<!-- table -->

@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script>
      $(document).ready(function () {
      $('.check-all').click(function () {
          let $checkInput = document.getElementsByClassName("check-input");
          for (var i = 0; i < $checkInput.length; i++) {
            if($checkInput[i].checked === true){
              $checkInput[i].checked = false;
            }
            else{
              $checkInput[i].checked = true;
            }
          }
      });
      })
  </script>
@endsection
