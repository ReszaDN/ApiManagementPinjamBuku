<?php

namespace App\Jobs;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
// ... (use statements)

class SendLoanNotificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected User $user, protected Buku $book) {}

    public function handle(): void
    {
        \Log::info("Email notifikasi peminjaman dikirim ke {$this->user->email} untuk buku '{$this->book->title}'");
    }
}
