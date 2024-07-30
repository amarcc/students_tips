<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Tip;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TipController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * 
     * Display a listing of the resource.
     */
    public function __construct(){
        $this -> authorizeResource(Tip::class);
    }

    public function index(Request $request, Program $program)
    {
        $tips = $program -> tips();

        $search = $request -> input('search');
        $mostLikes = $request -> filled('mostLikes');

        $tips -> when(
            $search,
            fn($query, $search) => $query -> search($search)
        );

        $tips = $tips -> withLikesCount();

        $tips -> when(
            $mostLikes,
            fn($query) => $query -> mostLikes()
        );

        $tips = $tips -> withRepliesCount() -> latest() -> paginate(10);

        return view('tips.index', ['tips' => $tips, 'program' => $program]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Program $program)
    {
        return view('tips.create', ['program' => $program]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Program $program)
    {
        $validatedData = $request -> validate([
            'title' => 'required|string|min:3',
            'desc' => 'required|string|min:3',
        ]);

        Tip::create([
            ...$validatedData,
            'user_id' => auth() -> user() -> id,
            'program_id' => $program -> id
        ]);

        return redirect() -> route('programs.tips.index', $program) -> with('success', 'Tip successfully posted');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program, Tip $tip)
    {
        $tip = Tip::withCount('likes') -> find($tip->id);

        $replies = $tip -> replies() -> withLikesCount() -> oldest() -> get();
        
        return view('tips.show', ['tip' => $tip, 'replies' => $replies]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program, Tip $tip)
    {
        return view('tips.edit', [
            'program' => $program,
            'tip' => $tip
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program, Tip $tip)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:3',
            'desc' => 'required|string|min:3',
        ]);
        
        $tip -> update([
            ...$validatedData,
            'edited' => true
        ]);

        return redirect() -> route('programs.tips.index', $program) -> with('success', 'Tip successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program, Tip $tip)
    {
        $tip -> delete();

        return redirect() -> route('programs.tips.index', $program) -> with('success', 'Tip deleted successfully');
    }
}
 