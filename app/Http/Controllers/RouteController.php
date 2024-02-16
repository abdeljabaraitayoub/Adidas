<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/routes",
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function index()
    {
        Route::all();
        return response()->json(Route::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
