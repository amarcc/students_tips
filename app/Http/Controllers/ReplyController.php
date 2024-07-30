<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Reply;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReplyController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */

    public function __construct(){
        $this -> authorizeResource(Reply::class);

        $this -> middleware('throttle:replies')->only(['store']);

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Tip $tip)
    {
        $validatedData = $request -> validate([
            'desc' => 'required|string|min:2'
        ]);

        Reply::create([
            ...$validatedData,
            'user_id' => auth() -> user() -> id,
            'tip_id' => $tip -> id
        ]);

        return redirect() -> back() -> with('success', 'Reply saved');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tip $tip, Reply $reply)
    {
        $validatedData = $request -> validate([            
            'desc' => 'required|string|min:2',
        ]);

        $reply -> update([
            ...$validatedData,
            'edited' => true
        ]);
        
        return redirect() -> back() -> with('success', 'Reply updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Tip $tip, Reply $reply)
    {
        $reply -> delete();

        return redirect() -> back() -> with('success','Reply deleted successfully');
    }
}
