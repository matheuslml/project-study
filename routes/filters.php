<?php

use Illuminate\Support\Facades\Route;

//transparency
//Bidding
Route::post('/web/bidding_filtered', 'App\Http\Controllers\BiddingController@web_index_filter')->name('bidding_web_index_filter');
//Expense
Route::post('/web/expense_filtered', 'App\Http\Controllers\ExpenseController@web_index_filter')->name('expense_web_index_filter');
//BiddingAgreement
Route::post('/web/agreement_filtered', 'App\Http\Controllers\BiddingAgreementController@web_index_filter')->name('agreement_web_index_filter');
//Person
//Legislation
Route::post('/web/legislation_filtered', 'App\Http\Controllers\LegislationController@web_index_filter')->name('legislation_web_index_filter');
//Files
//Revenues
Route::post('/web/revenue_filtered', 'App\Http\Controllers\RevenueController@web_index_filter')->name('revenue_web_index_filter');
//News
Route::post('/web/news_filtered', 'App\Http\Controllers\WebController@news_web_index_filter_title')->name('news_web_index_filter_title');
Route::get('/web/news_filtered_category/{category_id}', 'App\Http\Controllers\WebController@news_web_index_filter_category')->name('news_web_index_filter_category');
Route::get('/web/news_filtered_tag/{tag_id}', 'App\Http\Controllers\WebController@news_web_index_filter_tag')->name('news_web_index_filter_tag');

