<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Like;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LikeController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this -> authorizeResource(Like::class);
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
    public function store(Request $request)
    {
        $model = $request -> input('type');
        $id = $request -> input('id');

        $validatedData = $request -> validate([
            'ind' => 'unique:likes|string'
        ]);

        if($model === 'tip'){
            Like::create([
                ...$validatedData,
                'user_id' => auth()->user()->id,
                'tip_id' => $id,
            ]);
        } else {
            Like::create([
                ...$validatedData,
                'user_id' => auth()->user()->id,
                'reply_id' => $id,
            ]);
        }

        return redirect() -> back() -> with('success', 'You have successfully liked the post');

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        $like -> delete();

        return redirect() -> back() -> with('success', 'Like deleted successfully');
    }
}
