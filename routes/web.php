<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActController;
use App\Http\Controllers\ActTopicController;
use App\Http\Controllers\OfficialDiarySearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtensionController;

use App\Http\Controllers\PeopleController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AgreementTypeController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BiddingAgreementController;
use App\Http\Controllers\BiddingController;
use App\Http\Controllers\BiddingItemController;
use App\Http\Controllers\BiddingModalityController;
use App\Http\Controllers\BiddingWinnerController;
use App\Http\Controllers\BlankPageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\DirectHireController;
use App\Http\Controllers\DirectHireWinnerController;
use App\Http\Controllers\DirectHireItemController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EntryReportsController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\LegislationBondController;
use App\Http\Controllers\LegislationCategoryController;
use App\Http\Controllers\LegislationController;
use App\Http\Controllers\LegislationSituationController;
use App\Http\Controllers\LegislationSubjectController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\OmbudsmanController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMediaController;
use App\Http\Controllers\SensitiveInformationCategoryController;
use App\Http\Controllers\SensitiveInformationController;
use App\Http\Controllers\SensitiveInformationResponsibleController;
use App\Http\Controllers\CopyrightController;
use App\Http\Controllers\InternalPages;

use App\Http\Controllers\RevenueController;
use App\Http\Controllers\RevenueTypeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TypeAccessController;
use App\Http\Controllers\TypeExpenseController;
use App\Http\Controllers\TypeRequestController;
use App\Http\Controllers\UserController;
use App\Models\DirectHireModality;

/*************************/
/* WEB CONTROLLERS */
/*************************/
use App\Http\Controllers\HomeWebController;
use App\Http\Controllers\PublicationWebController;
use App\Http\Controllers\FAQWebController;
use App\Http\Controllers\GalleryTypeController;
use App\Http\Controllers\OfficialDiaryController;
use App\Http\Controllers\ProjectProgressController;
use App\Http\Controllers\ProjectResponsibleController;
use App\Http\Controllers\ShortcutWebController;
use App\Http\Controllers\WebFooterController;
use App\Http\Controllers\WebFooterLogoController;

/*
|--------------------------------------------------------------------------
| Main Routes
|--------------------------------------------------------------------------
*/
//Ouvidoria - Ombudsman
Route::get('/ouvidoria_web', 'App\Http\Controllers\OmbudsmanController@web_ouvidoria')->name('web_ouvidoria');
Route::post('/ombudsman_store', 'App\Http\Controllers\OmbudsmanController@ombudsman_store')->name('ombudsman_store');

//Type Access -
Route::get('/type_access_select', 'App\Http\Controllers\TypeAccessController@select')->name('type_access_select');
//file downloadfile
Route::get('/file_web/{file_id}', 'App\Http\Controllers\FileController@file_web')->name('file_web');
//Unit
Route::post('unidade_social_media_add', 'App\Http\Controllers\UnitController@unidade_social_media_add')->name('unidade_social_media_add');
Route::post('unidade_social_media_remove', 'App\Http\Controllers\UnitController@unidade_social_media_remove')->name('unidade_social_media_remove');
Route::post('unidade_social_media_update', 'App\Http\Controllers\UnitController@unidade_social_media_update')->name('unidade_social_media_update');
Route::get('unidade_social_media_delete/{social_media}', 'App\Http\Controllers\UnitController@unidade_social_media_delete')->name('unidade_social_media_delete');

