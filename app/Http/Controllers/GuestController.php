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
            if($authGuest->updated)
                return view('guest.summary')->with('guest', $authGuest);
            else
                return view('guest.form')->with('guest', $authGuest);
        } else {
            return view('guest.login');
        }
    }

    public function edit(Request $request) {
        $guestCode = $request->cookie('code');
        if($guestCode) {
            $authGuest = Guest::where('code', $guestCode)->first();
            return view('guest.form')->with('guest', $authGuest);
        } else {
            return redirect()->route('guest.landing');
        }
    }

    //Guest Login
    public function search(Request $request) {
        $inputData = $request->input();

        $validation = $this->validation($inputData);
        if(array_key_exists('error', $validation)) {
            return response()->json($validation);
        }
        
        $authGuest = Guest::where('name', $validation['success']['name'])
                            ->where('surname', $validation['success']['surname'])
                            ->where('password', Str::upper($validation['success']['password']))
                            ->first();
        
        if($authGuest) {
            return response()->json(['success' => ['login' => 'Invitato Trovato. Attendi il reindirizzamento.']] )->cookie('code', $authGuest->code, 7200);
        } else {
            return response()->json(['error' => ['login' => 'Invitato non trovato. Prova di nuovo.']]);
        }
    }

    //Create new guest
    public function create(Request $request) {
        $guestData = $request->input();

        $validation = $this->validation($guestData);
        if(array_key_exists('error', $validation)) {
            return response()->json($validation);
        }
        
        if($newGuest = Guest::create([
            'name' => Str::title($validation['success']['name']),
            'surname' => Str::title($validation['success']['surname']),
            'church_confirm' => $validation['success']['church_confirm'],
            'castle_confirm' => $validation['success']['castle_confirm'],
            'diet' => Str::lower($validation['success']['diet']) ?: 'nessuna',
            'allergies' => Str::lower($validation['success']['allergies']) ?: 'nessuna',
            'updated' => $validation['success']['updated'],
            'password' => Str::upper(Str::random(8)),
        ])) {
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
        $guest->name = Str::title($validation['success']['name']);
        $guest->surname = Str::title($validation['success']['surname']);
        $guest->diet = Str::lower($validation['success']['diet']) ?: 'nessuna';
        $guest->allergies = Str::lower($validation['success']['allergies']) ?: 'nessuna';
        $guest->church_confirm = $validation['success']['church_confirm'];
        $guest->castle_confirm = $validation['success']['castle_confirm'];
        
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
            'church_confirm' => 'sometimes|boolean',
            'castle_confirm' => 'sometimes|boolean',
            'diet' => 'sometimes|string|nullable',
            'allergies' => 'sometimes|string|nullable',
            //Only for frontend update
            'child_menu' => 'sometimes|boolean',
            'extra_confirm' => 'sometimes|boolean',
            'extra_guests' => 'sometimes|numeric|max:10',
            //Only for backoffice creation
            'updated' => 'sometimes|boolean',
            //Only for login
            'password' => 'sometimes|required|string|size:8',
        ]);

        if($validator->fails())
            return ['error' => $validator->errors()];
        
        return ['success' => $validator->validated()];
    }
    
    public function validationToJson(Request $request) {
        $guestData = $request->input();

        $validation = $this->validation($guestData);
        return response()->json($validation);
    }

    public function multiGuestValidation(Request $request) {
        $mainGuest = json_decode($request->input('guest'));
        $dbGuest = Guest::where('code', $request->cookie('code'))->first();
        
        $flag = true;
        $mainProperties = [
            'name' => $mainGuest->name,
            'surname' => $mainGuest->surname,
            'church_confirm' => $mainGuest->church_confirm,
            'castle_confirm' => $mainGuest->castle_confirm,
            'diet' => $mainGuest->diet,
            'allergies' => $mainGuest->allergies,
            'extra_confirm' => $mainGuest->extra_confirm,
            'extra_guests' => $mainGuest->extra_guests,
        ];
        $mainValidation = $this->validation($mainProperties);
        if(array_key_exists('error', $mainValidation)) {
            $flag = false;
        }
        
        $extraGuests = $mainGuest->extraGuests;
        foreach($extraGuests as $extraGuest) {
            $extraProperties = [
                'name' => $extraGuest->name,
                'surname' => $extraGuest->surname,
                'diet' => $extraGuest->diet,
                'allergies' => $extraGuest->allergies,
                'child_menu' => $extraGuest->child_menu,
            ];

            $extraValidation = $this->validation($extraProperties);
            if(array_key_exists('error', $extraValidation)) {
                $flag = false;
            }
        }
        
        if($flag) {
            return $this->multiGuestUpdate($dbGuest, $mainProperties, $extraGuests); 
        } else {
            return response()->json(['error' => 'Qualcosa è andato storto!']);
        }
    }

    public function multiGuestUpdate($guest, $mainProperties, $extraGuests) {
        $guest->name = Str::title($mainProperties['name']);
        $guest->surname = Str::title($mainProperties['surname']);
        $guest->diet = Str::lower($mainProperties['diet']) ?: 'nessuna';
        $guest->allergies = Str::lower($mainProperties['allergies']) ?: 'nessuna';
        $guest->church_confirm = $mainProperties['church_confirm'];
        $guest->castle_confirm = $mainProperties['castle_confirm'];
        $guest->updated = true;

        foreach($extraGuests as $extraGuest) {
            $newGuest = Guest::create([
                'name' => Str::title($extraGuest->name),
                'surname' => Str::title($extraGuest->surname),
                'diet' => Str::lower($extraGuest->diet) ?: 'nessuna',
                'allergies' => Str::lower($extraGuest->allergies) ?: 'nessuna',
                'child_menu' => $extraGuest->child_menu,
                'password' => Str::upper(Str::random(8)),
            ]);

            if($newGuest) {
                $guest->guests()->save($newGuest);
            }
        }

        if($guest->save()) {
            return response()->json(['success' => 'Invitato Aggiornato']);
        } else {
            return response()->json(['error' => 'Invitato NON Aggiornato']);
        }
    }
}
