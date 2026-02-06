<?php

namespace App\Services;

use App\Models\AddressPerson;
use App\Models\DepartamentPerson;
use App\Models\OccupationUser;
use App\Models\PersonAddress;
use App\Models\User;
//use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;

class PersonCreateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected UserService $userService,
        protected IndividualPersonService $individualPersonService,
        protected LegalPersonService $legalPersonService,
        protected PersonService $personService,
        protected EmailService $emailService,
        protected PhoneService $phoneService,
        protected AddressService $addressService,
    ) {
        //
    }
    // @codingStandardsIgnoreEnd

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            $userData = array_merge(
                $request,
                [
                    'full_name'      => $request['person_name'] ?? $request['company_name']
                ]
            );

            $person = match ($request['personable_type']) {
                'pj' => $this->legalPersonService->create($userData),
                'pf' => $this->individualPersonService->create($userData),
            default => throw new Exception('Tipo de pessoal não selecionado')
            };

                $person->personable()->create($userData);
                foreach ($request['documents']['document_type'] as $key => $documents) {
                    if ($request['documents']['document'][$key]) {
                        $person->personable->documents()->create(
                            [
                            'document_type_id' => $request['documents']['document_type'][$key],
                            'document' => $request['documents']['document'][$key],
                            ]
                        );
                    }
                }

                $person_id = $person->personable->id;

                if(isset($request['profile_photo_path'])){
                    $user = User::create([
                        'name' => $request['name'],
                        'email' => $request['email'],
                        'person_id' => $person_id,
                        'password' => Hash::make($request['password']),
                        'profile_photo_path' => $request['profile_photo_path']
                    ]);
                    event(new Registered($user));
                }
                elseif(isset($request['password'])){
                    $user = User::create([
                        'name' => $request['name'],
                        'email' => $request['email'],
                        'person_id' => $person_id,
                        'password' => Hash::make($request['password'])
                    ]);
                    event(new Registered($user));
                }


                $email = $this->emailService->create(
                    array_merge(
                        $request,
                        $userData,
                        compact('person_id')
                    )
                );

                if(isset($request['phone'])){
                    $phone = $this->phoneService->create(
                        array_merge(
                            $request,
                            $userData,
                            compact('person_id')
                        )
                    );
                }

                $address = $this->addressService->create(
                    [
                    'street' => $request['street'],
                    'complement' => $request['complement'],
                    'number' => $request['number'],
                    'postal_code' => $request['postal_code'],
                    'neighborhood' => $request['neighborhood'],
                    'city_id' => $request['city_id'],
                    ]
                );

                AddressPerson::create(
                    [
                    'person_id' => $person_id,
                    'address_id' => $address->id,
                    ]
                );

                if(isset($request['departament_id'])){
                    DepartamentPerson::create(
                        [
                        'departament_id' => $request['departament_id'],
                        'person_id' => $person_id,
                        ]
                    );
                }

                if(isset($request['occupation_id'])){
                    OccupationUser::create(
                        [
                        'user_id' => $user->id,
                        'occupation_id' => $request['occupation_id'],
                        ]
                    );
                }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception);
            throw new Exception($exception);
        }
    }
}