/* Route CODE não pode alterar*/
Route::group(['middleware' => ['auth']], function () {

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
    Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');

    Route::resource('permissions', PermissionsController::class);
    Route::delete('permissions_mass_destroy', 'App\Http\Controllers\Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', RolesController::class);
    Route::delete('roles_mass_destroy', [RolesController::class, 'massDestroy'])->name('roles.mass_destroy');
    Route::resource('users', UsersController::class );
    Route::delete('users_mass_destroy', [UsersController::class, 'massDestroy'])->name('users.mass_destroy');
    Route::get('user_rule_create/{idUser}', [RolesController::class, 'user_rule_create'])->name('user_rule_create');
    Route::post('user_rule_store', [RolesController::class, 'user_rule_store'])->name('user_rule_store');


    //Main - Pessoas
    Route::resource('/pessoas', PeopleController::class);
    Route::resource('/telefones', PhoneController::class);
    Route::resource('/documentos', DocumentController::class);
    Route::resource('/emails', EmailController::class);
    Route::resource('/enderecos', AddressController::class);
    //Main - Departamentos
    Route::resource('/unidades', UnitController::class);
    Route::resource('/departamentos', DepartamentController::class);
    Route::resource('/organizacoes', OrganizationController::class);
    Route::resource('/ocupacoes', OccupationController::class);
    //Main - Arquivos
    Route::resource('/arquivos', FileController::class);
    //Main - Capa do site
    Route::resource('/capas', PostController::class);
    //Main - Notícias
    Route::resource('/noticias', NewsController::class);
    Route::resource('/noticia_categorias', CategoryController::class);
    Route::resource('/noticia_tags', TagController::class);
    //Main - Notificações
    Route::resource('/notificacoes', NotificationController::class);
    //Main - Ouvidoria ouvidoria_requisicoes
    Route::resource('/ouvidoria_manifestacoes', OmbudsmanController::class);
    Route::resource('/ouvidoria_acessos', TypeAccessController::class);
    Route::resource('/ouvidoria_requisicoes', TypeRequestController::class);
    //Main - Transparência - Diário Official
    Route::resource('/diarios_oficiais', OfficialDiaryController::class);
    Route::resource('/atos', ActController::class);
    Route::resource('/ato_topicos', ActTopicController::class);
    //Main - Transparência - Despesas
    Route::resource('/despesa_tipos', TypeExpenseController::class);
    Route::resource('/despesas', ExpenseController::class);
    //Main - Transparência - Receitas
    Route::resource('/receita_tipos', RevenueTypeController::class);
    Route::resource('/receitas', RevenueController::class);
    //Main - Transparência - Legislações
    Route::resource('/legislacoes', LegislationController::class);
    Route::resource('/legislacao_assuntos', LegislationSubjectController::class);
    Route::resource('/legislacao_categorias', LegislationCategoryController::class);
    Route::resource('/legislacao_situacoes', LegislationSituationController::class);
    Route::resource('/legislacao_vinculos', LegislationBondController::class);
    //Main - Transparência - Licitações
    Route::resource('/licitacoes', BiddingController::class);
    Route::resource('/licitacao_modalidades', BiddingModalityController::class);
    Route::resource('/licitacao_items', BiddingItemController::class);
    Route::resource('/licitacao_vencedores', BiddingWinnerController::class);
    Route::resource('/licitacao_contratos', BiddingAgreementController::class);
    Route::resource('/licitacao_contrato_tipos', AgreementTypeController::class);
    //Main - Transparência - Contatações diretas
    Route::resource('/contratacoes_diretas', DirectHireController::class);
    Route::resource('/contratacao_direta_modalidades', DirectHireModality::class);
    Route::resource('/contratacao_direta_vencedores', DirectHireWinnerController::class);
    Route::resource('/contratacao_direta_itens', DirectHireItemController::class);
    //Main - Projetos
    Route::resource('/projetos', ProjectController::class);
    Route::resource('/projeto_categorias', ProjectCategoryController::class);
    Route::resource('/projeto_responsaveis', ProjectResponsibleController::class);
    Route::resource('/projeto_progressos', ProjectProgressController::class);
    Route::resource('/projeto_medias', ProjectMediaController::class);

    //Main - Sensitive Informations
    Route::resource('/info_sensiveis', SensitiveInformationController::class);
    Route::resource('/info_sensiveis_categorias', SensitiveInformationCategoryController::class);
    Route::resource('/info_sensiveis_responsaveis', SensitiveInformationResponsibleController::class);
    //Route::resource('/info_sensiveis_medias', SensitiveInformationMediaController::class);
    //Main - faq
    Route::resource('/faqs', FAQController::class);
    //Main - Gallery
    Route::resource('/galeria_imagens', GalleryController::class);
    Route::resource('/galeria_tipos', GalleryTypeController::class);
    //Main - Leadership
    Route::resource('/liderancas', LeadershipController::class);
    //Main - about
    Route::resource('/sobres', AboutController::class);
    //Main - Banner
    Route::resource('/banners', BannerController::class);
    //Main - Shortcutweb
    Route::resource('/web_atalhos', ShortcutWebController::class);
    //Main - CopyRight
    Route::resource('/copyrights', CopyrightController::class);
    //Main - WebFooter
    Route::resource('/webfooters', WebFooterController::class);
    Route::resource('/webfooter_logos', WebFooterLogoController::class);
    Route::get('web_footer_logo_create/{web_footer_id}', [WebFooterLogoController::class, 'create_logo'])->name('web_footer_logo_create');

    //Main - blankpage
    Route::resource('/paginas', BlankPageController::class);


    //Notícias
    //Route::post('ajaxRegister', ['as' => 'ajax.storecontent', 'uses' => 'App\Http\Controllers\NewsController@store_content']);
    Route::post('/savenewscontent', [NewsController::class, 'store_content'])->name('store_content');

    //people
    Route::get('store_people', [PeopleController::class, 'store_people'])->name('store_people');

    //Legislation Vínculo
    Route::post('legislacao_vinculo/{base}', [LegislationController::class, 'legislacao_vinculo'])->name('legislacao_vinculo');

    //Address
    Route::get('address/get-cidades/{idEstado}', 'App\Http\Controllers\AddressController@getCidades');
    //Notifications
    Route::get('notification/readed/{idNotification}', 'App\Http\Controllers\NotificationController@changeReaded');
    //departaments
    Route::get('departament/get-departamentos/{idUnit}', 'App\Http\Controllers\DepartamentController@getDepartamentos');
    Route::get('departament/get-occupations/{idDepartament}', 'App\Http\Controllers\DepartamentController@getOccupations');

    //licitação Vínculo de winner e itens
    Route::post('winner_add_itens/{person_id}', [BiddingWinnerController::class, 'winner_add_itens'])->name('winner_add_itens');
    Route::post('winner_remove_itens', [BiddingWinnerController::class, 'winner_remove_itens'])->name('winner_remove_itens');
    Route::get('winner_itens/{person_id}', [BiddingWinnerController::class, 'winner_itens'])->name('winner_itens');


    //reports ----------------------------- REPORTS -----------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------

    // ombudsman
    Route::get('report_ombudsman_index', [OmbudsmanController::class, 'report_ombudsman_index'])->name('report_ombudsman_index');
    Route::post('report_ombudsman_pdf', [OmbudsmanController::class, 'report_ombudsman_pdf'])->name('report_ombudsman_pdf');

    //reports ----------------------------- Audits -----------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------

    // entradas
    Route::get('entry_index', [EntryReportsController::class, 'entry_index'])->name('entry_index');

});
/* Route CODE */

