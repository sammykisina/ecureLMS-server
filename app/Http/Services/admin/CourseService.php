<?php

declare(strict_types=1);

namespace App\Http\Services\Admin;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class CourseService {
    public function getCourses(): Collection {
        return QueryBuilder::for(subject: Course::class)
                      ->allowedIncludes(includes: [''])
                      ->defaultSort('-created_at')
                      ->get();
    }

      public function createCourse(array $newCourseData): Course {
          return Course::create($newCourseData);
      }

      public function updateCourse(array $updateCourseData, Course $course): bool {
          return $course->update($updateCourseData);
      }

      public function deleteCourse(Course $course): bool {
          return $course->delete();
      }
}
