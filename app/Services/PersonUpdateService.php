<?php

namespace App\Services;

use App\Models\OccupationUser;
use App\Models\Person;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PersonUpdateService
{
    // TODO: verificar imagem , editar user
    public function __construct(
        protected UserService $userService,
        protected IndividualPersonService $individualPersonService,
        protected LegalPersonService $legalPersonService,
        protected DocumentService $documentService,
        protected PersonService $personService,
        protected EmailService $emailService,
        protected PhoneService $phoneService,
        protected AddressService $addressService,
    ) {
        //
    }
    
    public function update(array $request, $person_id)
    {
        try {
            DB::beginTransaction();
            if($request['personable_type'] == 'pj'){
                $userData = array_merge(
                    $request,
                    [
                        'full_name'      => $request['person_name'] ?? $request['company_name'],
                        'personable_type'      => 'App\Models\LegalPerson'
                    ]
                );
            }
            if($request['personable_type'] == 'pf'){
                $userData = array_merge(
                    $request,
                    [
                        'full_name'      => $request['person_name'] ?? $request['company_name'],
                        'personable_type'      => 'App\Models\IndividualPerson'
                    ]
                );
            }

            $person = Person::find($person_id);

            $this->personService->update($userData, $person_id);
            match ($userData['personable_type']) {
                'App\Models\LegalPerson' => $this->legalPersonService->update($userData, $person->personable_id),
                'App\Models\IndividualPerson' => $this->individualPersonService->update($userData, $person->personable_id),
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
