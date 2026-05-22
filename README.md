# Course Management RESTful CRUD API

## Installation

Clone the repository:

```bash
git clone https://github.com/Dimalko/RESTful-CRUD-API-Course-Management
```

Go to project folder

Install dependencies:

```bash
composer install
```

Create .env file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```


## Database Setup

Create a database named course_api

Update your .env database credentials:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=course_api
DB_USERNAME=root
DB_PASSWORD=<Your password>
```

Run migrations:

```bash
php artisan migrate
```
## Running the Application

Start Laravel development server:

```bash
php artisan serve
```

API will be available at:

```bash
http://127.0.0.1:8000
```

## API Documentation (Swagger)

Swagger UI available at:

```bash
http://127.0.0.1:8000/api/documentation
```

## API Endpoints
Method	Endpoint	Description

```bash
GET	/api/courses	Get all courses
GET	/api/courses/{id}	Get single course
POST	/api/courses	Create course
PUT	/api/courses/{id}	Update course
DELETE	/api/courses/{id}	Soft delete course
```

Example Request Body
```bash
{
  "title": "Laravel Course",
  "description": "Learn Laravel step by step",
  "status": "Pending",
  "is_premium": true
}
```

## Running Tests

Run all tests:

```bash
php artisan test
```
