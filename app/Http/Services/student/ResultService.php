<?php

declare(strict_types=1);

namespace App\Http\Services\Student;

use App\Models\Result;

class ResultService {
    public function createResults(array $newResultData): Result {
        return Result::create($newResultData);
    }
}
