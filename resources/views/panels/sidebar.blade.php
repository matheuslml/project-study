@php
$configData = Helper::applClasses();
@endphp
<div class="main-menu menu-fixed {{(($configData['theme'] === 'dark') || ($configData['theme'] === 'semi-dark')) ? 'menu-dark' : 'menu-light'}} menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item me-auto">
        <a class="navbar-brand" href="{{url('/')}}">
          <span class="brand-logo" style="padding: 0; margin: 0;">
            <img src="{{ isset($unit->icon) ? (asset('storage/images/units/' . $unit->icon)) : '' }}" class="logo-gmac" style="width: 100%;" alt="logo">
          </span>
          <h2 class="brand-text">{{ isset($unit->sigla) ? $unit->sigla : '' }}</h2>
        </a>
      </li>
      <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
        </a>
      </li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      {{--  menu item starts --}}

      <li class="nav-item  ">
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center" target="_self">
          <i data-feather="home"></i>
          <span class="menu-title text-truncate">Início</span>
          @if(count(Auth::user()->notifications->where('status_id', 2)) > 0)
            <span class="badge badge-light-warning rounded-pill ms-auto me-1">{{ count(Auth::user()->notifications->where('status_id', 2)) }}</span>
          @endif
        </a>
      </li>
      <li class="nav-item  ">
        <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
          <i data-feather="help-circle"></i>
          <span class="menu-title text-truncate">Ajuda</span>
        </a>
        <ul class="menu-content">
          <li >
            <a href="{{ route('faq') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">FAQ</span>
            </a>
          </li>
        </ul>
      </li>

      @can('Ver Menu de Ouvidoria')
      <li class="navigation-header">
        <span>Ouvidoria</span>
        <i data-feather="more-horizontal"></i>
      </li>
      <li class="nav-item  ">
        <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
          <i data-feather="message-circle"></i>
          <span class="menu-title text-truncate">Manifestações</span>
        </a>
        <ul class="menu-content">
          <li >
            <a href="{{ route('ouvidoria_manifestacoes.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Listar</span>
            </a>
          </li>
          <li >
            <a href="{{ route('report_ombudsman_index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Relatórios</span>
            </a>
          </li>
          <li >
            <a href="{{ route('ouvidoria_acessos.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Tipos de Acesso</span>
            </a>
          </li>
          <li >
            <a href="{{ route('ouvidoria_requisicoes.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Tipos de Requisições</span>
            </a>
          </li>
        </ul>
      </li>
      @endcan

      @can('Ver Menu de Site')
      <li class="navigation-header">
        <span>Site</span>
        <i data-feather="more-horizontal"></i>
      </li>
      <li class="nav-item  ">
        <a href="{{ route('web_atalhos.index') }}" class="d-flex align-items-center" target="_self">
          <i data-feather="link"></i>
          <span class="menu-title text-truncate">Atalhos do site</span>
        </a>
      </li>

      <li class="nav-item  ">
        <a href="{{ route('capas.index') }}" class="d-flex align-items-center" target="_self">
          <i data-feather="image"></i>
          <span class="menu-title text-truncate">Capas do site</span>
        </a>
      </li>
      <li class="nav-item  ">
        <a href="{{ route('banners.index') }}" class="d-flex align-items-center" target="_self">
          <i data-feather="image"></i>
          <span class="menu-title text-truncate">Banners</span>
        </a>
      </li>
      <li class="nav-item  ">
        <a href="{{ route('faqs.index') }}" class="d-flex align-items-center" target="_self">
          <i data-feather="help-circle"></i>
          <span class="menu-title text-truncate">FAQs</span>
        </a>
      </li>
      <li class="nav-item  ">
        <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
          <i data-feather="film"></i>
          <span class="menu-title text-truncate">Galeria</span>
        </a>
        <ul class="menu-content">
          <li >
            <a href="{{ route('galeria_imagens.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Cadastrar</span>
            </a>
          </li>
          <li >
            <a href="{{ route('galeria_tipos.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Tipos</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item  ">
        <a href="{{ route('liderancas.index') }}" class="d-flex align-items-center" target="_self">
          <i data-feather="users"></i>
          <span class="menu-title text-truncate">Equipe</span>
        </a>
      </li>
      <li class="nav-item  ">
        <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
          <i data-feather="camera"></i>
          <span class="menu-title text-truncate">Notícias</span>
        </a>
        <ul class="menu-content">
          <li >
            <a href="{{ route('noticias.create') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Cadastrar</span>
            </a>
          </li>
          <li >
            <a href="{{ route('noticia_categorias.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Categorias</span>
            </a>
          </li>
          <li >
            <a href="{{ route('noticias.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Listar</span>
            </a>
          </li>
          <li >
            <a href="" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Relatórios</span>
            </a>
          </li>
          <li >
            <a href="{{ route('noticia_tags.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">TAGS</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item  ">
        <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
          <i data-feather="square"></i>
          <span class="menu-title text-truncate">Páginas em Branco</span>
        </a>
        <ul class="menu-content">
          <li >
            <a href="{{ route('paginas.create') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Cadastrar</span>
            </a>
          </li>
          <li >
            <a href="{{ route('paginas.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Listar</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item  ">
        <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
          <i data-feather="file-text"></i>
          <span class="menu-title text-truncate">Programas</span>
        </a>
        <ul class="menu-content">
          <li >
            <a href="{{ route('projetos.create') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Cadastrar</span>
            </a>
          </li>
          <li >
            <a href="{{ route('projeto_categorias.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Categorias</span>
            </a>
          </li>
          <li >
            <a href="{{ route('projetos.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Listar</span>
            </a>
          </li>
          <li >
            <a href="{{ route('projeto_progressos.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Progressos</span>
            </a>
          </li>
          <li >
            <a href="" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Relatórios</span>
            </a>
          </li>
          <li >
            <a href="{{ route('projeto_responsaveis.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Responsáveis</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item  ">
        <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
          <i data-feather='lock'></i>
          <span class="menu-title text-truncate">Info. Sigilosas</span>
        </a>
        <ul class="menu-content">
          <li >
            <a href="{{ route('info_sensiveis.create') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Cadastrar</span>
            </a>
          </li>
          <li >
            <a href="{{ route('info_sensiveis_categorias.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Categorias</span>
            </a>
          </li>
          <li >
            <a href="{{ route('info_sensiveis.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Listar</span>
            </a>
          </li>
          <li >
            <a href="{{ route('info_sensiveis_responsaveis.index') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate">Responsáveis</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item  ">
        <a href="{{ route('webfooters.index') }}" class="d-flex align-items-center" target="_self">
          <i data-feather="check-circle"></i>
          <span class="menu-title text-truncate">Web Rodapé</span>
        </a>
      </li>
      @endcan

      @can('Ver Menu de Transparência')
      <li class="navigation-header">
        <span>Transparência</span>
        <i data-feather="more-horizontal"></i>
      </li>
        @can('Ver e Listar Despesas')
            <li class="nav-item  ">
                <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                <i data-feather='menu'></i>
                <span class="menu-title text-truncate">Despesas</span>
                </a>
                <ul class="menu-content">
                <li >
                    <a href="{{ route('despesas.create') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Cadastrar</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('despesas.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Listar</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('report_expense_index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Relatórios</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('despesa_tipos.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Tipos de Despesas</span>
                    </a>
                </li>
                </ul>
            </li>
        @endcan
        @can('Ver e Listar Diário Oficial')
            <li class="nav-item  ">
                <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                <i data-feather='menu'></i>
                <span class="menu-title text-truncate">Diários Oficiais</span>
                </a>
                <ul class="menu-content">
                @role('Desenvolvedor')
                    <li >
                        <a href="{{ route('atos.index') }}" class="d-flex align-items-center" target="_self">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Listar Atos</span>
                        </a>
                        </li>
                    <li >
                        <a href="{{ route('atos.create') }}" class="d-flex align-items-center" target="_self">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate">Cadastrar Ato</span>
                        </a>
                    </li>
                @endrole
                <li >
                    <a href="{{ route('diarios_oficiais.create') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Cadastrar Diário</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('diarios_oficiais.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Listar Diários</span>
                    </a>
                </li>
                @role('Desenvolvedor')
                    <li >
                        <a href="{{ route('report_expense_index') }}" class="d-flex align-items-center" target="_self">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate">Relatórios</span>
                        </a>
                    </li>
                    <li >
                        <a href="{{ route('ato_topicos.index') }}" class="d-flex align-items-center" target="_self">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate">Tópicos</span>
                        </a>
                    </li>
                @endrole
                </ul>
            </li>
        @endcan
        @can('Ver e Listar Legislações')
            <li class="nav-item  ">
                <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                <i data-feather='menu'></i>
                <span class="menu-title text-truncate">Legislações</span>
                </a>
                <ul class="menu-content">
                <li >
                    <a href="{{ route('legislacao_assuntos.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Assuntos</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('legislacoes.create') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Cadastrar</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('legislacao_categorias.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Categorias</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('legislacoes.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Listar</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('report_legislation_index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Relatórios</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('legislacao_situacoes.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Situações</span>
                    </a>
                </li>
                </ul>
            </li>
        @endcan
        @can('Ver e Listar Contratações Diretas')
            <li class="nav-item  ">
                <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                <i data-feather='menu'></i>
                <span class="menu-title text-truncate">Contratações Públicas</span>
                </a>
                <ul class="menu-content">
                <li >
                    <a href="{{ route('licitacao_contratos.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Contratos</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('contratacoes_diretas.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Contratação Direta</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('licitacoes.create') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Licitação Cadastro</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('licitacoes.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Licitações Listagem</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('licitacao_modalidades.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Modalidades</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('hiring_reports_index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Relatórios</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('licitacao_vencedores.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Vencedores</span>
                    </a>
                </li>
                </ul>
            </li>
        @endcan
        @can('Ver e Listar Receitas')
            <li class="nav-item  ">
                <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                <i data-feather='menu'></i>
                <span class="menu-title text-truncate">Receitas</span>
                </a>
                <ul class="menu-content">
                <li >
                    <a href="{{ route('receitas.create') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Cadastrar</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('receitas.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Listar</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('report_revenue_index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Relatórios</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('receita_tipos.index') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Tipos de Receitas</span>
                    </a>
                </li>
                </ul>
            </li>
        @endcan
      @endcan
      @can('Ver Menu de Administrador')
        <li class="navigation-header">
          <span>Administrativo</span>
          <i data-feather="more-horizontal"></i>
        </li>
        <li class="nav-item  ">
          <a href="{{ route('notificacoes.index') }}" class="d-flex align-items-center" target="_self">
            <i data-feather="bell"></i>
            <span class="menu-title text-truncate">Notificações</span>
          </a>
        </li>
        <li class="nav-item  ">
          <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
            <i data-feather="layout"></i>
            <span class="menu-title text-truncate">Setores</span>
          </a>
          <ul class="menu-content">
            <li >
              <a href="{{ route('departamentos.index') }}" class="d-flex align-items-center" target="_self">
                <i data-feather="circle"></i>
                <span class="menu-item text-truncate">Departamentos</span>
              </a>
            </li>
            <li>
              <a href="{{ route('organizacoes.index') }}" class="d-flex align-items-center" target="_self">
                <i data-feather="circle"></i>
                <span class="menu-item text-truncate">Organizações</span>
              </a>
            </li>
            <li>
              <a href="{{ route('unidades.index') }}" class="d-flex align-items-center" target="_self">
                <i data-feather="home"></i>
                <span class="menu-item text-truncate">Unidades</span>
              </a>
            </li>
        </ul>
        </li>
        <li class="nav-item  ">
          <a href="{{ route('ocupacoes.index') }}" class="d-flex align-items-center" target="_self">
            <i data-feather="briefcase"></i>
            <span class="menu-title text-truncate">Ocupações</span>
          </a>
        </li>
        <li class="nav-item  ">
          <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
            <i data-feather="users"></i>
            <span class="menu-title text-truncate">Usuários</span>
          </a>
          <ul class="menu-content">
            <li >
              <a href="{{ route('pessoas.create') }}" class="d-flex align-items-center" target="_self">
                <i data-feather="circle"></i>
                <span class="menu-item text-truncate">Cadastrar</span>
              </a>
            </li>
            <li >
              <a href="{{ route('pessoas.index') }}" class="d-flex align-items-center" target="_self">
                <i data-feather="circle"></i>
                <span class="menu-item text-truncate">Listar</span>
              </a>
            </li>
          </ul>
        </li>
      @endcan
      @can('Ver Menu Regras e Permissões')
        <li class="navigation-header">
          <span>Admin</span>
          <i data-feather="more-horizontal"></i>
        </li>
        <li class="nav-item  ">
          <a href="{{ route('copyrights.index') }}" class="d-flex align-items-center" target="_self">
            <i data-feather="check-circle"></i>
            <span class="menu-title text-truncate">CopyRight</span>
          </a>
        </li>
        <li class="nav-item  ">
          <a href="{{ route('entry_index') }}" class="d-flex align-items-center" target="_self">
            <i data-feather="search"></i>
            <span class="menu-title text-truncate">LOG's do Sistema</span>
          </a>
        </li>
        <li class="nav-item  ">
          <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
            <i data-feather="shield"></i>
            <span class="menu-title text-truncate">Regras &amp; Permissões</span>
          </a>
          <ul class="menu-content">
            <li >
              <a href="{{ route('roles.index') }}" class="d-flex align-items-center" target="_self">
                <i data-feather="circle"></i>
                <span class="menu-item text-truncate">Regras</span>
              </a>
            </li>
            <li >
              <a href="{{ route('permissions.index') }}" class="d-flex align-items-center" target="_self">
                <i data-feather="circle"></i>
                <span class="menu-item text-truncate">Permissões</span>
              </a>
            </li>
          </ul>
        </li>
        @endcan

      {{-- ----------------Organizar depois------------------- --}}
      @role('Desenvolvedor')
        <li class="navigation-header">
          <span>Apps &amp; Pages</span>
          <i data-feather="more-horizontal"></i>
        </li>

        <li class="nav-item  ">
          <a href="{{ route('app-email') }}" class="d-flex align-items-center" target="_self">
            <i data-feather="mail"></i>
            <span class="menu-title text-truncate">Email</span>
            </a>
        </li>

        <li class="nav-item  ">
          <a href="{{ route('app-chat') }}" class="d-flex align-items-center" target="_self">
            <i data-feather="message-square"></i>
            <span class="menu-title text-truncate">Chat</span>
            </a>
        </li>

        <li class="nav-item  ">
          <a href="{{ route('app-todo') }}" class="d-flex align-items-center" target="_self">
            <i data-feather="check-square"></i>
            <span class="menu-title text-truncate">Todo</span>
            </a>
        </li>

        <li class="nav-item  ">
          <a href="{{ route('app-kanban') }}" class="d-flex align-items-center" target="_self">
            <i data-feather="grid"></i>
            <span class="menu-title text-truncate">Kanban</span>
            </a>
        </li>

        <li class="nav-item  ">
          <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
            <i data-feather="file-text"></i>
            <span class="menu-title text-truncate">Invoice</span>
          </a>
          <ul class="menu-content">
            <li >
              <a href="{{ route('app-invoice-list') }}" class="d-flex align-items-center" target="_self">
                <i data-feather="circle"></i>
                <span class="menu-item text-truncate">List</span>
              </a>
            </li>
              <li >
                <a href="{{ route('app-invoice-preview') }}" class="d-flex align-items-center" target="_self">
                  <i data-feather="circle"></i>
                  <span class="menu-item text-truncate">Preview</span>
                </a>
              </li>
              <li >
                <a href="{{ route('app-invoice-edit') }}" class="d-flex align-items-center" target="_self">
                  <i data-feather="circle"></i>
                  <span class="menu-item text-truncate">Edit</span>
                </a>
                </li>
              <li >
                <a href="{{ route('app-invoice-add') }}" class="d-flex align-items-center" target="_self">
                  <i data-feather="circle"></i>
                  <span class="menu-item text-truncate">Add</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item  ">
            <a href="{{ route('app-file-manager') }}" class="d-flex align-items-center" target="_self">
              <i data-feather="save"></i>
              <span class="menu-title text-truncate">File Manager</span>
              </a>
          </li>

          <li class="nav-item  ">
            <a href="javascript:void(0)}}" class="d-flex align-items-center" target="_self">
              <i data-feather="shopping-cart"></i>
              <span class="menu-title text-truncate">eCommerce</span>
              </a>
            <ul class="menu-content">
              <li >
                <a href="{{ route('app-ecommerce-shop') }}" class="d-flex align-items-center" target="_self">
                  <i data-feather="circle"></i>
                  <span class="menu-item text-truncate">Shop</span>
                </a>
              </li>
              <li >
                <a href="{{ route('app-ecommerce-details') }}" class="d-flex align-items-center" target="_self">
                  <i data-feather="circle"></i>
                  <span class="menu-item text-truncate">Details</span>
                </a>
              </li>
              <li >
                <a href="{{ route('app-ecommerce-wishlist') }}" class="d-flex align-items-center" target="_self">
                  <i data-feather="circle"></i>
                  <span class="menu-item text-truncate">Wishlist</span>
                </a>
              </li>
              <li >
                <a href="{{ route('app-ecommerce-checkout') }}" class="d-flex align-items-center" target="_self">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate">Checkout</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item  ">
            <a href="javascript:void(0)}}" class="d-flex align-items-center" target="_self">
              <i data-feather="file-text"></i>
              <span class="menu-title text-truncate">Pages</span>
            </a>
            <ul class="menu-content">
              <li >
                <a href="{{ route('page-profile') }}" class="d-flex align-items-center" target="_self">
                  <i data-feather="circle"></i>
                  <span class="menu-item text-truncate">Profile</span>
                </a>
              </li>
              <li >
              <a href="{{ route('page-faq') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">FAQ</span>
              </a>
                </li>
              <li >
              <a href="{{ route('page-knowledge-base') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Knowledge Base</span>
              </a>
                </li>
              <li >
              <a href="{{ route('page-pricing') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Pricing</span>
              </a>
                </li>
              <li >
              <a href="{{ route('page-license') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">License</span>
              </a>
                </li>
              <li >
              <a href="{{ route('page-api-key') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">API Key</span>
              </a>
                </li>
              <li >
              <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Blog</span>
              </a>
                  <ul class="menu-content">
                <li >
              <a href="{{ route('page-blog-list') }}" class="d-flex align-items-center" target="_self">
                      <span class="menu-item text-truncate">List</span>
              </a>
                </li>
              <li >
              <a href="{{ route('page-blog-detail') }}" class="d-flex align-items-center" target="_self">
                      <span class="menu-item text-truncate">Detail</span>
              </a>
                </li>
              <li >
              <a href="{{ route('page-blog-edit') }}" class="d-flex align-items-center" target="_self">
                      <span class="menu-item text-truncate">Edit</span>
              </a>
                </li>
              </ul>
                </li>
              <li >
              <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Mail Template</span>
              </a>
                  <ul class="menu-content">
                <li >
              <a href="https://pixinvent.com/demo/vuexy-mail-template/mail-welcome.html" class="d-flex align-items-center" target="_blank">
                      <span class="menu-item text-truncate">Welcome</span>
              </a>
                </li>
              <li >
              <a href="https://pixinvent.com/demo/vuexy-mail-template/mail-reset-password.html" class="d-flex align-items-center" target="_blank">
                      <span class="menu-item text-truncate">Reset Password</span>
              </a>
                </li>
              <li >
              <a href="https://pixinvent.com/demo/vuexy-mail-template/mail-verify-email.html" class="d-flex align-items-center" target="_blank">
                      <span class="menu-item text-truncate">Verify Email</span>
              </a>
                </li>
              <li >
              <a href="https://pixinvent.com/demo/vuexy-mail-template/mail-deactivate-account.html" class="d-flex align-items-center" target="_blank">
                      <span class="menu-item text-truncate">Deactivate Account</span>
              </a>
                </li>
              <li >
              <a href="https://pixinvent.com/demo/vuexy-mail-template/mail-invoice.html" class="d-flex align-items-center" target="_blank">
                      <span class="menu-item text-truncate">Invoice</span>
              </a>
                </li>
              <li >
              <a href="https://pixinvent.com/demo/vuexy-mail-template/mail-promotional.html" class="d-flex align-items-center" target="_blank">
                      <span class="menu-item text-truncate">Promotional</span>
              </a>
                </li>
              </ul>
                </li>
              <li >
                <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate">Miscellaneous</span>
                </a>
                  <ul class="menu-content">
              <li >
                <a href="{{ route('misc-coming-soon') }}" class="d-flex align-items-center" target="_blank">
                        <span class="menu-item text-truncate">Coming Soon</span>
                </a>
                </li>
              <li >
                <a href="{{ route('misc-not-authorized') }}" class="d-flex align-items-center" target="_blank">
                        <span class="menu-item text-truncate">Not Authorized</span>
                </a>
                </li>
              <li >
                <a href="{{ route('misc-maintenance') }}" class="d-flex align-items-center" target="_blank">
                        <span class="menu-item text-truncate">Maintenance</span>
                </a>
                </li>
              <li >
                <a href="{{ route('error') }}" class="d-flex align-items-center" target="_blank">
                        <span class="menu-item text-truncate">Error</span>
                </a>
                </li>
              </ul>
                </li>
              </ul>
                        </li>

                      <li class="nav-item  ">
                  <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather="user-check"></i>
                    <span class="menu-title text-truncate">Authentication</span>
                            </a>
                          <ul class="menu-content">

                </li>
              <li >
              <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Forgot Password</span>
              </a>
                  <ul class="menu-content">
                <li >
              <a href="{{ route('auth-forgot-password') }}" class="d-flex align-items-center" target="_blank">
                      <span class="menu-item text-truncate">Basic</span>
              </a>
                </li>

              </ul>
                </li>
              <li >
              <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Reset Password</span>
              </a>
                  <ul class="menu-content">
                <li >
              <a href="{{ route('auth-reset-password') }}" class="d-flex align-items-center" target="_blank">
                      <span class="menu-item text-truncate">Basic</span>
              </a>
                </li>
              </ul>
                </li>
              <li >
              <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Verify Email</span>
              </a>
                  <ul class="menu-content">
                <li >
              <a href="{{ route('auth-verify-email') }}" class="d-flex align-items-center" target="_blank">
                      <span class="menu-item text-truncate">Basic</span>
              </a>
                </li>
              </ul>
                </li>
              <li >
              <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Two Steps</span>
              </a>
                  <ul class="menu-content">
                <li >
              <a href="{{ route('auth-two-steps') }}" class="d-flex align-items-center" target="_blank">
                      <span class="menu-item text-truncate">Basic</span>
              </a>
                </li>
              </ul>
                </li>
              </ul>
                        </li>

                      <li class="nav-item  ">
                  <a href="{{ route('modal-examples') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="square"></i>
                    <span class="menu-title text-truncate">Modal Examples</span>
                            </a>
                        </li>
                                  <li class="navigation-header">
                  <span>User Interface</span>
                  <i data-feather="more-horizontal"></i>
                </li>

                      <li class="nav-item  ">
                  <a href="{{ route('ui-typography') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="type"></i>
                    <span class="menu-title text-truncate">Typography</span>
                            </a>
                        </li>

                      <li class="nav-item  ">
                  <a href="{{ route('icons-feather') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="eye"></i>
                    <span class="menu-title text-truncate">Feather</span>
                            </a>
                        </li>

                      <li class="nav-item  ">
                  <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather="credit-card"></i>
                    <span class="menu-title text-truncate">Card</span>
                                        <span class="badge badge-light-success rounded-pill ms-auto me-1">New</span>
                            </a>
                          <ul class="menu-content">
                <li >
              <a href="{{ route('card-basic') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Basic</span>
              </a>
                </li>
              <li >
              <a href="{{ route('card-advance') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Advance</span>
              </a>
                </li>
              <li >
              <a href="{{ route('card-statistics') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Statistics</span>
              </a>
                </li>
              <li >
              <a href="{{ route('card-analytics') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Analytics</span>
              </a>
                </li>
              <li >
              <a href="{{ route('card-actions') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Card Actions</span>
              </a>
                </li>
              </ul>
                        </li>

                      <li class="nav-item  ">
                  <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather="briefcase"></i>
                    <span class="menu-title text-truncate">Components</span>
                            </a>
                          <ul class="menu-content">
                <li >
              <a href="{{ route('component-accordion') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Accordion</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-alert') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Alerts</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-avatar') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Avatar</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-badges') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Badges</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-breadcrumbs') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Breadcrumbs</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-buttons') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Buttons</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-carousel') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Carousel</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-collapse') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Collapse</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-divider') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Divider</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-dropdowns') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Dropdowns</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-list-group') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">List Group</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-modals') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Modals</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-navs') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Navs Component</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-offcanvas') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Offcanvas</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-pagination') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Pagination</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-pill-badges') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Pill Badges</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-pills') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Pills Component</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-popovers') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Popovers</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-progress') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Progress</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-spinner') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Spinner</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-tabs') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Tabs Component</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-timeline') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Timeline</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-bs-toast') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Toasts</span>
              </a>
                </li>
              <li >
              <a href="{{ route('component-tooltips') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Tooltips</span>
              </a>
                </li>
              </ul>
                        </li>

                      <li class="nav-item  ">
                  <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather="box"></i>
                    <span class="menu-title text-truncate">Extensions</span>
                            </a>
                          <ul class="menu-content">
                <li >
              <a href="{{ route('ext-component-sweet-alerts') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Sweet Alert</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-block-ui') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">BlockUI</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-toastr') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Toastr</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-sliders') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Sliders</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-drag-drop') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Drag &amp; Drop</span>
              </a>
                </li>
              <li >
              <a href="{{ route('tour') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Tour</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-clipboard') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Clipboard</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-plyr') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Media Player</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-context-menu') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Context Menu</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-swiper') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Swiper</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-tree') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Tree</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-ratings') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Ratings</span>
              </a>
                </li>
              <li >
              <a href="{{ route('ext-component-locale') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Locale</span>
              </a>
                </li>
              </ul>
                        </li>

                      <li class="nav-item  ">
                  <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather="layout"></i>
                    <span class="menu-title text-truncate">Page Layouts</span>
                            </a>
                          <ul class="menu-content">
                <li >
              <a href="{{ route('layout-collapsed-menu') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Collapsed Menu</span>
              </a>
                </li>
              <li >
              <a href="{{ route('layout-full') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Layout Full</span>
              </a>
                </li>
              <li >
              <a href="{{ route('layout-without-menu') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Without Menu</span>
              </a>
                </li>
              <li >
              <a href="{{ route('layout-empty') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Layout Empty</span>
              </a>
                </li>
              <li >
              <a href="{{ route('layout-blank') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Layout Blank</span>
              </a>
                </li>
              </ul>
                        </li>
                                  <li class="navigation-header">
                  <span>Forms &amp; Tables</span>
                  <i data-feather="more-horizontal"></i>
                </li>

                      <li class="nav-item  ">
                  <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather="copy"></i>
                    <span class="menu-title text-truncate">Form Elements</span>
                            </a>
                          <ul class="menu-content">
                <li >
              <a href="{{ route('form-input') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Input</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-input-groups') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Input Groups</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-input-mask') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Input Mask</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-textarea') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Textarea</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-checkbox') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Checkbox</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-radio') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Radio</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-custom-options') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Custom Options</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-switch') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Switch</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-select') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Select</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-number-input') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Number Input</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-file-uploader') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">File Uploader</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-quill-editor') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Quill Editor</span>
              </a>
                </li>
              <li >
              <a href="{{ route('form-date-time-picker') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Date &amp; Time Picker</span>
              </a>
                </li>
              </ul>
                        </li>

                      <li class="nav-item  ">
                  <a href="{{ route('form-layout') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="box"></i>
                    <span class="menu-title text-truncate">Form Layout</span>
                            </a>
                        </li>

                      <li class="nav-item  ">
                  <a href="{{ route('form-wizard') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="package"></i>
                    <span class="menu-title text-truncate">Form Wizard</span>
                            </a>
                        </li>

                      <li class="nav-item  ">
                  <a href="{{ route('form-validation') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="check-circle"></i>
                    <span class="menu-title text-truncate">Form Validation</span>
                            </a>
                        </li>

                      <li class="nav-item  ">
                  <a href="{{ route('form-repeater') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="rotate-cw"></i>
                    <span class="menu-title text-truncate">Form Repeater</span>
                            </a>
                        </li>

                      <li class="nav-item  ">
                  <a href="{{ route('table') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="server"></i>
                    <span class="menu-title text-truncate">Table</span>
                            </a>
                        </li>

                      <li class="nav-item  ">
                  <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather="grid"></i>
                    <span class="menu-title text-truncate">Datatable</span>
                            </a>
                          <ul class="menu-content">
                <li >
              <a href="{{ route('datatable-basic') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Basic</span>
              </a>
                </li>
              <li >
              <a href="{{ route('datatable-advance') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Advanced</span>
              </a>
                </li>
              </ul>
                        </li>
                                  <li class="navigation-header">
                  <span>Charts &amp; Maps</span>
                  <i data-feather="more-horizontal"></i>
                </li>

                      <li class="nav-item  ">
                  <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather="pie-chart"></i>
                    <span class="menu-title text-truncate">Charts</span>
                                        <span class="badge rounded-pill badge-light-danger ms-auto me-1">2</span>
                            </a>
                          <ul class="menu-content">
                <li >
              <a href="{{ route('chart-apex') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Apex</span>
              </a>
                </li>
              <li >
              <a href="{{ route('chart-chartjs') }}" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Chartjs</span>
              </a>
                </li>
              </ul>
                        </li>

                      <li class="nav-item  ">
                  <a href="{{ route('map-leaflet') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather="map"></i>
                    <span class="menu-title text-truncate">Leaflet Maps</span>
                            </a>
                        </li>
                                  <li class="navigation-header">
                  <span>Misc</span>
                  <i data-feather="more-horizontal"></i>
                </li>

                      <li class="nav-item  ">
                  <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather="menu"></i>
                    <span class="menu-title text-truncate">Menu Levels</span>
                            </a>
                          <ul class="menu-content">
                <li >
              <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Second Level 2.1</span>
              </a>
                </li>
              <li >
              <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                      <i data-feather="circle"></i>
                      <span class="menu-item text-truncate">Second Level 2.2</span>
              </a>
                  <ul class="menu-content">
                <li >
              <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                      <span class="menu-item text-truncate">Third Level 3.1</span>
              </a>
                </li>
              <li >
              <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                      <span class="menu-item text-truncate">Third Level 3.2</span>
              </a>
                </li>
              </ul>
                </li>
              </ul>
                        </li>

                      <li class="nav-item desenvolvedor ">
                  <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather="eye-off"></i>
                    <span class="menu-title text-truncate">Disabled Menu</span>
                            </a>
                        </li>

                      <li class="nav-item  ">
                  <a href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-laravel-folder-structure.html" class="d-flex align-items-center" target="_blank">
                    <i data-feather="folder"></i>
                    <span class="menu-title text-truncate">Documentation</span>
                            </a>
                        </li>

                      <li class="nav-item  ">
                  <a href="https://pixinvent.ticksy.com/" class="d-flex align-items-center" target="_blank">
                    <i data-feather="life-buoy"></i>
                    <span class="menu-title text-truncate">Raise Support</span>
                            </a>
                        </li>

                    <li class="nav-item  ">
                <a href="{{ route('ext-component-locale') }}" class="d-flex align-items-center" target="_blank">
                  <i data-feather="life-buoy"></i>
                  <span class="menu-title text-truncate">language</span>
                          </a>
                      </li>
      @endrole
      {{--  menu item ends --}}
    </ul>
  </div>
</div>
<!-- END: Main Menu-->
