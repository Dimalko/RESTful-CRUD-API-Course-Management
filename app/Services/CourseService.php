<?php

namespace App\Services;
use App\Repositories\CourseRepository;

class CourseService
{
    public function __construct(protected CourseRepository $courseRepository) {}

    public function getAllCourses()
    {
        return $this->courseRepository->getAll();
    }

    public function getCourseById($id)
    {
        return $this->courseRepository->getById($id);
    }

    public function createCourse(array $data)
    {
        return $this->courseRepository->create($data);
    }

    public function updateCourse($id, array $data)
    {
        return $this->courseRepository->update($id, $data);
    }

    public function deleteCourse($id)
    {
        return $this->courseRepository->delete($id);
    }
}