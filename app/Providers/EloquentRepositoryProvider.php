<?php

namespace App\Providers;

use App\Repositories\Eloquent\AddressEloquentRepository;
use App\Repositories\Eloquent\AddressCreateEloquentRepository;
use App\Repositories\Eloquent\AddressUpdateEloquentRepository;
use App\Repositories\Eloquent\CityEloquentRepository;
use App\Repositories\Eloquent\CountryEloquentRepository;
use App\Repositories\Eloquent\DocumentEloquentRepository;
use App\Repositories\Eloquent\DocumentTypeEloquentRepository;
use App\Repositories\Eloquent\GenreEloquentRepository;
use App\Repositories\Eloquent\MatrialStatusEloquentRepository;
use App\Repositories\Eloquent\EmailEloquentRepository;
use App\Repositories\Eloquent\EmailCreateEloquentRepository;
use App\Repositories\Eloquent\EmailUpdateEloquentRepository;
use App\Repositories\Eloquent\IndividualPersonEloquentRepository;
use App\Repositories\Eloquent\LegalPersonEloquentRepository;
use App\Repositories\Eloquent\NotificationEloquentRepository;
use App\Repositories\Eloquent\NotificationCreateEloquentRepository;
use App\Repositories\Eloquent\NotificationUpdateEloquentRepository;
use App\Repositories\Eloquent\NotificationUserEloquentRepository;
use App\Repositories\Eloquent\OccupationEloquentRepository;
use App\Repositories\Eloquent\OccupationCreateEloquentRepository;
use App\Repositories\Eloquent\OccupationUpdateEloquentRepository;
use App\Repositories\Eloquent\PersonEloquentRepository;
use App\Repositories\Eloquent\PersonCreateEloquentRepository;
use App\Repositories\Eloquent\PersonUpdateEloquentRepository;
use App\Repositories\Eloquent\PhoneEloquentRepository;
use App\Repositories\Eloquent\PhoneCreateEloquentRepository;
use App\Repositories\Eloquent\PhoneUpdateEloquentRepository;
use App\Repositories\Eloquent\DepartamentEloquentRepository;
use App\Repositories\Eloquent\DepartamentCreateEloquentRepository;
use App\Repositories\Eloquent\DepartamentUpdateEloquentRepository;
use App\Repositories\Eloquent\StateEloquentRepository;
use App\Repositories\Eloquent\UnitEloquentRepository;
use App\Repositories\Eloquent\UnitCreateEloquentRepository;
use App\Repositories\Eloquent\UnitUpdateEloquentRepository;
use App\Repositories\Eloquent\UserEloquentRepository;

//SEMAS -------------------------------------------------------------
use App\Repositories\Eloquent\ShortcutWebEloquentRepository;
use App\Repositories\Eloquent\ShortcutWebCreateEloquentRepository;
use App\Repositories\Eloquent\ShortcutWebUpdateEloquentRepository;

//FIPAC -------------------------------------------------------------
use App\Repositories\Eloquent\OrganizationEloquentRepository;
use App\Repositories\Eloquent\OrganizationCreateEloquentRepository;
use App\Repositories\Eloquent\OrganizationUpdateEloquentRepository;

use App\Repositories\Eloquent\OmbudsmanEloquentRepository;
use App\Repositories\Eloquent\OmbudsmanCreateEloquentRepository;
use App\Repositories\Eloquent\OmbudsmanUpdateEloquentRepository;

use App\Repositories\Eloquent\TypeAccessEloquentRepository;
use App\Repositories\Eloquent\TypeAccessCreateEloquentRepository;
use App\Repositories\Eloquent\TypeAccessUpdateEloquentRepository;

use App\Repositories\Eloquent\TypeExpenseEloquentRepository;
use App\Repositories\Eloquent\TypeExpenseCreateEloquentRepository;
use App\Repositories\Eloquent\TypeExpenseUpdateEloquentRepository;

use App\Repositories\Eloquent\TypeRequestEloquentRepository;
use App\Repositories\Eloquent\TypeRequestCreateEloquentRepository;
use App\Repositories\Eloquent\TypeRequestUpdateEloquentRepository;

use App\Repositories\Eloquent\RevenueEloquentRepository;
use App\Repositories\Eloquent\RevenueCreateEloquentRepository;
use App\Repositories\Eloquent\RevenueUpdateEloquentRepository;

use App\Repositories\Eloquent\RevenueTypeEloquentRepository;
use App\Repositories\Eloquent\RevenueTypeCreateEloquentRepository;
use App\Repositories\Eloquent\RevenueTypeUpdateEloquentRepository;

use App\Repositories\Eloquent\ExpenseEloquentRepository;
use App\Repositories\Eloquent\ExpenseCreateEloquentRepository;
use App\Repositories\Eloquent\ExpenseUpdateEloquentRepository;

