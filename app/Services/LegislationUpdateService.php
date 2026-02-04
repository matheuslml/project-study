<?php

namespace App\Services;

use App\Models\Legislation;
use App\Models\LegislationAuthor;
use App\Models\LegislationLegislationAuthor;
use App\Models\LegislationLegislationSubjects;
use App\Models\LegislationSection;
use App\Models\LegislationUnit;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LegislationUpdateService
{
    public function __construct(
        protected LegislationService $legislationService,
    ) {
        //
    }
    
    public function update(array $request, $legislation_id)
    {
        try {
            DB::beginTransaction();

            $detail = $request['content'];
            $dom = new \domdocument();
            $searchPage = mb_convert_encoding($detail, 'HTML-ENTITIES', "UTF-8");
            $dom->loadHtml($searchPage);
            $detail = $dom->savehtml();

            $legislationData = array_merge(
                $request,
                [
                    'excerpt'  => $detail,
                    'body'      => $detail,
                    'meta_description'      => $detail
                ]
            );
            
            $legislation = $this->legislationService->update($legislationData, $legislation_id);
            
            $old_authors = LegislationLegislationAuthor::where('legislation_id', $legislation_id)->get();
            $old_subjects = LegislationLegislationSubjects::where('legislation_id', $legislation_id)->get();
            $old_sections = LegislationUnit::where('legislation_id', $legislation_id)->get();

            foreach($old_authors as $authordelete){
                $authordelete->forceDelete();
            }

            foreach($old_subjects as $subjectdelete){
                $subjectdelete->forceDelete();
            }

            foreach($old_sections as $sectiondelete){
                $sectiondelete->forceDelete();
            }

            foreach ($request['authors'] as  $author) {
                $author_id = $author;
                
                LegislationLegislationAuthor::create([
                    'legislation_id' => $legislation->id,
                    'legislation_author_id' => $author_id,
                ]);
            }

            foreach ($request['subjects'] as  $subject) {
                $subject_id = $subject;
                
                LegislationLegislationSubjects::create([
                    'legislation_id' => $legislation->id,
                    'legislation_subject_id' => $subject_id,
                ]);
            }

            foreach ($request['units'] as  $unit) {
                $unit_id = $unit;
                
                LegislationUnit::create([
                    'legislation_id' => $legislation->id,
                    'unit_id' => $unit_id,
                ]);
            }
            DB::commit();
            return $legislation;
        } catch (Exception $exception) {
            dd($exception);
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
