<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\User;
use App\Services\IsbnGeneratorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function buku_dapat_ditambahkan_melalui_api_oleh_user_terautentikasi()
    {
        $this->mock(IsbnGeneratorService::class, function ($mock) {
            $mock->shouldReceive('generate')->once()->andReturn('ISBN-TEST-12345');
        });

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/buku', [
            'title' => 'Judul Buku Keren Dari Test',
            'author' => 'Penulis Terkenal',
            'published_year' => '2025',
            'stock' => 10,
        ]);

        $response->assertStatus(201);

        $this->assertCount(1, Buku::all());
        $this->assertEquals('ISBN-TEST-12345', Buku::first()->isbn);
    }
}
