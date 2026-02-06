<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrganizationUpdateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected UserService $userService,
        protected PersonService $personService,
        protected OrganizationService $organizationService,
    ) {
        //
    }
    
    public function update(array $request, $organization_id)
    {
        try {
            DB::beginTransaction();
            
            $this->organizationService->update($request, $organization_id);

            DB::commit();
        } catch (Exception $exception) {
            ////Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
