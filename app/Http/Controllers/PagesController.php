<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    // Account Settings account
    public function account_settings_account()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Account Settings"], ['name' => "Account"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/account/page-account-settings-account', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // Account Settings security
    public function account_settings_security()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Account Settings"], ['name' => "Security"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/account/page-account-settings-security', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // Account Settings billing
    public function account_settings_billing()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Account Settings"], ['name' => "Billing & Plans"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/account/page-account-settings-billing', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // Account Settings notifications
    public function account_settings_notifications()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Account Settings"], ['name' => "Notifications"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/account/page-account-settings-notifications', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // Account Settings connections
    public function account_settings_connections()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Account Settings"], ['name' => "Connections"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/account/page-account-settings-connections', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // Profile
    public function profile()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Profile"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/pages/page-profile', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // FAQ
    public function faq()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "FAQ"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/pages/page-faq', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // Knowledge Base
    public function knowledge_base()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Knowledge Base"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/pages/page-knowledge-base', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // Knowledge Base Category
    public function kb_category()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "/page/knowledge-base", 'name' => "Knowledge Base"], ['name' => "Category"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/pages/page-kb-category', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // Knowledge Base Question
    public function kb_question()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "/page/knowledge-base", 'name' => "Knowledge Base"], ['link' => "/page/knowledge-base/category", 'name' => "Category"], ['name' => "Question"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/pages/page-kb-question', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // pricing
    public function pricing()
    {
        $pageConfigs = ['pageHeader' => false];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/pages/page-pricing', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // api key
    public function api_key()
    {
        $pageConfigs = ['pageHeader' => false];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/pages/page-api-key', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // blog list
    public function blog_list()
    {
        $pageConfigs = ['contentLayout' => 'content-detached-right-sidebar', 'bodyClass' => 'content-detached-right-sidebar'];

        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "javascript:void(0)", 'name' => "Blog"], ['name' => "List"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/pages/page-blog-list', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // blog detail
    public function blog_detail()
    {
        $pageConfigs = ['contentLayout' => 'content-detached-right-sidebar', 'bodyClass' => 'content-detached-right-sidebar'];

        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "javascript:void(0)", 'name' => "Blog"], ['name' => "Detail"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/pages/page-blog-detail', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // blog edit
    public function blog_edit()
    {

        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "javascript:void(0)", 'name' => "Blog"], ['name' => "Edit"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/pages/page-blog-edit', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // modal examples
    public function modal_examples()
    {

        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['name' => "Modal Examples"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/pages/modal-examples', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // license
    public function license()
    {

        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "License"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/pages/page-license', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }
}
