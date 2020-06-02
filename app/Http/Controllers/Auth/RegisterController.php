<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use LMS\Modules\Core\Services\Verification\MasterVerifier;
use LMS\Modules\Core\Services\Verification\Verifiers\GoogleRecaptchaVerifier;
use LMS\Modules\Users\Usescases\Contracts\AssignRoleUserUsecaseInterface;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $verifiers = [
        GoogleRecaptchaVerifier::class
    ];

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * @var AssignRoleUserUsecaseInterface
     */
    private $assignRoleUserUsecase;

    /**
     * Create a new controller instance.
     * @param AssignRoleUserUsecaseInterface $assignRoleUserUsecase
     */
    public function __construct(AssignRoleUserUsecaseInterface $assignRoleUserUsecase)
    {
        $this->middleware('guest');
        $this->assignRoleUserUsecase = $assignRoleUserUsecase;
    }

    public function register(Request $request)
    {
       app(MasterVerifier::class)->verify($request->all(), $this->verifiers);

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Entities\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        $this->assignRoleUserUsecase->handle($user->id, 'User');
    }


}
