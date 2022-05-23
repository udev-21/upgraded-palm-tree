<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;


class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) {
//        return response()->json([]);
        $validated = $this->validateRequest($request);

//        if($validator->fails()){
//            return response()->json($validator->errors());
//        }

        $contact = Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return response()->json($contact, 201);
    }

    public function validateRequest(Request $request): array{
        return $request->validate([
            'name'=>'required|string|min:2|max:255',
            'phone'=>'required|string|min:10|max:17',
            'message'=>'required|string|min:20|max:4096'
        ]);
    }
}