use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\CategoryCreateEloquentRepository;
use App\Repositories\Eloquent\CategoryUpdateEloquentRepository;

use App\Repositories\Eloquent\FileEloquentRepository;
use App\Repositories\Eloquent\FileCreateEloquentRepository;
use App\Repositories\Eloquent\FileUpdateEloquentRepository;

use App\Repositories\Eloquent\TagEloquentRepository;
use App\Repositories\Eloquent\TagCreateEloquentRepository;
use App\Repositories\Eloquent\TagUpdateEloquentRepository;

use App\Repositories\Eloquent\LegislationEloquentRepository;
use App\Repositories\Eloquent\LegislationCreateEloquentRepository;
use App\Repositories\Eloquent\LegislationUpdateEloquentRepository;
use App\Repositories\Eloquent\LegislationBondEloquentRepository;
use App\Repositories\Eloquent\LegislationBondCreateEloquentRepository;
use App\Repositories\Eloquent\LegislationBondUpdateEloquentRepository;
use App\Repositories\Eloquent\LegislationCategoryEloquentRepository;
use App\Repositories\Eloquent\LegislationCategoryCreateEloquentRepository;
use App\Repositories\Eloquent\LegislationCategoryUpdateEloquentRepository;
use App\Repositories\Eloquent\LegislationSituationEloquentRepository;
use App\Repositories\Eloquent\LegislationSituationCreateEloquentRepository;
use App\Repositories\Eloquent\LegislationSituationUpdateEloquentRepository;
use App\Repositories\Eloquent\LegislationSubjectEloquentRepository;
use App\Repositories\Eloquent\LegislationSubjectCreateEloquentRepository;
use App\Repositories\Eloquent\LegislationSubjectUpdateEloquentRepository;

use App\Repositories\Eloquent\NewsEloquentRepository;
use App\Repositories\Eloquent\NewsCreateEloquentRepository;
use App\Repositories\Eloquent\NewsUpdateEloquentRepository;

use App\Repositories\Eloquent\PostEloquentRepository;
use App\Repositories\Eloquent\PostCreateEloquentRepository;
use App\Repositories\Eloquent\PostUpdateEloquentRepository;

use App\Repositories\Eloquent\BiddingEloquentRepository;
use App\Repositories\Eloquent\BiddingCreateEloquentRepository;
use App\Repositories\Eloquent\BiddingUpdateEloquentRepository;
use App\Repositories\Eloquent\BiddingModalityEloquentRepository;
use App\Repositories\Eloquent\BiddingModalityCreateEloquentRepository;
use App\Repositories\Eloquent\BiddingModalityUpdateEloquentRepository;
use App\Repositories\Eloquent\BiddingAreaEloquentRepository;
use App\Repositories\Eloquent\BiddingAreaCreateEloquentRepository;
use App\Repositories\Eloquent\BiddingAreaUpdateEloquentRepository;
use App\Repositories\Eloquent\BiddingItemEloquentRepository;
use App\Repositories\Eloquent\BiddingItemCreateEloquentRepository;
use App\Repositories\Eloquent\BiddingItemUpdateEloquentRepository;
use App\Repositories\Eloquent\BiddingWinnerEloquentRepository;
use App\Repositories\Eloquent\BiddingWinnerCreateEloquentRepository;
use App\Repositories\Eloquent\BiddingWinnerUpdateEloquentRepository;
use App\Repositories\Eloquent\BiddingAgreementEloquentRepository;
use App\Repositories\Eloquent\BiddingAgreementCreateEloquentRepository;
use App\Repositories\Eloquent\BiddingAgreementUpdateEloquentRepository;

use App\Repositories\Eloquent\AgreementFileEloquentRepository;
use App\Repositories\Eloquent\AgreementTypeEloquentRepository;
use App\Repositories\Eloquent\AgreementTypeCreateEloquentRepository;
use App\Repositories\Eloquent\AgreementTypeUpdateEloquentRepository;

use App\Repositories\Eloquent\DirectHireEloquentRepository;
use App\Repositories\Eloquent\DirectHireCreateEloquentRepository;
use App\Repositories\Eloquent\DirectHireUpdateEloquentRepository;

use App\Repositories\Eloquent\DirectHireWinnerEloquentRepository;
use App\Repositories\Eloquent\DirectHireWinnerCreateEloquentRepository;
use App\Repositories\Eloquent\DirectHireWinnerUpdateEloquentRepository;

use App\Repositories\Eloquent\DirectHireItemEloquentRepository;
use App\Repositories\Eloquent\DirectHireItemCreateEloquentRepository;
use App\Repositories\Eloquent\DirectHireItemUpdateEloquentRepository;

use App\Repositories\Eloquent\ProjectEloquentRepository;
use App\Repositories\Eloquent\ProjectCreateEloquentRepository;
use App\Repositories\Eloquent\ProjectUpdateEloquentRepository;

