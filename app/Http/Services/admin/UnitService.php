<?php

declare(strict_types=1);

namespace App\Http\Services\Admin;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class UnitService {
    public function getUnits(): Collection {
        return QueryBuilder::for(subject: Unit::class)
                      ->allowedIncludes(includes: ['course'])
                      ->defaultSort('-created_at')
                      ->get();
    }

        public function createUnit(array $newUnitData): Unit {
            return Unit::create($newUnitData);
        }

        public function updateUnit(array $updateUnitData, Unit $unit): bool {
            return $unit->update($updateUnitData);
        }

        public function deleteUnit(Unit $unit): bool {
            return $unit->delete();
        }
}
