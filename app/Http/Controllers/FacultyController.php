<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FacultyController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this -> authorizeResource(Faculty::class);
    }

    public function index(Request $request)
    {
        $search = $request -> input('search');

        $faculties = Faculty::when(
            $search,
            fn($query, $search) => $query -> search($search)
        );

        $faculties = $faculties -> latest() -> withProgramsCount() -> paginate(10);
        
        return view('faculties.index', ['faculties' => $faculties]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'name' => 'required|string|min:3',
            'location' => 'required|string|min:2'
        ]);

        Faculty::create([
            ...$validatedData,
        ]);

        return redirect() -> route('faculties.index') -> with('success', 'Faculty successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view('faculties.edit', ['faculty' => $faculty]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    { 
        $validatedData = $request -> validate([
            'name' => 'required|string|min:3',
            'location' => 'required|string|min:2'
        ]);

        $faculty -> update([
            ...$validatedData,
        ]);

        return redirect() -> route('faculties.index') -> with('success', 'Faculty successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        $faculty -> delete();

        return redirect() -> route('faculties.index') -> with('success', 'Faculty deleted successfully');
    }
}
