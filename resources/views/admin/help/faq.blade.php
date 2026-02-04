@extends('admin/layouts/contentLayoutMaster')

@section('title', 'FAQ')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-faq.css')) }}">
@endsection

@section('content')
<!-- search header -->
<section id="faq-search-filter">
  <div class="card faq-search" style="background-image: url('')">
    <div class="card-body text-center">
      <!-- main title -->
      <h2 class="text-primary">Vamos responder suas dúvidas</h2>

      <!-- subtitle -->
      <p class="card-text mb-2">escolha dentre as categorias abaixo que represente a sua dúvida.</p>
    </div>
  </div>
</section>
<!-- /search header -->

<!-- frequently asked questions tabs pills -->
<section id="faq-tabs">
  <!-- vertical tab pill -->
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-12">
      <div class="faq-navigation d-flex justify-content-between flex-column mb-2 mb-md-0">
        <!-- pill tabs navigation -->
        <ul class="nav nav-pills nav-left flex-column" role="tablist">
          <!-- ras -->
          <li class="nav-item">
            <a
              class="nav-link active"
              id="ras"
              data-bs-toggle="pill"
              href="#faq-ras"
              aria-expanded="true"
              role="tab"
            >
              <i data-feather="calendar" class="font-medium-3 me-1"></i>
              <span class="fw-bold">Ouvidoria</span>
            </a>
          </li>

          <!-- guardas -->
          <li class="nav-item">
            <a
              class="nav-link"
              id="guardas"
              data-bs-toggle="pill"
              href="#faq-guardas"
              aria-expanded="false"
              role="tab"
            >
              <i data-feather="users" class="font-medium-3 me-1"></i>
              <span class="fw-bold">Usuários</span>
            </a>
          </li>
          @role('Administrador')
          <!-- administradores and return -->
          <li class="nav-item">
            <a
              class="nav-link"
              id="administradores"
              data-bs-toggle="pill"
              href="#faq-administradores"
              aria-expanded="false"
              role="tab"
            >
              <i data-feather="bookmark" class="font-medium-3 me-1"></i>
              <span class="fw-bold">Unidades</span>
            </a>
          </li>

          <!-- my relatorios -->
          <li class="nav-item" hidden>
            <a
              class="nav-link"
              id="my-relatorios"
              data-bs-toggle="pill"
              href="#faq-my-relatorios"
              aria-expanded="false"
              role="tab"
            >
              <i data-feather="pie-chart" class="font-medium-3 me-1"></i>
              <span class="fw-bold">Relatórios</span>
            </a>
          </li>
          @endrole

          @role('Administrador Master')
          <!-- rules and services-->
          <li class="nav-item">
            <a
              class="nav-link"
              id="rules"
              data-bs-toggle="pill"
              href="#faq-rules"
              aria-expanded="false"
              role="tab"
            >
              <i data-feather="shield" class="font-medium-3 me-1"></i>
              <span class="fw-bold">Regras e Permissões</span>
            </a>
          </li>
          @endrole
        </ul>

        <!-- FAQ image -->
        <img
          src="{{asset('images/illustration/faq-illustrations.svg')}}"
          class="img-fluid d-none d-md-block"
          alt="demand img"
        />
      </div>
    </div>

    <div class="col-lg-9 col-md-8 col-sm-12">
      <!-- pill tabs tab content -->
      <div class="tab-content">
        <!-- ras panel -->
        <div role="tabpanel" class="tab-pane active" id="faq-ras" aria-labelledby="ras" aria-expanded="true">
          <!-- icon and header -->
          <div class="d-flex align-items-center">
            <div class="avatar avatar-tag bg-light-primary me-1">
              <i data-feather="calendar" class="font-medium-4"></i>
            </div>
            <div>
              <h4 class="mb-0">Ouvidoria</h4>
              <span>como usar?</span>
            </div>
          </div>

          <!-- frequent answer and question  collapse  -->
          <div class="accordion accordion-margin mt-2" id="faq-ras-qna">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="rasOne">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-ras-one"
                  aria-expanded="false"
                  aria-controls="faq-ras-one"
                >
                  Como acessar?
                </button>
              </h2>

              <div
                id="faq-ras-one"
                class="collapse accordion-collapse"
                aria-labelledby="rasOne"
                data-bs-parent="#faq-ras-qna"
              >
                <div class="accordion-body">
                  Existem 3 maneiras de acessar. Pelo menu Lateral nas opções Agenda e Busca Avançada.
                  No menu superios na sua lista de atalhos existe o icone de agenda que leva direto paraa página do RAS.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="rasTwo">
                <button
                  class="accordion-button"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-ras-two"
                  aria-expanded="true"
                  aria-controls="faq-ras-two"
                >
                  Como Cadastrar Novo Diário Oficial?
                </button>
              </h2>
              <div
                id="faq-ras-two"
                class="collapse show"
                aria-labelledby="rasTwo"
                data-bs-parent="#faq-ras-qna"
              >
                <div class="accordion-body">
                  Na págna de Cadastro, preenxa por obrigação o número de edição, a Data de Publicação, o Status e selecione subir o Arquivo diagramado em PDF ou gerar um Diário Oficial Utilizando Atos Pendentes Cadastrados
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="rasThree">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-ras-three"
                  aria-expanded="false"
                  aria-controls="faq-ras-three"
                >
                  O que encontro na Página Busca Avançada?
                </button>
              </h2>
              <div
                id="faq-ras-three"
                class="collapse"
                aria-labelledby="rasThree"
                data-bs-parent="#faq-ras-qna"
              >
                <div class="accordion-body">
                  A página de Busca Avançada lhe trará um acesos mais específico ao procurar os Diários cadastradas.
                  Diferente da página agenda, ela lhe fornece a lista em ordem de casdatro dos Diários cadastradas.
                  Também fornece uma busca avançada de todas os Diários cadastradas no sistema.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="rasFour">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-ras-four"
                  aria-expanded="false"
                  aria-controls="faq-ras-four"
                >
                  Quais Diários Aparecem para a População?
                </button>
              </h2>
              <div
                id="faq-ras-four"
                class="collapse accordion-collapse"
                aria-labelledby="rasFour"
                data-bs-parent="#faq-ras-qna"
              >
                <div class="accordion-body">
                  Apenas os Diários Cadastrados com Status Publicado aparecem no site para a População fazer o download.
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- guardas panel -->
        <div class="tab-pane" id="faq-guardas" role="tabpanel" aria-labelledby="guardas" aria-expanded="false">
          <!-- icon and header -->
          <div class="d-flex align-items-center">
            <div class="avatar avatar-tag bg-light-primary me-1">
              <i data-feather="users" class="font-medium-4"></i>
            </div>
            <div>
              <h4 class="mb-0">Usuário</h4>
              <span>como usar o sistema?</span>
            </div>
          </div>

          <!-- frequent answer and question  collapse  -->
          <div class="accordion accordion-margin mt-2" id="faq-guardas-qna">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="guardasOne">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-guardas-one"
                  aria-expanded="false"
                  aria-controls="faq-guardas-one"
                >
                  onde cadastro usuários novos no Sistema?
                </button>
              </h2>

              <div
                id="faq-guardas-one"
                class="collapse accordion-collapse"
                aria-labelledby="guardasOne"
                data-bs-parent="#faq-guardas-qna"
              >
                <div class="accordion-body">
                  Para se cadastrar acesse no menu Lateral a opção Usuários e selecione o menu cadastrar. No formulário de Registro apresentado na tela,
                  é necessário preenxer todos os campos de Login, nos campos dos Dados Pessoais é Obrigatório o registro do nome completo e os Setores para
                  confirmar um Cadatro.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="guardasTwo">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-guardas-two"
                  aria-expanded="false"
                  aria-controls="faq-guardas-two"
                >
                  Como alterar meu dados pessoais?
                </button>
              </h2>
              <div
                id="faq-guardas-two"
                class="collapse accordion-collapse"
                aria-labelledby="guardasTwo"
                data-bs-parent="#faq-guardas-qna"
              >
                <div class="accordion-body">
                  No menu superior encontrará o icone com a opção de gerenciar perfil, lá terá acesso aos seus dados pessoais.
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- administradores return  -->
        <div class="tab-pane" id="faq-administradores" role="tabpanel" aria-labelledby="administradores" aria-expanded="false" >
          <!-- icon and header -->
          <div class="d-flex align-items-center">
            <div class="avatar avatar-tag bg-light-primary me-1">
              <i data-feather="bookmark" class="font-medium-4"></i>
            </div>
            <div>
              <h4 class="mb-0">Unidades</h4>
              <span>como utilizar o sistema?</span>
            </div>
          </div>

          <!-- frequent answer and question  collapse  -->
          <div class="accordion accordion-margin mt-2" id="faq-administradores-qna">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="administradoresOne">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-administradores-one"
                  aria-expanded="false"
                  aria-controls="faq-administradores-one"
                >
                  Como cadastrar e Editar Unidades?
                </button>
              </h2>

              <div
                id="faq-administradores-one"
                class="collapse"
                aria-labelledby="administradoresOne"
                data-bs-parent="#faq-administradores-qna"
              >
                <div class="accordion-body">
                  No menu lateral selecione Unidades no menu Setores. Na tela aparecerá o formulário de cadastro e a listagem de Unidades Cadastradas.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="administradoresTwo">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-administradores-two"
                  aria-expanded="false"
                  aria-controls="faq-administradores-two"
                >
                  Como cadastrar e editar setores?
                </button>
              </h2>
              <div
                id="faq-administradores-two"
                class="collapse"
                aria-labelledby="administradoresTwo"
                data-bs-parent="#faq-administradores-qna"
              >
                <div class="accordion-body">
                  Pelo menu administrativo encontrará acess as páginas que gerenciam todos os setores e departamentos
                  do seu sistema.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="administradoresThree">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-administradores-three"
                  aria-expanded="false"
                  aria-controls="faq-administradores-three"
                >
                  Como cadastrar e editar usuários?
                </button>
              </h2>
              <div
                id="faq-administradores-three"
                class="collapse"
                aria-labelledby="administradoresThree"
                data-bs-parent="#faq-administradores-qna"
              >
                <div class="accordion-body">
                  Você encontrará pelo menu lateral aopção de gerenciar usuários, por ela será possivel cadastrar e
                  editar usuários no sistema.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="administradoresFour">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-administradores-four"
                  aria-expanded="false"
                  aria-controls="faq-administradores-four"
                >
                  Os usuários não possuem acesso ao sistema?
                </button>
              </h2>
              <div
                id="faq-administradores-four"
                class="collapse"
                aria-labelledby="administradoresFour"
                data-bs-parent="#faq-administradores-qna"
              >
                <div class="accordion-body">
                  Os usuários depois de cadastrados precisam recebar acesso ao sistema pelo Administrador Master do seu sistema.
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- my relatorios -->
        <div class="tab-pane" id="faq-my-relatorios" role="tabpanel" aria-labelledby="my-relatorios" aria-expanded="false">
          <!-- icon and header -->
          <div class="d-flex align-items-center">
            <div class="avatar avatar-tag bg-light-primary me-1">
              <i data-feather="pie-chart" class="font-medium-4"></i>
            </div>
            <div>
              <h4 class="mb-0">Relatorioss</h4>
              <span>o que encontro?</span>
            </div>
          </div>

          <!-- frequent answer and question  collapse  -->
          <div class="accordion accordion-margin mt-2" id="faq-my-relatorios-qna">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="myrelatoriosOne">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-my-relatorios-one"
                  aria-expanded="false"
                  aria-controls="faq-my-relatorios-one"
                >
                  Quais são os tipos de relatórios?
                </button>
              </h2>

              <div
                id="faq-my-relatorios-one"
                class="collapse accordion-collapse"
                aria-labelledby="myrelatoriosOne"
                data-bs-parent="#faq-my-relatorios-qna"
              >
                <div class="accordion-body">
                  O Administrador pode gerra Relatórios de RAS, e seus tipos são
                  relacionados a Diários, Mensal, Anual e entre Datas.
                  para fazer relatórios semanais utilize o tipo entre datas .
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="myrelatoriosTwo">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-my-relatorios-two"
                  aria-expanded="false"
                  aria-controls="faq-my-relatorios-two"
                >
                  Como gero pdf e impressão?
                </button>
              </h2>
              <div
                id="faq-my-relatorios-two"
                class="collapse accordion-collapse"
                aria-labelledby="myrelatoriosTwo"
                data-bs-parent="#faq-my-relatorios-qna"
              >
                <div class="accordion-body">
                  O resultado do relatório escolhido estará em formato para impressão,
                  apenas é necessário acessar o modo de impressão do seu navegador,
                  podendo gerar PDFs através deste também.
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- rules services -->
        <div class="tab-pane" id="faq-rules" role="tabpanel" aria-labelledby="rules" aria-expanded="false" >
          <!-- icon and header -->
          <div class="d-flex align-items-center">
            <div class="avatar avatar-tag bg-light-primary me-1">
              <i data-feather="shield" class="font-medium-4"></i>
            </div>
            <div>
              <h4 class="mb-0">Regras e Permissões</h4>
              <span>como dar permissões no sistema?</span>
            </div>
          </div>

          <!-- frequent answer and question  collapse  -->
          <div class="accordion accordion-margin mt-2" id="faq-rules-qna">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="rulesOne">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-rules-one"
                  aria-expanded="false"
                  aria-controls="faq-rules-one"
                >
                  Onde eu dou Permissões aos usuários?
                </button>
              </h2>

              <div
                id="faq-rules-one"
                class="collapse accordion-collapse"
                aria-labelledby="rulesOne"
                data-bs-parent="#faq-rules-qna"
              >
                <div class="accordion-body">
                  Através do menu lateral, você encontrará o menu de acessoa  Regras e Permissões,
                  através dele poderá dar acesso aos seus funcionários
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="rulesTwo">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-rules-two"
                  aria-expanded="false"
                  aria-controls="faq-rules-two"
                >
                  Quem pode receber permissões?
                </button>
              </h2>
              <div
                id="faq-rules-two"
                class="collapse accordion-collapse"
                aria-labelledby="rulesTwo"
                data-bs-parent="#faq-rules-qna"
              >
                <div class="accordion-body">
                  Todos os usuários do Sistema precisam ter permissões para poder acessar-lo.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="rulesThree">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-rules-three"
                  aria-expanded="false"
                  aria-controls="faq-rules-three"
                >
                  Como Criar Regras?
                </button>
              </h2>
              <div
                id="faq-rules-three"
                class="collapse"
                aria-labelledby="rulesThree"
                data-bs-parent="#faq-rules-qna"
              >
                <div class="accordion-body">
                  Para criar Regras entre em contato com o CODE.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / frequently asked questions tabs pills -->

<!-- contact us -->
<section class="faq-contact">
  <div class="row mt-5 pt-75">
    <div class="col-12 text-center">
      <h2>Você ainda tem alguma dúvida?</h2>
      <p class="mb-3">
        entre em contato com sua administração!
      </p>
    </div>
  </div>
</section>
<!--/ contact us -->
@endsection
