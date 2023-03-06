<?php

namespace App\Http\Controllers;

// Functions and Helpers
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

// Models
use App\Models\Guest;

class GuestController extends Controller
{

    //Retrieve all guests data
    public function data(Request $request) {
        $guests = Guest::with('host')->get();

        return response()->json($guests);
    }

    //Check for guest's cookie and redirect
    public function landing(Request $request) {
        $guestCode = $request->cookie('code');
        if($guestCode) {
            $authGuest = Guest::where('code', $guestCode)->first();
            return view('guest.dashboard')->with('guest', $authGuest);
        } else {
            return view('guest.login');
        }
    }

    //Guest Login
    public function search(Request $request) {
        $inputData = $request->input();

        $validation = $this->validation($inputData);
        if(array_key_exists('error', $validation)) {
            return response()->json($validation);
        }
        
        $authGuest = Guest::where('name', $validation['name'])
                            ->where('surname', $validation['surname'])
                            ->first();
        
        if($authGuest) {
            return response()->json(['success' => ['login' => 'Invitato Trovato. Attendi il reindirizzamento.']] )->cookie('code', $authGuest->code, 5000);
        } else {
            return response()->json(['error' => ['login' => 'Invitato non trovato. Prova di nuovo.']]);
        }
    }

    public function inviteLanding(Request $request, $guestCode) {
        
        if(!$request->cookie('code')) {
            $authGuest = Guest::where('code', $guestCode)->first();
            return view('guest.init')->with('guest', $authGuest);
        }

        if($request->cookie('code') != $guestCode)
            return view('guest.redirect');

        return redirect()->route('guest.dashboard');
    }

    //Set guest's cookie and redirect
    public function confirm(Request $request, $guestCode) {
        return redirect()->route('guest.dashboard')->cookie('code', $guestCode, 5000);
    }

    //Select proper guest and redirect
    public function profile(Request $request) {
        $guestCode = $request->cookie('code');
        $guest = Guest::where('code', $guestCode)->first();

        return view('guest.profile')->with('guest', $guest);
    }

    public function guests(Request $request) {
        $guestCode = $request->cookie('code');
        $guest = Guest::where('code', $guestCode)->first();

        return view('guest.guests')->with('guest', $guest);
    }

    //Create new guest
    public function create(Request $request) {
        $guestData = $request->input();

        $validation = $this->validation($guestData);
        if(array_key_exists('error', $validation)) {
            return response()->json($validation);
        }
        
        if($newGuest = Guest::create([
            'name' => Str::title($validation['name']),
            'surname' => Str::title($validation['surname']),
            'diet' => Str::lower($validation['diet']) ?: 'nessuna',
            'allergies' => Str::lower($validation['allergies']) ?: 'nessuna',
            'confirmed' => $validation['confirmed'],
        ])) {
            if($request->cookie('code')) {
                $host = Guest::where('code', $request->cookie('code'))->first();
                $host->guests()->save($newGuest);
            }
            return response()->json(['success' => ['creation' => 'Invitato Registrato']]);
        } else {
            return response()->json(['error' => ['creation' => 'Invitato non Registrato']]);
        }
    }

    //Update guest data
    public function update(Request $request) {
        $guestData = $request->input();

        $validation = $this->validation($guestData);
        if(array_key_exists('error', $validation)) {
            return response()->json($validation);
        }

        $guest = Guest::where('code', $request->cookie('code'))->first();
        $guest->name = Str::title($validation['name']);
        $guest->surname = Str::title($validation['surname']);
        $guest->diet = Str::lower($validation['diet']) ?: 'nessuna';
        $guest->allergies = Str::lower($validation['allergies']) ?: 'nessuna';
        $guest->confirmed = $validation['confirmed'];
        
        if($guest->save())
            return response()->json(['success' => ['update' => 'Invitato Aggiornato']]);
        else
            return response()->json(['error' => ['update' => 'Invitato non Aggiornato']]);
    }

    public function delete(Request $request, $guestId) {
        $guest = Guest::find($guestId);

        if($guest->delete())
            return response()->json(['success' => ['delete' => 'Invitato Eliminato']]);
        else
            return response()->json(['error' => ['delete' => 'Invitato non Eliminato']]);
    }

    //Validate incoming data
    public function validation($guestData) {
        $validator = Validator::make($guestData, [
            'name' => 'sometimes|required|string',
            'surname' => 'sometimes|required|string',
            'diet' => 'sometimes|string|nullable',
            'allergies' => 'sometimes|string|nullable',
            'church_confirmed' => 'sometimes|boolean',
            'castle_confirmed' => 'sometimes|boolean',
        ]);

        if($validator->fails())
            return ['error' => $validator->errors()];
        
        return $validator->validated();
    }

    public function partialUpdate(Request $request) {
        $inputData = $request->input();
        
        $validation = $this->validation($inputData);
        if(array_key_exists('error', $validation)) {
            return response()->json(['form' => $request['form'], 'error' => $validation['error']]);
        }
        
        $guest = Guest::where('code', $request->cookie('code'))->first();
        foreach($validation as $key => $value) {
            switch($key) {
                case 'name':
                    $guest->name = Str::title($validation['name']);
                    break;
                case 'surname':
                    $guest->surname = Str::title($validation['surname']);
                    break;
                case 'diet':
                    $guest->diet = Str::lower($validation['diet']) ?: 'nessuna';
                    break;
                case 'allergies':
                    $guest->allergies = Str::lower($validation['allergies']) ?: 'nessuna';
                    break;
                case 'church_confirmed':
                    $guest->church_confirmed = $validation['church_confirmed'];
                    break;
                case 'castle_confirmed':
                    $guest->castle_confirmed = $validation['castle_confirmed'];
                default:
                    break;
            }
        }

        if($guest->save())
            return response()->json(['success' => true, 'form' => $request['form']]);
        else
            return response()->json(['error' => true, 'form' => $request['form']]);
    }

    
    public function inputValidation(Request $request) {
        $inputData = $request->input();

        $validator = Validator::make($inputData, [
            'name' => 'sometimes|required|string',
            'surname' => 'sometimes|required|string',

            'diet' => 'sometimes|string|nullable',
            'allergies' => 'sometimes|string|nullable',

            'confirmed' => 'sometimes|required|boolean'
        ]);
        
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        return response()->json(['success' => $validator->validated()]);
    }
}
