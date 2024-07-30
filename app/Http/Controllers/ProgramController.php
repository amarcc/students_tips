<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Program;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */

    public function __construct(){
        $this -> authorizeResource(Program::class);
    }
    
    public function index(Request $request, Faculty $faculty)
    {
        $programs = $faculty -> programs();

        $search = $request -> input('search');

        $programs -> when(
            $search,
            fn($query, $search) => $query -> search($search)
        );

        $programs = $programs -> withTipsCount() -> latest() -> paginate(10);

        return view('programs.index', ['programs' => $programs, 'faculty' => $faculty]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Faculty $faculty)
    {
        return view('programs.create', ['faculty' => $faculty]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Faculty $faculty)
    {
        $validatedData = $request -> validate([
            'name' => 'required|string|min:3'
        ]);

        Program::create([
            ...$validatedData,
            'faculty_id' => $faculty -> id
        ]);

        return redirect() -> route('faculties.programs.index', $faculty) -> with('success', 'Faculty successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('programs.show');
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty, Program $program)
    {
        return view('programs.edit', ['faculty' => $faculty, 'program' => $program]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty, Program $program)
    {
        $validatedData = $request -> validate([
            'name' => 'required|string|min:3',
        ]);

        $program -> update([
            ...$validatedData,
        ]);

        return redirect() -> route('faculties.programs.index', $faculty) -> with('success', 'Program successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty, Program $program)
    {
        $program -> delete();

        return redirect() -> route('faculties.programs.index', $faculty) -> with('success', 'Program deleted successfully');
    }
}
