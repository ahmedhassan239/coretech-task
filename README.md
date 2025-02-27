Laravel API Project

This is a Laravel-based API that includes authentication, post creation, role-based access control, event-driven architecture, and queue-based notifications.

🚀 Features

✅ User Authentication (Register, Login, Profile)

✅ Role-Based Access Control (Admin, Editor, User)

✅ CRUD Operations for Posts

✅ Event & Queue-Based Notification System

✅ RESTful API with Laravel Sanctum

✅ Optimized Database Queries & Middleware Authorization

📌 Installation Steps

1️⃣ Clone the Repository

git clone https://github.com/ahmedhassan239/coretech-task.git
cd coretech-task

2️⃣ Install Dependencies

composer install

3️⃣ Copy Environment File & Configure

cp .env.example .env

Modify the .env file and update your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

4️⃣ Generate App Key

php artisan key:generate

5️⃣ Run Database Migrations

php artisan migrate --seed

6️⃣ Install Laravel Sanctum (For Authentication)

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

7️⃣ Clear Cache & Autoload

php artisan optimize:clear
composer dump-autoload

8️⃣ Run the Application

php artisan serve

The API will be available at:

http://127.0.0.1:8000

🔑 API Authentication

This API uses Laravel Sanctum for authentication.

Register a User

POST /api/register

Request Body (JSON):

{
  "name": "Test User",
  "email": "test@example.com",
  "password": "password"
}

Response (201 Created)

{
  "token": "YOUR_ACCESS_TOKEN",
  "user": { "id": 1, "name": "Test User", "email": "test@example.com" }
}

Login

POST /api/login

Request Body (JSON):

{
  "email": "test@example.com",
  "password": "password"
}

Response (200 OK)

{
  "token": "YOUR_ACCESS_TOKEN",
  "user": { "id": 1, "name": "Test User" }
}

Access Protected Routes

Include the Bearer Token in headers:

Authorization: Bearer YOUR_ACCESS_TOKEN

✍ Post Management Endpoints

Create a Post

POST /api/posts

Request Body (JSON)

{
  "title": "My First Post",
  "content": "This is my first post content."
}

Response (201 Created)

{
  "data": {
    "id": 1,
    "title": "My First Post",
    "content": "This is my first post content.",
    "status": "pending"
  }
}

Get All Posts

GET /api/posts

Update a Post

PUT /api/posts/{id}

Delete a Post

DELETE /api/posts/{id}

⚙ Queue & Notifications

This project includes queue-based notifications for admins when a new post is submitted.

To process queued jobs, run:

php artisan queue:work

🛠 Additional Commands

Run Unit Tests

php artisan test

List API Routes

php artisan route:list

🤝 Contributing

Fork the repository.

Create a new branch (feature-new).

Commit your changes (git commit -m "Added new feature").

Push to the branch (git push origin feature-new).

Open a Pull Request.


🚀 Now your Laravel API is fully documented and ready to use! 🚀Let me know if you need any modifications! 😊

