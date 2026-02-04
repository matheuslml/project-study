<?php

namespace App\Services;

use App\Actions\OfficialDiary\ParsePDFAction;
use App\Models\Act;
use App\Models\CertificateOfficialDiary;
use App\Models\File;
use App\Models\FileOfficialDiary;
use App\Models\OfficialDiary;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OfficialDiaryUpdateService
{
    public function __construct(
        protected OfficialDiaryService $OfficialDiaryService,
    ) {
        //
    }

    public function update(array $request, $official_diary_id)
    {

        try {
            DB::beginTransaction();

            $official_diary = OfficialDiary::find($official_diary_id);
            OfficialDiary::updateOrCreate(
                ['id' => $official_diary_id],
                [
                    'edition' => $request['edition'],
                    'extra_edition' => isset($request['extra_edition']) && ($request['extra_edition'] == 'on') ? true : false,
                    'published_at' => $request['published_at'],
                    'description' => $request['description'],
                    'type' => $request['type'],
                    'status' => $request['status']
                ]
            );

            if(isset($request['certificate'])){
                CertificateOfficialDiary::updateOrCreate(
                    [
                        'certificate_id' => $request['certificate'],
                        'official_diary_id' => $official_diary_id
                    ],
                    [
                        'certificate_id' => $request['certificate'],
                        'official_diary_id' => $official_diary->id
                    ]
                );
            }

            if(isset($request['file'])){
                //remover arquivo antigo
                if($official_diary->files()->first() != null){
                    $file = File::find($official_diary->files()->first()->id);
                    $old_path = storage_path() . '/app/public/files/documents/' . str_replace("documents/", "", $file->url);
                    $file->delete();
                    unlink($old_path);
                }

                $file = File::create([
                    'file_type_id' => 1,
                    'title' => 'Diário Oficial ' . $request['edition'],
                    'url' => $request['pathfile']
                ]);

                FileOfficialDiary::create([
                    'file_id' => $file->id,
                    'official_diary_id' => $official_diary_id
                ]);
                ParsePDFAction::dispatch($official_diary);
            }

            if($request['type'] == 'FILE'){
                File::updateOrCreate(
                    ['id' => $official_diary->files()->first()->id],
                    [
                        'title' => 'Diário Oficial ' . $request['edition']
                    ]
                );
            }

            if($request['type'] == 'ACTS'){
                $old_acts = Act::where('official_diary_id', $official_diary_id)->get();
                //removar acts
                foreach ($old_acts as $old_act) {
                    $old_act->official_diary_id = null;
                    $old_act->status = 'PENDING';
                    $old_act->save();
                }
                //adicionar acts
                if(isset($request['acts'])){
                    foreach ($request['acts'] as $obj) {
                        $act = Act::find($obj);
                        $act->official_diary_id = $official_diary_id;
                        $act->status = 'PUBLISHED';
                        $act->save();
                    }
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
