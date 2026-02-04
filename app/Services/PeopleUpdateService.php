<?php

namespace App\Services;

use App\Models\OccupationUser;
use App\Models\People;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PeopleUpdateService
{
    // TODO: verificar imagem , editar user
    public function __construct(
        protected UserService $userService,
        protected IndividualPeopleService $individualPeopleService,
        protected LegalPeopleService $legalPeopleService,
        protected DocumentService $documentService,
        protected PeopleService $peopleService,
        protected EmailService $emailService,
        protected PhoneService $phoneService,
        protected AddressService $addressService,
    ) {
        //
    }
    
    public function update(array $request, $people_id)
    {
        try {
            DB::beginTransaction();
            if($request['peopleable_type'] == 'pj'){
                $userData = array_merge(
                    $request,
                    [
                        'full_name'      => $request['person_name'] ?? $request['company_name'],
                        'peopleable_type'      => 'App\Models\LegalPeople'
                    ]
                );
            }
            if($request['peopleable_type'] == 'pf'){
                $userData = array_merge(
                    $request,
                    [
                        'full_name'      => $request['person_name'] ?? $request['company_name'],
                        'peopleable_type'      => 'App\Models\IndividualPeople'
                    ]
                );
            }

            $person = People::find($people_id);

            $this->peopleService->update($userData, $people_id);
            match ($userData['peopleable_type']) {
                'App\Models\LegalPeople' => $this->legalPeopleService->update($userData, $person->peopleable_id),
                'App\Models\IndividualPeople' => $this->individualPeopleService->update($userData, $person->peopleable_id),
            default => throw new Exception('Tipo de pessoal não selecionado')
            };

            if(isset($request['documents'])){
                foreach ($request['documents']['document_type'] as $key => $documents) {
                    $documentId = $request['documents']['id'][$key];
                    if ($request['documents']['document'][$key]) {
                        $this->documentService->update(
                            [
                            'document_type_id' => $request['documents']['document_type'][$key],
                            'document' => $request['documents']['document'][$key],
                            ], $documentId
                        );
                    }
                }
            }

            if(isset($request['phones'])){
                foreach ($request['phones']['phone'] as $key => $phones) {
                    $phoneId = $request['phones']['id'][$key];
                    if ($request['phones']['phone'][$key]) {
                        $this->phoneService->update(
                            [
                            'phone' => $request['phones']['phone'][$key],
                            ], $phoneId
                        );
                    }
                }
            }

            if(isset($request['emails'])){
                foreach ($request['emails']['email'] as $key => $emails) {
                    $emailId = $request['emails']['id'][$key];
                    if ($request['emails']['email'][$key]) {
                        $this->emailService->update(
                            [
                            'email' => $request['emails']['email'][$key],
                            ], $emailId
                        );
                    }
                }
            }

            if(isset($request['occupation_id'])){
                if(OccupationUser::where('user_id', $person->user->id)){
                    OccupationUser::where('user_id', $person->user->id)->update(['occupation_id' => $request['occupation_id']]);
                }
                else{
                    OccupationUser::create(
                        [
                        'user_id' => $person->user->id,
                        'occupation_id' => $request['occupation_id'],
                        ]
                    );
                }
            }

            //tratando address como se fosse único, pq vai aparecer sempre como único
            if(isset($request['address_id'])){
                $this->addressService->update($userData, $userData['address_id']);
            }

            DB::commit();
        } catch (Exception $exception) {
            ////Bugsnag::notifyException($exception);
            DB::rollBack();
            dd($exception);
            throw new Exception($exception);
        }
    }
}
