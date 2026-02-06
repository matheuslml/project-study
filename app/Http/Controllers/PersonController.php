<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\Person\PersonResource;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Services\PersonService;
use App\Services\PersonCreateService;
use App\Services\PersonUpdateService;
use App\Http\Requests\PersonRequest;
use App\Http\Requests\PersonUpdateRequest;
use App\Models\Address;
use App\Models\AddressPerson;
use App\Models\Audit;
use App\Models\City;
use App\Models\Country;
use App\Models\Departament;
use App\Models\DepartamentPerson;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Email;
use App\Models\Genre;
use App\Models\MatrialStatus;
use App\Models\Occupation;
use App\Models\OccupationUser;
use App\Models\Phone;
use App\Models\State;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

use App\Services\IndividualPersonService;
use App\Services\LegalPersonService;
use App\Services\PhoneService;
use App\Services\EmailService;
use App\Services\AddressService;

use Throwable;

class PersonController extends Controller
{
    public function __construct(
        protected PersonCreateService $personCreateService,
        protected PersonUpdateService $personUpdateService,
        protected PersonService $personService,
        protected IndividualPersonService $individualPersonService,
        protected LegalPersonService $legalPersonService,
        protected EmailService $emailService,
        protected PhoneService $phoneService,
        protected AddressService $addressService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Pessoas')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $users = User::with('person')->latest()->get(['id', 'email', 'person_id']);
        return view('/admin/user/index', ['pageConfigs' => $pageConfigs], compact('users', 'unit', 'copyright'));
    }

    public function show($user_id): View
    {
        try{
            $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $audits = Audit::where('user_id', $user_id)->orderBy('created_at', 'desc')->take(10)->get();
            $user = User::find($user_id);
            $genres = Genre::all();
            $matrial_statuses = MatrialStatus::all();
            $states = State::all();
            $cities = City::all();
            $countries = Country::all();
            $occupations = Occupation::all();
            return view('admin.user.show', compact('unit', 'copyright', 'occupations', 'audits', 'user', 'genres', 'matrial_statuses',  'countries', 'states', 'cities' ));
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar a pessoa!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Criar Pessoas')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $genres = Genre::all();
        $matrial_statuses = MatrialStatus::all();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $units = Unit::all();
        $departaments = Departament::all();
        $occupations = Occupation::all();

        return view('admin.user.create', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'occupations', 'units', 'departaments', 'genres', 'matrial_statuses', 'countries', 'states', 'cities'));

    }

    public function store(
        PersonRequest $request
    ){
        if (! Gate::allows('Criar Pessoas')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            if(isset($request['password'])){
                if($request['password'] == $request['confirm_password']){
                    $request->validate([
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:8'
                    ]);

                    if(isset($request['profile_photo'])){
                        $request->validate([
                            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                        ]);
                        //sending to storage path
                        $path = $request->file( key:'profile_photo')->store( path: 'public/images/profile');
                        $path = str_replace("public/", "storage/", $path);
                        $request->request->add(['profile_photo_path' => $path]);
                    }

                    $this->personCreateService->create($request->toArray());
                    flash('Registro criado com sucesso!')->success();
                }
                else{
                    flash('Senhas Diferentes!')->error();
                }
            }
            else{
                $this->personCreateService->create($request->toArray());
                flash('Registro criado com sucesso!')->success();

            }
            DB::commit();

            return redirect()->back()->withInput();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao adicionar novo usuário!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        PersonUpdateRequest $request, $person_id
    ){
        if (! Gate::allows('Editar Pessoas')) {
            return view('pages.not-authorized');
        };
        try {
            DB::beginTransaction();
            $this->personUpdateService->update($request->toArray(), $person_id);

            flash('Usuário editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar o usuário!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($person)
    {
        if (! Gate::allows('Deletar Pessoas')) {
            return view('pages.not-authorized');
        }

        try{
            $person = Person::find($person);
            $person->delete();
            flash('Usuário deletado com sucesso!')->success();
        } catch (\Exception $exception) {
            flash('Erro ao deletar o Usuário!')->error();
        }
        $person = $this->personService->paginate(10);
        return view('admin.user.index', compact('person'));
    }

    public function store_person()
    {

        $users_list = User::with('person')->get();
        foreach($users_list as $user){
            if(!isset($user->person)){
                $userData = array(
                    'full_name'      => $user->name,
                    'social_name'      => '',
                    'genre'      => 1,
                    'matrial_status'      => 1,
                    'phone'      => "899999999"

                    );


                $person = match ('pf') {
                    'pj' => $this->legalPersonService->create($userData),
                    'pf' => $this->individualPersonService->create($userData),
                default => throw new Exception('Tipo de pessoal não selecionado')
                };

                $new_person = $person->personable()->create($userData);

                $person_id = $new_person->id;
                var_dump($person_id);

                $user = User::find($user->id);
                $user->person_id = $person_id;
                $user->save();

                Document::create(
                    [
                    'document' => "00000000" . $user->id,
                    'person_id' => $person_id,
                    'document_type_id' => 7,
                    ]
                );
                Document::create(
                    [
                    'document' => "00000000" . $user->id,
                    'person_id' => $person_id,
                    'document_type_id' => 2,
                    ]
                );
                Document::create(
                    [
                    'document' => "00000000" . $user->id,
                    'person_id' => $person_id,
                    'document_type_id' => 8,
                    ]
                );

                Email::create(
                    [
                    'email' => $user->email,
                    'person_id' => $person_id,
                    ]
                );

                Phone::create(
                    [
                    'phone' => "999999999",
                    'person_id' => $person_id,
                    ]
                );


                $address = Address::create(
                    [
                    'street' => "rua",
                    'complement' => "complemento",
                    'number' => "00",
                    'postal_code' => "28930-000",
                    'neighborhood' => "bairro",
                    'city_id' => 3570,
                    'person_id' => $person_id,
                    ]
                );

                AddressPerson::create(
                    [
                    'person_id' => $person_id,
                    'address_id' => $address->id,
                    ]
                );

                DepartamentPerson::create(
                    [
                    'departament_id' => 1,
                    'person_id' => $person_id,
                    ]
                );


                OccupationUser::create(
                    [
                    'user_id' => $user->id,
                    'occupation_id' => 1,
                    ]
                );

            }


        }


        $pageConfigs = ['pageHeader' => false];

        $users = User::with('person')->latest()->get(['id', 'email', 'person_id']);
        return view('/admin/user/index', ['pageConfigs' => $pageConfigs], compact('users'));
    }
}
