<?php 

namespace App\Repositories;
use App\Models\Course;

class CourseRepository
{
    public function getAll()
    {
        return Course::paginate(15);
    }

    public function getById($id)
    {
        return Course::findOrFail($id);
    }

    public function create(array $data)
    {
        return Course::create($data);
    }

    public function update($id, array $data)
    {
        $course = $this->getById($id);
        $course->update($data);
        return $course;
    }

    public function delete($id)
    {
        $course = $this->getById($id);
        return $course->delete();
    }
}