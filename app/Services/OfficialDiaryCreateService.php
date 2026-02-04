<?php

namespace App\Services;

use App\Actions\OfficialDiary\ParsePDFAction;
use App\Jobs\GenerateDiaryContentJob;
use App\Models\Act;
use App\Models\CertificateOfficialDiary;
use App\Models\File;
use App\Models\FileOfficialDiary;
use App\Models\OfficialDiary;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OfficialDiaryCreateService
{
    public function __construct(
        protected OfficialDiaryService $officialDiaryService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            $official_diary = OfficialDiary::create([
                'edition' => $request['edition'],
                'extra_edition' => isset($request['extra_edition']) && ($request['extra_edition'] == 'on') ? true : false,
                'published_at' => $request['published_at'],
                'description' => $request['description'],
                'type' => $request['type'],
                'status' => $request['status']
            ]);

            if(isset($request['certificate'])){
                CertificateOfficialDiary::create([
                    'certificate_id' => $request['certificate'],
                    'official_diary_id' => $official_diary->id,
                ]);
            }

            if(isset($request['file'])){
                $file = File::create([
                    'file_type_id' => 1,
                    'title' => 'Diário Oficial ' . $request['edition'],
                    'url' => $request['pathfile']
                ]);

                FileOfficialDiary::create([
                    'file_id' => $file->id,
                    'official_diary_id' => $official_diary->id
                ]);
                ParsePDFAction::dispatch($official_diary);
            }

            if(isset($request['acts'])){
                foreach ($request['acts'] as $obj) {
                    $act = Act::find($obj);
                    $act->official_diary_id = $official_diary->id;
                    $act->status = 'PUBLISHED';
                    $act->save();
                }
            }

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
