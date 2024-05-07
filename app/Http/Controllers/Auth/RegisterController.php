<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
  /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

         // Almacenar un mensaje en la sesión flash
    Session::flash('registration_success', '¡Registro exitoso! Por favor inicia sesión.');

    // Redirigir al usuario al formulario de inicio de sesión
    return redirect($this->redirectTo);

        // Redirigir al usuario al login después del registro exitoso
        return redirect('/login');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
                // Define la regla de validación personalizada antes de crear el objeto Validator
                $this->extendPasswordValidator();

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed','strong_password'],
            'role' => ['required', 'string', 'in:user,admin'], // Validación del campo de rol
        ], $this->messages());
    }

    protected function messages()
    {
        return [
            'password.strong_password' => 'La contraseña debe contener al menos un carácter especial.',
        ];
    }

// Definición de la regla de validación personalizada dentro del método validator
protected function extendPasswordValidator()
{
    Validator::extend('strong_password', function ($attribute, $value, $parameters, $validator) {
        return preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[0-9])/', $value);
    });
}

    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' =>$data['role'],
        ]);
  
    }
}

