<?php

namespace App\Http\Controllers;

use App\Models\AgreementOrigin;
use App\Models\AgreementSituation;
use App\Models\AgreementType;
use App\Models\Bidding;
use App\Models\BiddingAgreement;
use App\Models\BiddingModality;
use App\Models\BiddingSituation;
use App\Models\DirectHire;
use App\Models\DirectHireModality;
use App\Models\DirectHireSituations;
use App\Models\DirectHireWinner;
use App\Models\Person;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class HiringReportsController extends Controller
{

    //------------------------reports
    public function hiring_reports_index(): View
    {
        /*if (! Gate::allows('Ver e Listar Contratações Diretas')) {
            return view('pages.not-authorized');
        }*/

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $direct_hires = DirectHire::all();
            $direct_hire_modalities = DirectHireModality::orderBy('title', 'asc')->get();
            $direct_hire_situations = DirectHireSituations::orderBy('title', 'asc')->get();
            $direct_hire_winners = Person::whereDoesntHave('departaments')
                                        ->orderBy('full_name', 'asc')
                                        ->get();


            $bidding_modalities = BiddingModality::with('biddings')->orderBy('title', 'asc')->get();
            $bidding_situations = BiddingSituation::with('biddings')->orderBy('title', 'asc')->get();
            $biddings = Bidding::with('modality')
            ->latest()
            ->get();


            $agreement_origins = AgreementOrigin::with('agreements')->orderBy('title', 'asc')->get();
            $agreement_types = AgreementType::with('agreements')->orderBy('title', 'asc')->get();
            $agreement_situations = AgreementSituation::with('agreements')->orderBy('title', 'asc')->get();
            $agreements = BiddingAgreement::with('bidding')
                                        ->latest()
                                        ->get();

            return view('admin.hiringReports.report_index', compact('unit', 'copyright', 'direct_hires', 'direct_hire_modalities', 'direct_hire_situations', 'direct_hire_winners',
                                                                    'bidding_modalities', 'bidding_situations', 'biddings',
                                                                    'agreement_origins', 'agreement_types', 'agreement_situations', 'agreements'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function report_direct_hires_pdf(Request $request)
    {
        try{
            /*if (! Gate::allows('Ver e Listar Legislações')) {
                return view('pages.not-authorized');
            }*/

            if(!empty($request['direct_hire_modality_id']) && !empty($request['direct_hire_situation_id']) && !empty($request['direct_hire_winner_id'])){

                if($request['direct_hire_type'] == 'day'){
                    $day = date('d', strtotime($request['direct_hire_day']));
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratações Diretas";
                    $report_schedule = date('d-m-Y', strtotime($request['direct_hire_day']));
                }
                if($request['direct_hire_type'] == 'month'){
                    $month =  $request['direct_hire_month'];
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratações Diretas";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['direct_hire_type'] == 'year'){
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratações Diretas";
                    $report_schedule = $request['year'];
                }
                if($request['direct_hire_type'] == 'between'){
                    $date_start = $request['direct_hire_date_start'];
                    $date_end = $request['direct_hire_date_end'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratações Diretas";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['direct_hire_modality_id']) && !empty($request['direct_hire_situation_id'])){
                //ok
                if($request['direct_hire_type'] == 'day'){
                    $day = date('d', strtotime($request['direct_hire_day']));
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratações Diretas";
                    $report_schedule = date('d-m-Y', strtotime($request['direct_hire_day']));
                }
                if($request['direct_hire_type'] == 'month'){
                    $month =  $request['direct_hire_month'];
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratações Diretas";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['direct_hire_type'] == 'year'){
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratações Diretas";
                    $report_schedule = $request['year'];
                }
                if($request['direct_hire_type'] == 'between'){
                    $date_start = $request['direct_hire_date_start'];
                    $date_end = $request['direct_hire_date_end'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratações Diretas";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['direct_hire_winner_id']) && !empty($request['direct_hire_situation_id'])){

                if($request['direct_hire_type'] == 'day'){
                    $day = date('d', strtotime($request['direct_hire_day']));
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratações Diretas";
                    $report_schedule = date('d-m-Y', strtotime($request['direct_hire_day']));
                }
                if($request['direct_hire_type'] == 'month'){
                    $month =  $request['direct_hire_month'];
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratações Diretas";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['direct_hire_type'] == 'year'){
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratações Diretas";
                    $report_schedule = $request['year'];
                }
                if($request['direct_hire_type'] == 'between'){
                    $date_start = $request['direct_hire_date_start'];
                    $date_end = $request['direct_hire_date_end'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratações Diretas";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }
            }
            elseif(!empty($request['direct_hire_winner_id']) && !empty($request['direct_hire_modality_id'])){

                if($request['direct_hire_type'] == 'day'){
                    $day = date('d', strtotime($request['direct_hire_day']));
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratações Diretas";
                    $report_schedule = date('d-m-Y', strtotime($request['direct_hire_day']));
                }
                if($request['direct_hire_type'] == 'month'){
                    $month =  $request['direct_hire_month'];
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratações Diretas";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['direct_hire_type'] == 'year'){
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratações Diretas";
                    $report_schedule = $request['year'];
                }
                if($request['direct_hire_type'] == 'between'){
                    $date_start = $request['direct_hire_date_start'];
                    $date_end = $request['direct_hire_date_end'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratações Diretas";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }
            }
            elseif(!empty($request['direct_hire_modality_id'])){

                if($request['direct_hire_type'] == 'day'){
                    $day = date('d', strtotime($request['direct_hire_day']));
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratações Diretas";
                    $report_schedule = date('d-m-Y', strtotime($request['direct_hire_day']));
                }
                if($request['direct_hire_type'] == 'month'){
                    $month =  $request['direct_hire_month'];
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratações Diretas";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['direct_hire_type'] == 'year'){
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratações Diretas";
                    $report_schedule = $request['year'];
                }
                if($request['direct_hire_type'] == 'between'){
                    $date_start = $request['direct_hire_date_start'];
                    $date_end = $request['direct_hire_date_end'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('modality_id', $request['direct_hire_modality_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratações Diretas";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['direct_hire_situation_id'])){

                if($request['direct_hire_type'] == 'day'){
                    $day = date('d', strtotime($request['direct_hire_day']));
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratações Diretas";
                    $report_schedule = date('d-m-Y', strtotime($request['direct_hire_day']));
                }
                if($request['direct_hire_type'] == 'month'){
                    $month =  $request['direct_hire_month'];
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratações Diretas";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['direct_hire_type'] == 'year'){
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratações Diretas";
                    $report_schedule = $request['year'];
                }
                if($request['direct_hire_type'] == 'between'){
                    $date_start = $request['direct_hire_date_start'];
                    $date_end = $request['direct_hire_date_end'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->where('situation_id', $request['direct_hire_situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratações Diretas";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['direct_hire_winner_id'])){

                if($request['direct_hire_type'] == 'day'){
                    $day = date('d', strtotime($request['direct_hire_day']));
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratações Diretas";
                    $report_schedule = date('d-m-Y', strtotime($request['direct_hire_day']));
                }
                if($request['direct_hire_type'] == 'month'){
                    $month =  $request['direct_hire_month'];
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratações Diretas";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['direct_hire_type'] == 'year'){
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                                                ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                                                ->whereYear('created_at', $year)
                                                ->orderBy('created_at')
                                                ->get();

                    $report_title = "Relatório Anual de Contratações Diretas";
                    $report_schedule = $request['year'];
                }
                if($request['direct_hire_type'] == 'between'){
                    $date_start = $request['direct_hire_date_start'];
                    $date_end = $request['direct_hire_date_end'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereRelation('winners', 'id', $request['direct_hire_winner_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratações Diretas";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }
            }
            elseif(empty($request['direct_hire_modality_id']) && empty($request['direct_hire_situation_id']) && empty($request['direct_hire_winner_id'])){
                //todos os verificadores vazios

                if($request['direct_hire_type'] == 'day'){
                    $day = date('d', strtotime($request['direct_hire_day']));
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratações Diretas";
                    $report_schedule = date('d-m-Y', strtotime($request['direct_hire_day']));
                }
                if($request['direct_hire_type'] == 'month'){
                    $month =  $request['direct_hire_month'];
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratações Diretas";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['direct_hire_type'] == 'year'){
                    $year = $request['direct_hire_year'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratações Diretas";
                    $report_schedule = $request['year'];
                }
                if($request['direct_hire_type'] == 'between'){
                    $date_start = $request['direct_hire_date_start'];
                    $date_end = $request['direct_hire_date_end'];
                    $direct_hires = DirectHire::with(['modality', 'situation', 'winners'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratações Diretas";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $pdf = FacadePdf::loadView('admin.hiringReports.direct_hire_pdf', compact('direct_hires', 'report_title', 'report_schedule', 'unit', 'copyright'));
            $pdf->setPAper('a4', 'portrait');

            return $pdf->stream('direct_hires.pdf');

        } catch (\Throwable $throwable) {
            flash('Não foram encontradas Contratações Diretas Cadastradas!')->error();

            return redirect()->back()->withInput();
        }
    }

    public function report_agreements_pdf(Request $request)
    {
        try{
            /*if (! Gate::allows('Ver e Listar Legislações')) {
                return view('pages.not-authorized');
            }*/

            if(!empty($request['agreement_bidding_id']) && !empty($request['agreement_origin_id']) && !empty($request['agreement_situation_id']) && !empty($request['agreement_type_id'])){

                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_bidding_id']) && !empty($request['agreement_origin_id']) && !empty($request['agreement_situation_id'])){

                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_bidding_id']) && !empty($request['agreement_origin_id']) && !empty($request['agreement_type_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_bidding_id']) && !empty($request['agreement_situation_id']) && !empty($request['agreement_type_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_origin_id']) && !empty($request['agreement_situation_id']) && !empty($request['agreement_type_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_bidding_id']) && !empty($request['agreement_origin_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_bidding_id']) && !empty($request['agreement_situation_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_bidding_id']) && !empty($request['agreement_type_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_origin_id']) && !empty($request['agreement_situation_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_origin_id']) && !empty($request['agreement_type_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_situation_id']) && !empty($request['agreement_type_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_bidding_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('bidding_id', $request['agreement_bidding_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_origin_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('origin_id', $request['agreement_origin_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_situation_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('situation_id', $request['agreement_situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['agreement_type_id'])){
                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->where('type_id', $request['agreement_type_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(empty($request['agreement_bidding_id']) && empty($request['agreement_origin_id']) && empty($request['agreement_situation_id']) && empty($request['agreement_type_id'])){

                if($request['agreement_type'] == 'day'){
                    $day = date('d', strtotime($request['agreement_day']));
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Contratos";
                    $report_schedule = date('d-m-Y', strtotime($request['agreement_day']));
                }
                if($request['agreement_type'] == 'month'){
                    $month =  $request['agreement_month'];
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Contratos";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['agreement_type'] == 'year'){
                    $year = $request['agreement_year'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Contratos";
                    $report_schedule = $request['year'];
                }
                if($request['agreement_type'] == 'between'){
                    $date_start = $request['agreement_date_start'];
                    $date_end = $request['agreement_date_end'];
                    $agreements = BiddingAgreement::with(['bidding', 'agreementSituation', 'agreementType', 'agreementOrigin'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Contratos";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $pdf = FacadePdf::loadView('admin.hiringReports.agreement_pdf', compact('agreements', 'report_title', 'report_schedule', 'unit', 'copyright'));
            $pdf->setPAper('a4', 'portrait');

            return $pdf->stream('agreements.pdf');

        } catch (\Throwable $throwable) {
            flash('Não foram encontrados Contratos Cadastrados!')->error();

            return redirect()->back()->withInput();
        }
    }

    public function report_biddings_pdf(Request $request)
    {
        try{
            /*if (! Gate::allows('Ver e Listar Legislações')) {
                return view('pages.not-authorized');
            }*/

            if(!empty($request['bidding_modality_id']) && !empty($request['bidding_situation_id'])){

                if($request['bidding_type'] == 'day'){
                    $day = date('d', strtotime($request['bidding_day']));
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('modality_id', $request['bidding_modality_id'])
                    ->where('situation_id', $request['bidding_situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Licitações";
                    $report_schedule = date('d-m-Y', strtotime($request['bidding_day']));
                }
                if($request['bidding_type'] == 'month'){
                    $month =  $request['bidding_month'];
                    $year = $request['bidding_year'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('modality_id', $request['bidding_modality_id'])
                    ->where('situation_id', $request['bidding_situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Licitações";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['bidding_type'] == 'year'){
                    $year = $request['bidding_year'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('modality_id', $request['bidding_modality_id'])
                    ->where('situation_id', $request['bidding_situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Licitações";
                    $report_schedule = $request['year'];
                }
                if($request['bidding_type'] == 'between'){
                    $date_start = $request['bidding_date_start'];
                    $date_end = $request['bidding_date_end'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('modality_id', $request['bidding_modality_id'])
                    ->where('situation_id', $request['bidding_situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Licitações";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['bidding_modality_id'])){

                if($request['bidding_type'] == 'day'){
                    $day = date('d', strtotime($request['bidding_day']));
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('modality_id', $request['bidding_modality_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Licitações";
                    $report_schedule = date('d-m-Y', strtotime($request['bidding_day']));
                }
                if($request['bidding_type'] == 'month'){
                    $month =  $request['bidding_month'];
                    $year = $request['bidding_year'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('modality_id', $request['bidding_modality_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Licitações";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['bidding_type'] == 'year'){
                    $year = $request['bidding_year'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('modality_id', $request['bidding_modality_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Licitações";
                    $report_schedule = $request['year'];
                }
                if($request['bidding_type'] == 'between'){
                    $date_start = $request['bidding_date_start'];
                    $date_end = $request['bidding_date_end'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('modality_id', $request['bidding_modality_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Licitações";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(!empty($request['bidding_situation_id'])){

                if($request['bidding_type'] == 'day'){
                    $day = date('d', strtotime($request['bidding_day']));
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('situation_id', $request['bidding_situation_id'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Licitações";
                    $report_schedule = date('d-m-Y', strtotime($request['bidding_day']));
                }
                if($request['bidding_type'] == 'month'){
                    $month =  $request['bidding_month'];
                    $year = $request['bidding_year'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('situation_id', $request['bidding_situation_id'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Licitações";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['bidding_type'] == 'year'){
                    $year = $request['bidding_year'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('situation_id', $request['bidding_situation_id'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Licitações";
                    $report_schedule = $request['year'];
                }
                if($request['bidding_type'] == 'between'){
                    $date_start = $request['bidding_date_start'];
                    $date_end = $request['bidding_date_end'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->where('situation_id', $request['bidding_situation_id'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Licitações";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }
            elseif(empty($request['bidding_modality_id']) && empty($request['bidding_situation_id'])){

                if($request['bidding_type'] == 'day'){
                    $day = date('d', strtotime($request['bidding_day']));
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->whereDay('created_at', $day)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Diário de Licitações";
                    $report_schedule = date('d-m-Y', strtotime($request['bidding_day']));
                }
                if($request['bidding_type'] == 'month'){
                    $month =  $request['bidding_month'];
                    $year = $request['bidding_year'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Mensal de Licitações";
                    $report_schedule = $month . ' - ' . $year;
                }
                if($request['bidding_type'] == 'year'){
                    $year = $request['bidding_year'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório Anual de Licitações";
                    $report_schedule = $request['year'];
                }
                if($request['bidding_type'] == 'between'){
                    $date_start = $request['bidding_date_start'];
                    $date_end = $request['bidding_date_end'];
                    $biddings = Bidding::with(['modality', 'situation'])
                    ->whereDate('created_at', '>=' , $date_start)
                    ->whereDate('created_at', '<=' , $date_end)
                    ->orderBy('created_at')
                    ->get();
                    $report_title = "Relatório de Licitações";
                    $report_schedule = $date_start . ' até ' . $date_end;
                }

            }

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $pdf = FacadePdf::loadView('admin.hiringReports.bidding_pdf', compact('biddings', 'report_title', 'report_schedule', 'unit', 'copyright'));
            $pdf->setPAper('a4', 'portrait');

            return $pdf->stream('biddings.pdf');

        } catch (\Throwable $throwable) {
            flash('Não foram encontradas Licitações Cadastradas!')->error();

            return redirect()->back()->withInput();
        }
    }
}
