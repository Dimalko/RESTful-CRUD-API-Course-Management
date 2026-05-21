<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CourseService;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use OpenApi\Attributes as OA;


class CourseController extends Controller
{
    public function __construct(protected CourseService $courseService){}

    #[OA\Get(
        path: "/api/courses",
        summary: "Get all courses",
        tags: ["Courses"]
    )]
    #[OA\Response(
        response: 200,
        description: "List of courses"
    )]
    public function index()
    {
        return response()->json($this->courseService->getAllCourses(), 200);
    }

    #[OA\Get(
        path: "/api/courses/{id}",
        summary: "Get course by ID",
        tags: ["Courses"]
    )]
    #[OA\Parameter(
        name: "id",
        in: "path",
        required: true,
        description: "Course ID"
    )]
    #[OA\Response(
        response: 200,
        description: "Course found"
    )]
    #[OA\Response(
        response: 404,
        description: "Course not found"
    )]
    public function show($id)
    {
        try{
            $course = $this->courseService->getCourseById($id);
            return response()->json($course, 200);
        }catch(\Exception $e){
            return response()->json(['message' => 'Course not found'], 404);
        }
    }

    #[OA\Post(
        path: "/api/courses",
        summary: "Create a course",
        tags: ["Courses"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["title", "status", "is_premium"],
                properties: [
                    new OA\Property(
                        property: "title",
                        type: "string",
                        example: "Laravel Course"
                    ),
                    new OA\Property(
                        property: "description",
                        type: "string",
                        example: "Learn Laravel step by step"
                    ),
                    new OA\Property(
                        property: "status",
                        type: "string",
                        example: "Pending"
                    ),
                    new OA\Property(
                        property: "is_premium",
                        type: "boolean",
                        example: true
                    ),
                ]
            )
        ),
    )]
    #[OA\Response(
        response: 201,
        description: "Course created successfully"
    )]
    #[OA\Response(
        response: 422,
        description: "Validation error"
    )]
    #[OA\Response(
        response: 400,
        description: "Invalid JSON payload"
    )]
    public function store(StoreCourseRequest $request)
    {
        $course = $this->courseService->createCourse($request->validated());
        return response()->json(['message' => 'Course created successfully', 'data' => $course], 201);
    }

    #[OA\Put(
        path: "/api/courses/{id}",
        summary: "Update a course",
        tags: ["Courses"]
    )]
    #[OA\Parameter(
        name: "id",
        in: "path",
        required: true,
        description: "Course ID"
    )]
    #[OA\Response(
        response: 200,
        description: "Course updated successfully"
    )]
    #[OA\Response(
        response: 404,
        description: "Course not found"
    )]
    public function update(UpdateCourseRequest $request, $id)
    {
        try{
            $course = $this->courseService->updateCourse($id, $request->validated());
            return response()->json(['message' => 'Course updated successfully', 'data' => $course], 200);
        }catch(\Exception $e){
            return response()->json(['message' => 'Course not found'], 404);
        }
    }

    #[OA\Delete(
        path: "/api/courses/{id}",
        summary: "Delete a course",
        tags: ["Courses"]
    )]
    #[OA\Parameter(
        name: "id",
        in: "path",
        required: true,
        description: "Course ID"
    )]
    #[OA\Response(
        response: 200,
        description: "Course deleted successfully"
    )]
    #[OA\Response(
        response: 404,
        description: "Course not found"
    )]
    public function destroy($id)
    {
        try{
            $this->courseService->deleteCourse($id);
            return response()->json(['message' => 'Course deleted successfully'], 200);
        }catch(\Exception $e){
            return response()->json(['message' => 'Course not found'], 404);
        }
    }
}

