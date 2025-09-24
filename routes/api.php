    <?php

    use App\Http\Controllers\Api\AuthController;
    use App\Http\Controllers\LoanCtrl;
    use App\Http\Controllers\BukuCtrl;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    */

    // --- RUTE AUTENTIKASI ---
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Rute yang membutuhkan login
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', fn(Request $request) => $request->user());

        // --- RUTE APLIKASI ANDA ---
        // Endpoint CRUD Buku
        Route::get('/buku', [BukuCtrl::class, 'index']);
        Route::get('/buku/{buku}', [BukuCtrl::class, 'show']);
        Route::post('/buku', [BukuCtrl::class, 'store']);
        Route::put('/buku/{buku}', [BukuCtrl::class, 'update']);
        Route::delete('/buku/{buku}', [BukuCtrl::class, 'destroy']);

        // Endpoint Peminjaman Buku
        Route::post('/loans', [LoanCtrl::class, 'store']);
        Route::get('/loans/{user}', [LoanCtrl::class, 'show']);
    });
