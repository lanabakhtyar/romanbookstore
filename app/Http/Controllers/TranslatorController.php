<?php

namespace App\Http\Controllers;

use App\Models\Translator;
use Illuminate\Http\Request;

class TranslatorController extends Controller
{
    //here we will create the controllers for the translator model. 


    //first controller is Index which will return all of the translators 

    public function index()
    {
        $translators = Translator::orderBy('name')->get();
        return response()->json(['translators' => $translators->load('language')], 200);
    }
    //we will use this function to create a new translator
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:translators,name',
            'native_language_id' => 'required|integer|exists:languages,id'
        ]);

        $translator = Translator::create($validated);

        return response()->json([
            'message' => "new translator added.",
            "translator" => $translator->load('language')
        ], 201);

    }



    //this shows the one specific translator by id 
    public function show($id)
    {
        $translator = Translator::with('language')->findOrFail($id);
        return response()->json(['translator' => $translator->load('language')], 200);
    }
    public function update(Request $request, $id)
    {
        // 1. Find translator or fail with 404
        $translator = Translator::findOrFail($id);

        // 2. Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:translators,name,' . $translator->id,
            'native_language_id' => 'required|integer|exists:languages,id',
        ]);

        // 3. Update the translator
        $translator->update($validated);

        // 4. Return response
        return response()->json([
            'message' => 'Translator updated successfully.',
            'translator' => $translator->load('language')
        ], 200);
    }

    public function destroy($id)
    {
        $translator = Translator::findOrFail($id);

        $translator->delete();

        return response()->json([
            'message' => 'translator deleted successfully.',
            'translator' => $translator
        ], 200);
    }

}
