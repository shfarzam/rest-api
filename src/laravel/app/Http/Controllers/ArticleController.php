<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate Input Parameter
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|string|max:255',
            'text' => 'required|max:500',
            'creation_date' => 'required|date',
            'publication_date' => 'required|date'
        ]);
    
        // insert into Table
        $article = Article::create($validatedData);
    
        return response()->json($article, 201);
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
