<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Buku;
use App\Models\RunningNumber;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Buat 10 User
        User::factory(10)->create();

        // Siapkan urutan nomor ISBN
        RunningNumber::create(['prefix' => 'ISBN-978-602', 'last_number' => 0]);
        $runningNumber = RunningNumber::first();

        // Buat 30 Buku dengan ISBN berurutan
        for ($i = 0; $i < 30; $i++) {
            $runningNumber->last_number++;
            Buku::factory()->create([
                'isbn' => $runningNumber->prefix . '-' . str_pad($runningNumber->last_number, 5, '0', STR_PAD_LEFT)
            ]);
        }
        $runningNumber->save();
    }
}
