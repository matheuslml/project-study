<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HiringReportsController;
use App\Http\Controllers\LegislationController;
use App\Http\Controllers\OmbudsmanController;
use App\Http\Controllers\RevenueController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    
    
    //reports ----------------------------- REPORTS -----------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------
    
    // ombudsman
    Route::get('report_ombudsman_index', [OmbudsmanController::class, 'report_ombudsman_index'])->name('report_ombudsman_index');
    Route::post('report_ombudsman_pdf', [OmbudsmanController::class, 'report_ombudsman_pdf'])->name('report_ombudsman_pdf');
    
    // expense
    Route::get('report_expense_index', [ExpenseController::class, 'report_expense_index'])->name('report_expense_index');
    Route::post('report_expenses_pdf', [ExpenseController::class, 'report_expenses_pdf'])->name('report_expenses_pdf');
    
    // revenue
    Route::get('report_revenue_index', [RevenueController::class, 'report_revenue_index'])->name('report_revenue_index');
    Route::post('report_revenues_pdf', [RevenueController::class, 'report_revenues_pdf'])->name('report_revenues_pdf');
    
    // legislation
    Route::get('report_legislation_index', [LegislationController::class, 'report_legislation_index'])->name('report_legislation_index');
    Route::post('report_legislations_pdf', [LegislationController::class, 'report_legislations_pdf'])->name('report_legislations_pdf');
    
    // HiringReports
    Route::get('hiring_reports_index', [HiringReportsController::class, 'hiring_reports_index'])->name('hiring_reports_index');
    Route::post('report_direct_hires_pdf', [HiringReportsController::class, 'report_direct_hires_pdf'])->name('report_direct_hires_pdf');
    Route::post('report_agreements_pdf', [HiringReportsController::class, 'report_agreements_pdf'])->name('report_agreements_pdf');
    Route::post('report_biddings_pdf', [HiringReportsController::class, 'report_biddings_pdf'])->name('report_biddings_pdf');

});
