<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Course;

class CourseApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * get all courses
     */
    public function test_get_all_courses(): void
    {
        Course::factory()->count(3)->create();
        $response = $this->getJson('/api/courses');
        $response->assertStatus(200);
    }

    /**
    * get a course by id
    */
    public function test_get_course_by_id(): void
    {
        $course = Course::factory()->create();
        $response = $this->getJson("/api/courses/{$course->id}");
        $response->assertStatus(200);
    }

    /**
    * create a course
    */
    public function test_create_course(): void
    {
        $response = $this->postJson('/api/courses', [
            'title' => 'Test Course',
            'description' => 'This is a test course',
            'status' => 'Pending',
            'is_premium' => false,
        ]); 

        $response->assertStatus(201);

        $this->assertDatabaseHas('courses', [
            'title' => 'Test Course',
            'description' => 'This is a test course',
            'status' => 'Pending',
            'is_premium' => false,
        ]);
    }

    /**
    * update a course    
    */
    public function test_update_course(): void
    {
        $course = Course::factory()->create();
        $response = $this->putJson("/api/courses/{$course->id}", [
            'title' => 'Updated Course',
            'description' => 'This is an updated test course',
            'status' => 'Published',
            'is_premium' => true,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('courses', [
            'id' => 1,
            'title' => 'Updated Course',
            'description' => 'This is an updated test course',
            'status' => 'Published',
            'is_premium' => true,
        ]);
    }

    /**
    * delete a course
    */
    public function test_delete_course(): void
    {
        $course = Course::factory()->create();
        $response = $this->deleteJson("/api/courses/{$course->id}");
        $response->assertStatus(200);
    }

    /**
     * validate course creation
     */
    public function test_validate_course_creation(): void
    {
        $response = $this->postJson('/api/courses', [
            'title' => '',
            'description' => 'Validation test',
            'status' => 'Pending',
            'is_premium' => false,
        ]);

        $response->assertStatus(422);
    }

    /**
     * validate course update
     */
    public function test_validate_course_update(): void
    {
        $course = Course::factory()->create();
        $response = $this->putJson("/api/courses/{$course->id}", [
            'title' => '',
            'description' => 'Validation test',
            'status' => 'Pending',
            'is_premium' => false,
        ]);

        $response->assertStatus(422);
    }
}
