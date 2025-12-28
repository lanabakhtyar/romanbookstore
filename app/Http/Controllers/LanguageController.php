<?php
namespace App\Http\Controllers;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LanguageController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('auth:sanctum'); // API auth
    //     $this->middleware('permission:languages:view-any')->only(['index', 'show']);
    //     $this->middleware('permission:languages:create')->only('store');
    //     $this->middleware('permission:languages:update')->only('update');
    //     $this->middleware('permission:languages:delete')->only('destroy');
    // }

    public function index()
    {
        $languages = Language::orderBy('name')->get();
        return response()->json(['languages' => $languages], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:languages,name'
        ]);

        $language = Language::create($request->only('name'));
        
        return response()->json([
            'message' => 'Language created successfully.',
            'language' => $language
        ], 201);
    }

    public function show($id)
    {
        $language = Language::findOrFail($id);
        return response()->json(['language' => $language], 200);
    }

    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        
        $request->validate([
            'name' => 'sometimes|required|string|max:100|unique:languages,name,' . $id
        ]);

        $language->update($request->only('name'));
        
        return response()->json([
            'message' => 'Language updated successfully.',
            'language' => $language->fresh()
        ], 200);
    }
    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        
        $language->delete();
        
        return response()->json([
            'message' => 'Language deleted successfully.'
        ], 200);
    }

}