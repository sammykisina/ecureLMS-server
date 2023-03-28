<?php

declare(strict_types=1);

namespace App\Http\Services\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class StudentService {
    public function getStudents(): Collection {
        return QueryBuilder::for(subject: User::class)
                      ->allowedIncludes(includes: ['role','course.units'])
                      ->defaultSort('-created_at')
                      ->allowedFilters(filters: AllowedFilter::exact('role.slug'))
                      ->get();
    }

    public function createStudent(array $newStudentData): User {
        return User::create($newStudentData);
    }

    public function updateStudent(array $updateStudentData, User $student): bool {
        return $student->update($updateStudentData);
    }

    public function deleteStudent(User $student): bool {
        return $student->delete();
    }
}
