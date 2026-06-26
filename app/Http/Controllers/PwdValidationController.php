<?php

namespace App\Http\Controllers;

use App\Models\PwdRegistryReference;
use Illuminate\Http\Request;

class PwdValidationController extends Controller
{
    public function showForm()
    {
        return view('pwd.validate');
    }

    public function validate(Request $request)
    {
        $request->validate([
            'pwd_id_number' => 'required|string|max:50',
        ]);

        $registry = PwdRegistryReference::where('id_number', $request->pwd_id_number)->first();

        if (!$registry) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'PWD ID not found in the registry. Please contact the PDAD office.',
            ], 404);
        }

        return response()->json([
            'status' => 'valid',
            'message' => 'PWD ID verified successfully.',
            'prefill' => [
                'first_name' => $registry->first_name,
                'last_name' => $registry->last_name,
                'birthdate' => $registry->date_of_birth,
                'age' => $registry->age,
                'sex' => $registry->sex,
                'civil_status' => $registry->civil_status,
                'address' => $registry->address,
                'disability_type' => $registry->disability_type,
                'educational_attainment' => $registry->educational_attainment,
            ],
        ]);
    }
}