/* Route Usuarios */
Route::group(['middleware' => ['auth'], 'prefix' => 'usuarios'], function () {
    Route::post('/usuarios/update/password', [UserController::class, 'updatePassword'])->name('update-password');
    Route::post('/usuarios/update/email', [UserController::class, 'updateEmail'])->name('update-email');
    Route::post('/usuarios/update/photo', [UserController::class, 'updatePhoto'])->name('update-photo');
});
/* Route Usuarios */

/* Route Help */
Route::group(['middleware' => ['auth'], 'prefix' => 'help'], function () {
    Route::get('faq', [ExtensionController::class, 'faq'])->name('faq');
});
/* Route Help */


        /********************/
        /* WEB/SITE ROUTES */
        /********************/


    //  ROTA HOME
    Route::get('/', [HomeWebController::class, 'index'])->name('web_home');

    //~ ROTAS WEB ~~~


    // Internal pages
    Route::get('/links_uteis', 'App\Http\Controllers\InternalPages@links_uteis')->name('links_uteis');

    // BlankPages
    Route::get('/pagina_web/{blank_page}', [BlankPageController::class, 'pagina_web'])->name('pagina_web');


    // Galeria WEB
    Route::get('/gallery_web_index', [GalleryController::class, 'gallery_web_index'])->name('gallery_web_index');


    //news
    Route::get('/noticia_web/{new}', 'App\Http\Controllers\WebController@news_web_show')->name('news_web_show');
    Route::get('/noticias_web', 'App\Http\Controllers\WebController@news_web_index')->name('news_web_index');


    //official diary
    Route::get('/pdf_official_diary_acts/{official_diary}', 'App\Http\Controllers\OfficialDiaryController@pdf_official_diary_acts')->name('pdf_official_diary_acts');
    Route::get('/diario_oficial_web/{official_diary}', 'App\Http\Controllers\OfficialDiaryController@official_diary_web_show')->name('official_diary_web_show');
    Route::get('/diarios_oficiais_web', [OfficialDiarySearchController::class, 'index'])->name('official_diary_web_index');
    Route::get('/web_pdf_official_diary_acts/{official_diary}', 'App\Http\Controllers\OfficialDiaryController@web_pdf_official_diary_acts')->name('web_pdf_official_diary_acts');
    Route::post('/diarios_oficiais_web_filter_text', 'App\Http\Controllers\OfficialDiaryController@diarios_oficiais_web_filter_text')->name('diarios_oficiais_web_filter_text');
    Route::post('/diarios_oficiais_web_filter_year', 'App\Http\Controllers\OfficialDiaryController@diarios_oficiais_web_filter_year')->name('diarios_oficiais_web_filter_year');
    Route::post('/diarios_oficiais_web_filter_date', 'App\Http\Controllers\OfficialDiaryController@diarios_oficiais_web_filter_date')->name('diarios_oficiais_web_filter_date');

    // ROTA PROJETOS WEB
    Route::get('/projeto_web/{project_id}', [ProjectController::class, 'web_show'])->name('project_web_show');
    Route::get('/projeto_web', [ProjectController::class, 'web_index'])->name('projects_web_index');
    Route::get('/project_category_web/{category_id}', [ProjectController::class, 'web_category_show'])->name('project_category_web');

    // ROTA SIGILOS WEB
    Route::get('/info_sensiveis_web/{project_id}', [SensitiveInformationController::class, 'web_show'])->name('projectinfo_sensiveis_web_show');
    Route::get('/info_sensiveis_web', [SensitiveInformationController::class, 'web_index'])->name('info_sensiveis_web_index');
    Route::get('/info_sensiveis_category_web/{category_id}', [SensitiveInformationController::class, 'web_category_show'])->name('info_sensiveis_category_web');


    // WEB TRANSPARÊNCIA
    Route::any('/despesas_index', 'App\Http\Controllers\ExpenseController@web_index')->name('web_expense_index');
    Route::get('/web_expense_show/{expense}', 'App\Http\Controllers\ExpenseController@web_show')->name('web_expense_show');
    Route::any('/receitas_index', 'App\Http\Controllers\RevenueController@web_index')->name('web_revenue_index');
    Route::get('/web_revenue_show/{revenue}', 'App\Http\Controllers\RevenueController@web_show')->name('web_revenue_show');
    Route::any('/legislacoes_index', 'App\Http\Controllers\LegislationController@index_web')->name('web_legislacoes_index');

    Route::get('/contratacao_direta_index', 'App\Http\Controllers\DirectHireController@index_web')->name('web_direct_hire_index');
    Route::get('/web_direct_hire_show/{direct_hire_id}', 'App\Http\Controllers\DirectHireController@show_web')->name('web_direct_hire_show');
    Route::get('/web_direct_hire_winner_show/{winner_id}', 'App\Http\Controllers\DirectHireWinnerController@show_web')->name('web_direct_hire_winner_show');
    Route::any('/licitacao_index', 'App\Http\Controllers\BiddingController@index_web')->name('web_bididng_index');
    Route::get('/web_bididng_show/{bididng}', 'App\Http\Controllers\BiddingController@show_web')->name('web_bididng_show');
    Route::any('/contratos_index', 'App\Http\Controllers\BiddingAgreementController@index_web')->name('web_bididng_agreement_index');
    Route::get('/web_bididng_agreement_show/{bidding_agreement_id}', 'App\Http\Controllers\BiddingAgreementController@show_web')->name('web_bididng_agreement_show');

    Route::get('/web_bididng_winner_show/{winner_id}', 'App\Http\Controllers\BiddingWinnerController@show_web')->name('web_bididng_winner_show');


