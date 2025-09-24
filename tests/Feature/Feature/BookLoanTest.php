<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookLoanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_terautentikasi_dapat_meminjam_buku()
    {
        $user = User::factory()->create();
        $buku = Buku::factory()->create(['stock' => 5]);

        Sanctum::actingAs($user);

        // DIUBAH: Mengirim 'buku_id' agar sesuai dengan validasi controller
        $response = $this->postJson('/api/loans', ['buku_id' => $buku->id]);

        $response->assertStatus(201);

        // DIUBAH: Memeriksa tabel 'bukus' yang benar
        $this->assertDatabaseHas('bukus', ['id' => $buku->id, 'stock' => 4]);
    }

    /** @test */
    public function buku_tidak_bisa_dipinjam_jika_stok_habis()
    {
        $user = User::factory()->create();
        $buku = Buku::factory()->create(['stock' => 0]);

        Sanctum::actingAs($user);

        // DIUBAH: Mengirim 'buku_id' agar sesuai dengan validasi controller
        $response = $this->postJson('/api/loans', ['buku_id' => $buku->id]);

        $response->assertStatus(422);
        $response->assertJson(['message' => 'Stok buku habis.']);
        $this->assertEquals(0, $buku->fresh()->stock);
    }
}
