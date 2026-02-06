<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\User;
use Illuminate\Http\Request;

class AppsController extends Controller
{
    // invoice list App
    public function invoice_list()
    {
        $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/apps/invoice/app-invoice-list', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // invoice preview App
    public function invoice_preview()
    {
        $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/apps/invoice/app-invoice-preview', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // invoice edit App
    public function invoice_edit()
    {
        $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/apps/invoice/app-invoice-edit', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // invoice edit App
    public function invoice_add()
    {
        $pageConfigs = ['pageHeader' => false];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/apps/invoice/app-invoice-add', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // invoice print App
    public function invoice_print()
    {
        $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/apps/invoice/app-invoice-print', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // User List Page
    public function user_list()
    {
        //$person = Person::with('user')->get(['id', 'full_name', 'social_name', 'created_at']);
        $users = User::with('person')->get(['id', 'email', 'person_id']);
        $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/user/user-list', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'), compact('users'));
    }

    // User Account Page
    public function user_view_account()
    {
        $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/user/app-user-view-account', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // User Security Page
    public function user_view_security()
    {
        $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/user/app-user-view-security', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // User Billing and Plans Page
    public function user_view_billing()
    {
        $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/user/app-user-view-billing', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // User Notification Page
    public function user_view_notifications()
    {
        $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/user/app-user-view-notifications', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // User Connections Page
    public function user_view_connections()
    {
        $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/admin/user/app-user-view-connections', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }


    // Chat App
    public function chatApp()
    {
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'chat-application',
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/apps/chat/app-chat', [
            'pageConfigs' => $pageConfigs
        ]);
    }

    // Calender App
    public function calendarApp()
    {
        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/admin/calendar/index', [
            'pageConfigs' => $pageConfigs
        ]);
    }

    // Email App
    public function emailApp()
    {
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'email-application',
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/apps/email/app-email', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }
    // ToDo App
    public function todoApp()
    {
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'todo-application',
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/apps/todo/app-todo', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    // File manager App
    public function file_manager()
    {
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'file-manager-application',
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/apps/fileManager/app-file-manager', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // Access Roles App
    public function access_roles()
    {
        $pageConfigs = ['pageHeader' => false,];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/admin/rolesPermission/app-access-roles', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // Access permission App
    public function access_permission()
    {
        $pageConfigs = ['pageHeader' => false,];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/admin/rolesPermission/app-access-permission', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // Kanban App
    public function kanbanApp()
    {
        $pageConfigs = [
            'pageHeader' => false,
            'pageClass' => 'kanban-application',
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/apps/kanban/app-kanban', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright'));
    }

    // Ecommerce Shop
    public function ecommerce_shop()
    {
        $pageConfigs = [
            'contentLayout' => "content-detached-left-sidebar",
            'pageClass' => 'ecommerce-application',
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "eCommerce"], ['name' => "Shop"]
        ];

        return view('/content/apps/ecommerce/app-ecommerce-shop', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Ecommerce Details
    public function ecommerce_details()
    {
        $pageConfigs = [
            'pageClass' => 'ecommerce-application',
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "eCommerce"], ['link' => "/app/ecommerce/shop", 'name' => "Shop"], ['name' => "Details"]
        ];

        return view('/content/apps/ecommerce/app-ecommerce-details', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Ecommerce Wish List
    public function ecommerce_wishlist()
    {
        $pageConfigs = [
            'pageClass' => 'ecommerce-application',
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "eCommerce"], ['name' => "Wish List"]
        ];

        return view('/content/apps/ecommerce/app-ecommerce-wishlist', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Ecommerce Checkout
    public function ecommerce_checkout()
    {
        $pageConfigs = [
            'pageClass' => 'ecommerce-application',
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "eCommerce"], ['name' => "Checkout"]
        ];

        return view('/content/apps/ecommerce/app-ecommerce-checkout', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