use App\Repositories\Eloquent\ProjectCategoryEloquentRepository;
use App\Repositories\Eloquent\ProjectCategoryCreateEloquentRepository;
use App\Repositories\Eloquent\ProjectCategoryUpdateEloquentRepository;

use App\Repositories\Eloquent\ProjectMediaEloquentRepository;
use App\Repositories\Eloquent\ProjectMediaCreateEloquentRepository;
use App\Repositories\Eloquent\ProjectMediaUpdateEloquentRepository;

use App\Repositories\Eloquent\FaqEloquentRepository;
use App\Repositories\Eloquent\FaqCreateEloquentRepository;
use App\Repositories\Eloquent\FaqUpdateEloquentRepository;

use App\Repositories\Eloquent\GalleryEloquentRepository;
use App\Repositories\Eloquent\GalleryCreateEloquentRepository;
use App\Repositories\Eloquent\GalleryUpdateEloquentRepository;

use App\Repositories\Eloquent\GalleryTypeEloquentRepository;
use App\Repositories\Eloquent\GalleryTypeCreateEloquentRepository;
use App\Repositories\Eloquent\GalleryTypeUpdateEloquentRepository;

use App\Repositories\Eloquent\LeadershipEloquentRepository;
use App\Repositories\Eloquent\LeadershipCreateEloquentRepository;
use App\Repositories\Eloquent\LeadershipUpdateEloquentRepository;

use App\Repositories\Eloquent\AboutEloquentRepository;
use App\Repositories\Eloquent\AboutCreateEloquentRepository;
use App\Repositories\Eloquent\AboutUpdateEloquentRepository;

use App\Repositories\Eloquent\BannerEloquentRepository;
use App\Repositories\Eloquent\BannerCreateEloquentRepository;
use App\Repositories\Eloquent\BannerUpdateEloquentRepository;

use App\Repositories\Eloquent\CopyrightEloquentRepository;
use App\Repositories\Eloquent\CopyrightCreateEloquentRepository;
use App\Repositories\Eloquent\CopyrightUpdateEloquentRepository;

use App\Repositories\Eloquent\WebFooterEloquentRepository;
use App\Repositories\Eloquent\WebFooterCreateEloquentRepository;
use App\Repositories\Eloquent\WebFooterUpdateEloquentRepository;

use App\Repositories\Eloquent\WebFooterLogoEloquentRepository;
use App\Repositories\Eloquent\WebFooterLogoCreateEloquentRepository;
use App\Repositories\Eloquent\WebFooterLogoUpdateEloquentRepository;

use App\Repositories\Eloquent\BlankPageEloquentRepository;
use App\Repositories\Eloquent\BlankPageCreateEloquentRepository;
use App\Repositories\Eloquent\BlankPageUpdateEloquentRepository;

use App\Repositories\Eloquent\ProjectProgressEloquentRepository;
use App\Repositories\Eloquent\ProjectProgressCreateEloquentRepository;
use App\Repositories\Eloquent\ProjectProgressUpdateEloquentRepository;

use App\Repositories\Eloquent\ProjectResponsibleEloquentRepository;
use App\Repositories\Eloquent\ProjectResponsibleCreateEloquentRepository;
use App\Repositories\Eloquent\ProjectResponsibleUpdateEloquentRepository;

use App\Repositories\Eloquent\SensitiveInformationEloquentRepository;
use App\Repositories\Eloquent\SensitiveInformationCreateEloquentRepository;
use App\Repositories\Eloquent\SensitiveInformationUpdateEloquentRepository;

use App\Repositories\Eloquent\SensitiveInformationCategoryEloquentRepository;
use App\Repositories\Eloquent\SensitiveInformationCategoryCreateEloquentRepository;
use App\Repositories\Eloquent\SensitiveInformationCategoryUpdateEloquentRepository;

use App\Repositories\Eloquent\SensitiveInformationMediaEloquentRepository;
use App\Repositories\Eloquent\SensitiveInformationMediaCreateEloquentRepository;
use App\Repositories\Eloquent\SensitiveInformationMediaUpdateEloquentRepository;

use App\Repositories\Eloquent\SensitiveInformationResponsibleEloquentRepository;
use App\Repositories\Eloquent\SensitiveInformationResponsibleCreateEloquentRepository;
use App\Repositories\Eloquent\SensitiveInformationResponsibleUpdateEloquentRepository;

use App\Repositories\Eloquent\ActEloquentRepository;
use App\Repositories\Eloquent\ActCreateEloquentRepository;
use App\Repositories\Eloquent\ActUpdateEloquentRepository;

use App\Repositories\Eloquent\ActTopicEloquentRepository;
use App\Repositories\Eloquent\ActTopicCreateEloquentRepository;
use App\Repositories\Eloquent\ActTopicUpdateEloquentRepository;

