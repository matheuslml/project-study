<?php

namespace App\Services;

use App\Models\Leadership;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LeadershipUpdateService
{
    public function __construct(
        protected LeadershipService $leadershipService,
    ) {
        //
    }
    
    public function update(array $request, $leadership_id)
    {
        try {
            DB::beginTransaction();
            
            $old_leadership = Leadership::find($leadership_id);

            $this->leadershipService->update($request, $leadership_id);
            
            if(isset($request['photo'])){
                Storage::disk('leadership')->delete($old_leadership->photo);
            }

            DB::commit();
        } catch (Exception $exception) {
            dd($exception);
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
