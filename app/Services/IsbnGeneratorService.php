<?php

namespace App\Services;

use App\Models\RunningNumber;
use Illuminate\Support\Facades\DB;

class IsbnGeneratorService
{
    public function generate(): string
    {
        return DB::transaction(function () {
            $runningNumber = RunningNumber::where('prefix', 'ISBN-978-602')->lockForUpdate()->firstOrFail();

            $newNumber = $runningNumber->last_number + 1;
            $runningNumber->last_number = $newNumber;
            $runningNumber->save();

            return $runningNumber->prefix . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
        });
    }
}
