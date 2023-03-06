<?php

namespace App\Http\Controllers;

// Functions and Helpers
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

// Models
use App\Models\User;
use App\Models\Guest;
use App\Models\Table;

class UserController extends Controller
{
    //User login
    public function login(Request $request) {
        $userData = $request->input();

        $validation = $this->validation($userData, false);
        if(array_key_exists('error', $validation)) {
            return response()->json($validation);
        }

        if(Auth::attempt(['email' => $validation['email'], 'password' => $validation['password']], $validation['remember'])) {
            return response()->json(['success' => ['login' => 'Utente Autenticato']]);
        } else {
            return response()->json(['error' => ['login' => 'Utente non Autenticato']]);
        }
    }

    //User logout
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect()->route('home');
    }

    //User dashboard redirect
    public function guestsView(Request $request) {
        $guests = Guest::all();

        return view('user.guests')->with('guests', $guests);
    }

    public function tablesView(Request $request) {
        $tables = Table::all();
        $guests = Guest::all();

        return view('user.tables')->with('tables', $tables)->with('guests', $guests);
    }

    //User creation
    public function create(Request $request) {
        $userData = $request->input();

        $validation = $this->validation($userData, true);
        if(array_key_exists('error', $validation)) {
            return response()->json($validation);
        }

        if(User::create([
            'name' => Str::title($validation['name']),
            'surname' => Str::title($validation['surname']),
            'email' => Str::lower($validation['email']),
            'password' => Hash::make($validation['password']),
        ])) {
            return response()->json(['success' => ['signup' => 'Utente Creato']]);
        } else {
            return response()->json(['error' => ['signup' => 'Utente non creato']]);
        }
        
    }

    //Validate incoming data
    public function validation($userData, $type) {

        $validator;
        //$type == true -> create Form
        //$type == false -> login Form
        if($type) {
            $validator = Validator::make($userData, [
                'name' => 'required|string',
                'surname' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|alpha_dash|confirmed',
            ]);
        } else {
            $validator = Validator::make($userData, [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string',
                'remember' => 'required|boolean',
            ]);
        }

        if($validator->fails()) {
            return ['error' => $validator->errors()];
        }

        return $validator->validated();
    }

}