//~ ROTAS INSTITUCIONAIS END ~~~


//~ ROTAS DE SEVIÇOS END ~~~

//~ ROTAS PROGRAMA MEU AMBIENTE ~~~


//~ ROTAS PROGRAMA MEU AMBIENTE END~~~


//~ ROTAS PUBLICAÇÕES ~~~

    // ROTA NOTICIAS

        Route::get('/noticias_web/{noticia_id}', [NewsController::class, 'web_show'])->name('noticia_web_show');
        Route::get('/noticias_web', [NewsController::class, 'web_index'])->name('noticias_web_index');

//~ ROTAS PUBLICAÇÕES END~~~




// ROTA OUVIDORIA
Route::get('/ouvidoria',[OmbudsmanController::class, 'web_ouvidoria'])->name('web_ombudsman');
Route::post('/ombudsman_store', [OmbudsmanController::class, 'ombudsman_store'])->name('ombudsman_store');



//  ROTA PUBLICAÇÃO
Route::prefix('publicacao')->group(function(){
    Route::get('/publicacoessemas',[PublicationWebController::class, 'home'])->name('web_publication.home');
    Route::get('/pesquisas',[PublicationWebController::class, 'researchs'])->name('web_publication.researchs');
});


//  ROTA LEGISLAÇÃO
Route::get('/legislacao/{legislation_id}', [LegislationController:: class, 'show_web'])->name('web_legislation_show');

//ROTA FAQ
Route::get('/faq', [FAQWebController::class, 'index'])->name('web_faq');


//

/********************/

/* END WEB/SITE ROUTES */
/***********************/


require __DIR__.'/auth.php';
require __DIR__.'/dev.php';
require __DIR__.'/filters.php';
require __DIR__.'/reports.php';
