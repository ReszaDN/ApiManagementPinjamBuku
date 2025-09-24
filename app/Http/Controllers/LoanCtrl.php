<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Jobs\SendLoanNotificationEmail;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class LoanCtrl extends Controller
{
    public function show(User $user): AnonymousResourceCollection
    {
        return BookResource::collection($user->bukuPinjaman()->paginate(10));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $buku = Buku::findOrFail($request->buku_id);
        $user = $request->user();

        if ($buku->stock < 1) {
            return response()->json(['message' => 'Stok buku habis.'], 422);
        }

        DB::transaction(function () use ($user, $buku) {
            $user->bukuPinjaman()->attach($buku->id);
            $buku->decrement('stock');
        });

        SendLoanNotificationEmail::dispatch($user, $buku);

        return response()->json(['message' => 'Buku berhasil dipinjam.'], 201);
    }
}
