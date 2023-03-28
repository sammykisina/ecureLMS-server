<?php

declare(strict_types=1);

namespace App\Http\Services\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LecturerService {
    public function getLecturers(): Collection {
        return QueryBuilder::for(subject: User::class)
                      ->allowedIncludes(includes: ['role','units.course'])
                      ->defaultSort('-created_at')
                      ->allowedFilters(filters: AllowedFilter::exact('role.slug'))
                      ->get();
    }

    public function createLecturer(array $newLecturerData): User {
        return User::create($newLecturerData);
    }

     public function updateLecturer(array $updateLecturerData, User $lecturer): bool {
         return $lecturer->update($updateLecturerData);
     }

     public function deleteLecturer(User $lecturer): bool {
         return $lecturer->delete();
     }
}