use App\Repositories\Eloquent\OfficialDiaryEloquentRepository;
use App\Repositories\Eloquent\OfficialDiaryCreateEloquentRepository;
use App\Repositories\Eloquent\OfficialDiaryUpdateEloquentRepository;

use App\Repositories\RepositoryInterface;


use App\Services\AddressService;
use App\Services\AddressCreateService;
use App\Services\AddressUpdateService;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\DocumentService;
use App\Services\DocumentTypeService;
use App\Services\GenreService;
use App\Services\MatrialStatusService;
use App\Services\EmailService;
use App\Services\EmailCreateService;
use App\Services\EmailUpdateService;
use App\Services\IndividualPersonService;
use App\Services\LegalPersonService;
use App\Services\NotificationService;
use App\Services\NotificationCreateService;
use App\Services\NotificationUpdateService;
use App\Services\NotificationUserService;
use App\Services\PersonService;
use App\Services\PersonCreateService;
use App\Services\PersonUpdateService;
use App\Services\PhoneService;
use App\Services\PhoneCreateService;
use App\Services\PhoneUpdateService;
use App\Services\DepartamentService;
use App\Services\DepartamentCreateService;
use App\Services\DepartamentUpdateService;
use App\Services\OccupationService;
use App\Services\OccupationCreateService;
use App\Services\OccupationUpdateService;
use App\Services\StateService;
use App\Services\UnitService;
use App\Services\UnitCreateService;
use App\Services\UnitUpdateService;
use App\Services\UserService;

//SEMAS ---------------------------------------------------------
use App\Services\ShortcutWebService;
use App\Services\ShortcutWebCreateService;
use App\Services\ShortcutWebUpdateService;

//FIPAC ---------------------------------------------------------
use App\Services\OrganizationService;
use App\Services\OrganizationCreateService;
use App\Services\OrganizationUpdateService;

use App\Services\OmbudsmanService;
use App\Services\OmbudsmanCreateService;
use App\Services\OmbudsmanUpdateService;

use App\Services\TypeAccessService;
use App\Services\TypeAccessCreateService;
use App\Services\TypeAccessUpdateService;

use App\Services\TypeExpenseService;
use App\Services\TypeExpenseCreateService;
use App\Services\TypeExpenseUpdateService;

use App\Services\TypeRequestService;
use App\Services\TypeRequestCreateService;
use App\Services\TypeRequestUpdateService;

use App\Services\RevenueService;
use App\Services\RevenueCreateService;
use App\Services\RevenueUpdateService;

use App\Services\RevenueTypeService;
use App\Services\RevenueTypeCreateService;
use App\Services\RevenueTypeUpdateService;

use App\Services\ExpenseService;
use App\Services\ExpenseCreateService;
use App\Services\ExpenseUpdateService;

use App\Services\CategoryService;
use App\Services\CategoryCreateService;
use App\Services\CategoryUpdateService;

use App\Services\FileService;
use App\Services\FileCreateService;
use App\Services\FileUpdateService;

use App\Services\TagService;
use App\Services\TagCreateService;
use App\Services\TagUpdateService;

use App\Services\LegislationService;
use App\Services\LegislationCreateService;
use App\Services\LegislationUpdateService;
use App\Services\LegislationBondService;
use App\Services\LegislationBondCreateService;
use App\Services\LegislationBondUpdateService;
use App\Services\LegislationCategoryService;
use App\Services\LegislationCategoryCreateService;
use App\Services\LegislationCategoryUpdateService;
use App\Services\LegislationSituationService;
use App\Services\LegislationSituationCreateService;
use App\Services\LegislationSituationUpdateService;
use App\Services\LegislationSubjectService;
use App\Services\LegislationSubjectCreateService;
use App\Services\LegislationSubjectUpdateService;

use App\Services\NewsService;
use App\Services\NewsCreateService;
use App\Services\NewsUpdateService;

use App\Services\PostService;
use App\Services\PostCreateService;
use App\Services\PostUpdateService;

use App\Services\BiddingService;
use App\Services\BiddingCreateService;
use App\Services\BiddingUpdateService;
use App\Services\BiddingModalityService;
use App\Services\BiddingModalityCreateService;
use App\Services\BiddingModalityUpdateService;
use App\Services\BiddingAreaService;
use App\Services\BiddingAreaCreateService;
use App\Services\BiddingAreaUpdateService;
use App\Services\BiddingItemService;
use App\Services\BiddingItemCreateService;
use App\Services\BiddingItemUpdateService;
use App\Services\BiddingWinnerService;
use App\Services\BiddingWinnerCreateService;
use App\Services\BiddingWinnerUpdateService;
use App\Services\BiddingAgreementService;
use App\Services\BiddingAgreementCreateService;
use App\Services\BiddingAgreementUpdateService;

