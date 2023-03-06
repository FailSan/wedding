<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Table;

class TableController extends Controller
{
    public function data(Request $request) {
        $tables = Table::all();

        return response()->json($tables);
    }

    public function create(Request $request) {
        $tableData = $request->input();

        $validation = $this->validation($tableData);
        if(array_key_exists('error', $validation)) {
            return response()->json($validation);
        }

        if($newTable = Table::create([
            'description' => Str::lower($validation['description']),
        ])) {
            return response()->json(['success' => ['creation' => 'Tavolo Creato']]);
        } else {
            return response()->json(['error' => ['creation' => 'Tavolo non Creato']]);
        }
    }

    public function delete(Request $request, $tableId) {
        $table = Table::find($tableId);

        if($table->delete())
            return response()->json(['success' => ['delete' => 'Tavolo Eliminato']]);
        else
            return response()->json(['error' => ['delete' => 'Tavolo non Eliminato']]);

    }

    public function validation($tableData) {
        $validator = Validator::make($tableData, [
            'description' => 'required|string',
        ]);

        if($validator->fails())
            return ['error' => $validator->errors()];
        
        return $validator->validated();
    }
    
}
