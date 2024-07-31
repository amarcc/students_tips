<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phpml\Regression\LeastSquares;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mark.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'currentTimeSpent' => 'required|numeric|min:0.25',
            'currentEcts' => 'required|min:1|numeric'
        ]);

        for($i = 0; $i < 5; $i++){
            $request -> validate([
                'mark' . $i => 'required|numeric|min:5|max:10',
                'timeSpent' . $i => 'required|numeric|min:0.25',
                'ects'. $i => 'required|min:1|numeric'
            ]);
        }

        $currTimeSpent = $request -> input('currentTimeSpent');
        $currEcts = $request -> input('currentEcts');

        $x = [];

        $yMarks = [];

        for($i = 0; $i < 5; $i++){
            $xTimeSpent = $request -> input('timeSpent' . $i);
            $xEcts = $request -> input('ects' . $i);

            $yMark = $request -> input('mark'. $i);

            array_push($x, [$xTimeSpent, $xEcts]);
            array_push($yMarks, $yMark,);
        }

        $regression = new LeastSquares();

        $regression -> train($x, $yMarks);

        $coefficients = $regression->getCoefficients();
        $intercept = $regression->getIntercept();

        $num = round($intercept + $coefficients[0] * $currTimeSpent + $coefficients[1] * $currEcts);

        return redirect() -> route('mark.show', $num);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $num)
    {
        return view('mark.show', ['num' => $num]);
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
    public function destroy(string $id)
    {
        //
    }
}