use App\Services\AgreementFileService;
use App\Services\AgreementTypeService;
use App\Services\AgreementTypeCreateService;
use App\Services\AgreementTypeUpdateService;

use App\Services\DirectHireService;
use App\Services\DirectHireCreateService;
use App\Services\DirectHireUpdateService;

use App\Services\DirectHireWinnerService;
use App\Services\DirectHireWinnerCreateService;
use App\Services\DirectHireWinnerUpdateService;

use App\Services\DirectHireItemService;
use App\Services\DirectHireItemCreateService;
use App\Services\DirectHireItemUpdateService;

use App\Services\ProjectService;
use App\Services\ProjectCreateService;
use App\Services\ProjectUpdateService;

use App\Services\ProjectCategoryService;
use App\Services\ProjectCategoryCreateService;
use App\Services\ProjectCategoryUpdateService;

use App\Services\ProjectMediaService;
use App\Services\ProjectMediaCreateService;
use App\Services\ProjectMediaUpdateService;

use App\Services\FaqService;
use App\Services\FaqCreateService;
use App\Services\FaqUpdateService;

use App\Services\GalleryService;
use App\Services\GalleryCreateService;
use App\Services\GalleryUpdateService;

use App\Services\GalleryTypeService;
use App\Services\GalleryTypeCreateService;
use App\Services\GalleryTypeUpdateService;

use App\Services\LeadershipService;
use App\Services\LeadershipCreateService;
use App\Services\LeadershipUpdateService;

use App\Services\AboutService;
use App\Services\AboutCreateService;
use App\Services\AboutUpdateService;

use App\Services\BannerService;
use App\Services\BannerCreateService;
use App\Services\BannerUpdateService;

use App\Services\CopyrightService;
use App\Services\CopyrightCreateService;
use App\Services\CopyrightUpdateService;

use App\Services\WebFooterService;
use App\Services\WebFooterCreateService;
use App\Services\WebFooterUpdateService;

use App\Services\WebFooterLogoService;
use App\Services\WebFooterLogoCreateService;
use App\Services\WebFooterLogoUpdateService;

use App\Services\BlankPageService;
use App\Services\BlankPageCreateService;
use App\Services\BlankPageUpdateService;

use App\Services\ProjectResponsibleService;
use App\Services\ProjectResponsibleCreateService;
use App\Services\ProjectResponsibleUpdateService;

use App\Services\ProjectProgressService;
use App\Services\ProjectProgressCreateService;
use App\Services\ProjectProgressUpdateService;

use App\Services\SensitiveInformationService;
use App\Services\SensitiveInformationCreateService;
use App\Services\SensitiveInformationtUpdateService;

use App\Services\SensitiveInformationCategoryService;
use App\Services\SensitiveInformationCategoryCreateService;
use App\Services\SensitiveInformationCategoryUpdateService;

use App\Services\SensitiveInformationMediaService;
use App\Services\SensitiveInformationMediaCreateService;
use App\Services\SensitiveInformationMediaUpdateService;

use App\Services\SensitiveInformationResponsibleService;
use App\Services\SensitiveInformationResponsibleCreateService;
use App\Services\SensitiveInformationResponsibleUpdateService;

use App\Services\ActService;
use App\Services\ActCreateService;
use App\Services\ActUpdateService;

use App\Services\ActTopicService;
use App\Services\ActTopicCreateService;
use App\Services\ActTopicUpdateService;

use App\Services\OfficialDiaryService;
use App\Services\OfficialDiaryCreateService;
use App\Services\OfficialDiaryUpdateService;

use Illuminate\Support\ServiceProvider;

