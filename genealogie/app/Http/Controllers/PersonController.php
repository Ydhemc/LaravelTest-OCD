<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::all();
        return view('people.index', compact('people'));
    }

    public function show($id)
    {
        $person = Person::with(['children', 'parents'])->findOrFail($id);
        return view('people.show', compact('person'));
    }

    public function create()
    {
        return view('people.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_names' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);

        $first_name = ucfirst(strtolower($request->first_name)); 
        $middle_names = $request->middle_names ? ucfirst(strtolower($request->middle_names)) : null; 
        $last_name = strtoupper($request->last_name); 
        $birth_name = $request->birth_name ? strtoupper($request->birth_name) : strtoupper($request->last_name);

        $person = new Person();
        $person->first_name = $first_name;
        $person->middle_names = $middle_names;
        $person->last_name = $last_name;
        $person->birth_name = $birth_name;
        $person->date_of_birth = $request->date_of_birth;
        $person->created_by = auth()->id();
        $person->save();

        return redirect()->route('people.index')->with('success', 'Personne créée avec succès.');
    }


    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

}