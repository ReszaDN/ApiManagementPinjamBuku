<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Buku;
use App\Services\IsbnGeneratorService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BukuCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $books = Buku::latest()->paginate(10);
        return BookResource::collection($books);
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
    public function store(StoreBookRequest $request, IsbnGeneratorService $isbnGenerator): BookResource
    {
        $bookData = $request->validated();
        $bookData['isbn'] = $isbnGenerator->generate();

        $buku = Buku::create($bookData);

        // Mengembalikan data yang baru dibuat dengan status 201 Created
        return new BookResource($buku);
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku): BookResource
    {
        return new BookResource($buku);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Buku $buku): BookResource
    {
        $buku->update($request->validated());
        return new BookResource($buku->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku): Response
    {
        $buku->delete();
        return response("Delete Success", 200);
    }
}