class EloquentRepositoryProvider extends ServiceProvider
{
    private array $services = [
        AddressService::class => AddressEloquentRepository::class,
        AddressCreateService::class => AddressCreateEloquentRepository::class,
        AddressUpdateService::class => AddressUpdateEloquentRepository::class,
        CityService::class => CityEloquentRepository::class,
        CountryService::class => CountryEloquentRepository::class,
        EmailService::class => EmailEloquentRepository::class,
        EmailCreateService::class => EmailCreateEloquentRepository::class,
        EmailUpdateService::class => EmailUpdateEloquentRepository::class,
        DocumentService::class => DocumentEloquentRepository::class,
        //DocumentCreateService::class => DocumentCreateEloquentRepository::class,
        //DocumentUpdateService::class => DocumentUpdateEloquentRepository::class,
        DocumentTypeService::class => DocumentTypeEloquentRepository::class,
        IndividualPersonService::class => IndividualPersonEloquentRepository::class,
        LegalPersonService::class => LegalPersonEloquentRepository::class,
        NotificationService::class => NotificationEloquentRepository::class,
        NotificationCreateService::class => NotificationCreateEloquentRepository::class,
        NotificationUpdateService::class => NotificationUpdateEloquentRepository::class,
        NotificationUserService::class => NotificationUserEloquentRepository::class,
        PersonService::class => PersonEloquentRepository::class,
        PersonCreateService::class => PersonCreateEloquentRepository::class,
        PersonUpdateService::class => PersonUpdateEloquentRepository::class,
        PhoneService::class => PhoneEloquentRepository::class,
        PhoneCreateService::class => PhoneCreateEloquentRepository::class,
        PhoneUpdateService::class => PhoneUpdateEloquentRepository::class,
        DepartamentService::class => DepartamentEloquentRepository::class,
        DepartamentCreateService::class => DepartamentCreateEloquentRepository::class,
        DepartamentUpdateService::class => DepartamentUpdateEloquentRepository::class,
        OccupationService::class => OccupationEloquentRepository::class,
        OccupationCreateService::class => OccupationCreateEloquentRepository::class,
        OccupationUpdateService::class => OccupationUpdateEloquentRepository::class,
        StateService::class => StateEloquentRepository::class,
        UnitService::class => UnitEloquentRepository::class,
        UnitCreateService::class => UnitCreateEloquentRepository::class,
        UnitUpdateService::class => UnitUpdateEloquentRepository::class,
        UserService::class => UserEloquentRepository::class,
        GenreService::class => GenreEloquentRepository::class,
        MatrialStatusService::class => MatrialStatusEloquentRepository::class,
        //FIPAC ---------------------------------------------------------
        OrganizationService::class => OrganizationEloquentRepository::class,
        OrganizationCreateService::class => OrganizationCreateEloquentRepository::class,
        OrganizationUpdateService::class => OrganizationUpdateEloquentRepository::class,

        OmbudsmanService::class => OmbudsmanEloquentRepository::class,
        OmbudsmanCreateService::class => OmbudsmanCreateEloquentRepository::class,
        OmbudsmanUpdateService::class => OmbudsmanUpdateEloquentRepository::class,

        TypeAccessService::class => TypeAccessEloquentRepository::class,
        TypeAccessCreateService::class => TypeAccessCreateEloquentRepository::class,
        TypeAccessUpdateService::class => TypeAccessUpdateEloquentRepository::class,

        TypeExpenseService::class => TypeExpenseEloquentRepository::class,
        TypeExpenseCreateService::class => TypeExpenseCreateEloquentRepository::class,
        TypeExpenseUpdateService::class => TypeExpenseUpdateEloquentRepository::class,

        TypeRequestService::class => TypeRequestEloquentRepository::class,
        TypeRequestCreateService::class => TypeRequestCreateEloquentRepository::class,
        TypeRequestUpdateService::class => TypeRequestUpdateEloquentRepository::class,

        RevenueService::class => RevenueEloquentRepository::class,
        RevenueCreateService::class => RevenueCreateEloquentRepository::class,
        RevenueUpdateService::class => RevenueUpdateEloquentRepository::class,

        RevenueTypeService::class => RevenueTypeEloquentRepository::class,
        RevenueTypeCreateService::class => RevenueTypeCreateEloquentRepository::class,
        RevenueTypeUpdateService::class => RevenueTypeUpdateEloquentRepository::class,

        ExpenseService::class => ExpenseEloquentRepository::class,
        ExpenseCreateService::class => ExpenseCreateEloquentRepository::class,
        ExpenseUpdateService::class => ExpenseUpdateEloquentRepository::class,

        CategoryService::class => CategoryEloquentRepository::class,
        CategoryCreateService::class => CategoryCreateEloquentRepository::class,
        CategoryUpdateService::class => CategoryUpdateEloquentRepository::class,

        FileService::class => FileEloquentRepository::class,
        FileCreateService::class => FileCreateEloquentRepository::class,
        FileUpdateService::class => FileUpdateEloquentRepository::class,

        TagService::class => TagEloquentRepository::class,
        TagCreateService::class => TagCreateEloquentRepository::class,
        TagUpdateService::class => TagUpdateEloquentRepository::class,

        NewsService::class => NewsEloquentRepository::class,
        NewsCreateService::class => NewsCreateEloquentRepository::class,
        NewsUpdateService::class => NewsUpdateEloquentRepository::class,

        BiddingService::class => BiddingEloquentRepository::class,
        BiddingCreateService::class => BiddingCreateEloquentRepository::class,
        BiddingUpdateService::class => BiddingUpdateEloquentRepository::class,

        BiddingModalityService::class => BiddingModalityEloquentRepository::class,
        BiddingModalityCreateService::class => BiddingModalityCreateEloquentRepository::class,
        BiddingModalityUpdateService::class => BiddingModalityUpdateEloquentRepository::class,

        BiddingAreaService::class => BiddingAreaEloquentRepository::class,
        BiddingAreaCreateService::class => BiddingAreaCreateEloquentRepository::class,
        BiddingAreaUpdateService::class => BiddingAreaUpdateEloquentRepository::class,

        BiddingItemService::class => BiddingItemEloquentRepository::class,
        BiddingItemCreateService::class => BiddingItemCreateEloquentRepository::class,
        BiddingItemUpdateService::class => BiddingItemUpdateEloquentRepository::class,

        BiddingWinnerService::class => BiddingWinnerEloquentRepository::class,
        BiddingWinnerCreateService::class => BiddingWinnerCreateEloquentRepository::class,
        BiddingWinnerUpdateService::class => BiddingWinnerUpdateEloquentRepository::class,

        BiddingAgreementService::class => BiddingAgreementEloquentRepository::class,
        BiddingAgreementCreateService::class => BiddingAgreementCreateEloquentRepository::class,
        BiddingAgreementUpdateService::class => BiddingAgreementUpdateEloquentRepository::class,

        AgreementFileService::class => AgreementFileEloquentRepository::class,

        AgreementTypeService::class => AgreementTypeEloquentRepository::class,
        AgreementTypeCreateService::class => AgreementTypeCreateEloquentRepository::class,
        AgreementTypeUpdateService::class => AgreementTypeUpdateEloquentRepository::class,

        LegislationService::class => LegislationEloquentRepository::class,
        LegislationCreateService::class => LegislationCreateEloquentRepository::class,
        LegislationUpdateService::class => LegislationUpdateEloquentRepository::class,

        PostService::class => PostEloquentRepository::class,
        PostCreateService::class => PostCreateEloquentRepository::class,
        PostUpdateService::class => PostUpdateEloquentRepository::class,

        LegislationBondService::class => LegislationBondEloquentRepository::class,
        LegislationBondCreateService::class => LegislationBondCreateEloquentRepository::class,
        LegislationBondUpdateService::class => LegislationBondUpdateEloquentRepository::class,

        LegislationCategoryService::class => LegislationCategoryEloquentRepository::class,
        LegislationCategoryCreateService::class => LegislationCategoryCreateEloquentRepository::class,
        LegislationCategoryUpdateService::class => LegislationCategoryUpdateEloquentRepository::class,

        LegislationSituationService::class => LegislationSituationEloquentRepository::class,
        LegislationSituationCreateService::class => LegislationSituationCreateEloquentRepository::class,
        LegislationSituationUpdateService::class => LegislationSituationUpdateEloquentRepository::class,

        LegislationSubjectService::class => LegislationSubjectEloquentRepository::class,
        LegislationSubjectCreateService::class => LegislationSubjectCreateEloquentRepository::class,
        LegislationSubjectUpdateService::class => LegislationSubjectUpdateEloquentRepository::class,

        DirectHireService::class => DirectHireEloquentRepository::class,
        DirectHireCreateService::class => DirectHireCreateEloquentRepository::class,
        DirectHireUpdateService::class => DirectHireUpdateEloquentRepository::class,

        DirectHireWinnerService::class => DirectHireWinnerEloquentRepository::class,
        //DirectHireWinnerCreateService::class => DirectHireWinnerCreateEloquentRepository::class,
        DirectHireWinnerUpdateService::class => DirectHireWinnerUpdateEloquentRepository::class,

        DirectHireItemService::class => DirectHireItemEloquentRepository::class,
        DirectHireItemCreateService::class => DirectHireItemCreateEloquentRepository::class,
        DirectHireItemUpdateService::class => DirectHireItemUpdateEloquentRepository::class,

        ProjectService::class => ProjectEloquentRepository::class,
        ProjectCreateService::class => ProjectCreateEloquentRepository::class,
        ProjectUpdateService::class => ProjectUpdateEloquentRepository::class,

        ProjectCategoryService::class => ProjectCategoryEloquentRepository::class,
        ProjectCategoryCreateService::class => ProjectCategoryCreateEloquentRepository::class,
        ProjectCategoryUpdateService::class => ProjectCategoryUpdateEloquentRepository::class,

        ProjectMediaService::class => ProjectMediaEloquentRepository::class,
        ProjectMediaCreateService::class => ProjectMediaCreateEloquentRepository::class,
        ProjectMediaUpdateService::class => ProjectMediaUpdateEloquentRepository::class,

        FaqService::class => FaqEloquentRepository::class,
        FaqCreateService::class => FaqCreateEloquentRepository::class,
        FaqUpdateService::class => FaqUpdateEloquentRepository::class,

        GalleryService::class => GalleryEloquentRepository::class,
        GalleryCreateService::class => GalleryCreateEloquentRepository::class,
        GalleryUpdateService::class => GalleryUpdateEloquentRepository::class,

        GalleryTypeService::class => GalleryTypeEloquentRepository::class,
        GalleryTypeCreateService::class => GalleryTypeCreateEloquentRepository::class,
        GalleryTypeUpdateService::class => GalleryTypeUpdateEloquentRepository::class,

        LeadershipService::class => LeadershipEloquentRepository::class,
        LeadershipCreateService::class => LeadershipCreateEloquentRepository::class,
        LeadershipUpdateService::class => LeadershipUpdateEloquentRepository::class,

        AboutService::class => AboutEloquentRepository::class,
        AboutCreateService::class => AboutCreateEloquentRepository::class,
        AboutUpdateService::class => AboutUpdateEloquentRepository::class,

        BannerService::class => BannerEloquentRepository::class,
        BannerCreateService::class => BannerCreateEloquentRepository::class,
        BannerUpdateService::class => BannerUpdateEloquentRepository::class,

        ShortcutWebService::class => ShortcutWebEloquentRepository::class,
        ShortcutWebCreateService::class => ShortcutWebCreateEloquentRepository::class,
        ShortcutWebUpdateService::class => ShortcutWebUpdateEloquentRepository::class,

        CopyrightService::class => CopyrightEloquentRepository::class,
        CopyrightCreateService::class => CopyrightCreateEloquentRepository::class,
        CopyrightUpdateService::class => CopyrightUpdateEloquentRepository::class,

        WebFooterService::class => WebFooterEloquentRepository::class,
        WebFooterCreateService::class => WebFooterCreateEloquentRepository::class,
        WebFooterUpdateService::class => WebFooterUpdateEloquentRepository::class,

        WebFooterLogoService::class => WebFooterLogoEloquentRepository::class,
        WebFooterLogoCreateService::class => WebFooterLogoCreateEloquentRepository::class,
        WebFooterLogoUpdateService::class => WebFooterLogoUpdateEloquentRepository::class,

        BlankPageService::class => BlankPageEloquentRepository::class,
        BlankPageCreateService::class => BlankPageCreateEloquentRepository::class,
        BlankPageUpdateService::class => BlankPageUpdateEloquentRepository::class,

        ProjectResponsibleService::class => ProjectResponsibleEloquentRepository::class,
        ProjectResponsibleCreateService::class => ProjectResponsibleCreateEloquentRepository::class,
        ProjectResponsibleUpdateService::class => ProjectResponsibleUpdateEloquentRepository::class,

        ProjectProgressService::class => ProjectProgressEloquentRepository::class,
        ProjectProgressCreateService::class => ProjectProgressCreateEloquentRepository::class,
        ProjectProgressUpdateService::class => ProjectProgressUpdateEloquentRepository::class,

        SensitiveInformationService::class => SensitiveInformationEloquentRepository::class,
        SensitiveInformationCreateService::class => SensitiveInformationCreateEloquentRepository::class,
        //SensitiveInformationUpdateService::class => SensitiveInformationUpdateEloquentRepository::class,

        SensitiveInformationCategoryService::class => SensitiveInformationCategoryEloquentRepository::class,
        SensitiveInformationCategoryCreateService::class => SensitiveInformationCategoryCreateEloquentRepository::class,
        SensitiveInformationCategoryUpdateService::class => SensitiveInformationCategoryUpdateEloquentRepository::class,

        SensitiveInformationMediaService::class => SensitiveInformationMediaEloquentRepository::class,
        SensitiveInformationMediaCreateService::class => SensitiveInformationMediaCreateEloquentRepository::class,
        //SensitiveInformationMediaUpdateService::class => SensitiveInformationMediaUpdateEloquentRepository::class,

        SensitiveInformationResponsibleService::class => SensitiveInformationResponsibleEloquentRepository::class,
        SensitiveInformationResponsibleCreateService::class => SensitiveInformationResponsibleCreateEloquentRepository::class,
        SensitiveInformationResponsibleUpdateService::class => SensitiveInformationResponsibleUpdateEloquentRepository::class,

        ActService::class => ActEloquentRepository::class,
        ActCreateService::class => ActCreateEloquentRepository::class,
        ActUpdateService::class => ActUpdateEloquentRepository::class,

        ActTopicService::class => ActTopicEloquentRepository::class,
        ActTopicCreateService::class => ActTopicCreateEloquentRepository::class,
        ActTopicUpdateService::class => ActTopicUpdateEloquentRepository::class,

        OfficialDiaryService::class => OfficialDiaryEloquentRepository::class,
        OfficialDiaryCreateService::class => OfficialDiaryCreateEloquentRepository::class,
        OfficialDiaryUpdateService::class => OfficialDiaryUpdateEloquentRepository::class,

    ];

    public function register(): void
    {
    }

    public function boot(): void
    {
        foreach ($this->services as $key => $value) {
            $this->app->when($key)->needs(RepositoryInterface::class)->give($value);
        }
    }
}
