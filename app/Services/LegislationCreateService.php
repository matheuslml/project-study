<?php

namespace App\Services;

use App\Models\File;
use App\Models\FileLegislation;
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

class LegislationCreateService
{
    public function __construct(
        protected LegislationService $legislationService,
    ) {
        //
    }

    public function create(array $request)
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

            $legislation = $this->legislationService->create($legislationData);
            
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
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
