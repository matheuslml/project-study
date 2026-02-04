<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    // Form Elements - Input
    public function input()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Input"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-input', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Elements - Input-groups
    public function input_groups()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Input Groups"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-input-groups', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Elements - Input-mask
    public function input_mask()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Input Mask"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-input-mask', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Elements - Textarea
    public function textarea()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Textarea"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-textarea', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Elements - Checkbox
    public function checkbox()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Checkbox"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-checkbox', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Elements - Radio
    public function radio()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Radio"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-radio', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Elements - custom_options
    public function custom_options()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Custom Options"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-custom-options', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Elements - Switch
    public function switch()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Switch"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-switch', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Elements - Select
    public function select()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Select"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-select', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Elements - Number Input
    public function number_input()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Number Input"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-number-input', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // File Uploader
    public function file_uploader()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "File Uploader"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-file-uploader', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Quill Editor
    public function quill_editor()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Quill Editor"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-quill-editor', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Elements - Date & time Picker
    public function date_time_picker()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Date & Time Picker"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-elements/form-date-time-picker', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Layouts
    public function layouts()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Forms"], ['name' => "Form Layouts"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-layout', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Wizard
    public function wizard()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Forms"], ['name' => "Form Wizard"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-wizard', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Form Validation
    public function validation()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Forms"], ['name' => "Form Validation"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-validation', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }
    // Form repeater
    public function form_repeater()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Forms"], ['name' => "Form Repeater"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/forms/form-repeater', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }
}
