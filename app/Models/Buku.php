<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'published_year',
        'isbn',
        'stock',
    ];

    /**
     * Relasi untuk user yang meminjam buku ini.
     */
    public function peminjam(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_loans', 'buku_id', 'user_id')->withTimestamps();
    }
}
