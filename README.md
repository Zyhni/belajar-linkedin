# Belajar LinkedIn Class — REST API (Laravel + MySQL) 🚀

Deskripsi singkat
API sederhana untuk platform Belajar LinkedIn Class — menyediakan fitur registrasi & login user, CRUD untuk kelas (courses), dan pendaftaran (enrollment) user ke kelas. Implementasi menggunakan Laravel, MySQL, dan Laravel Sanctum untuk autentikasi token. Database ada di dalam folder Storage yang bernama belajar_linkedin_db.

# 📚 Daftar fitur

# 🧑‍💻 Auth

POST /api/register — registrasi user (name, email, password)

POST /api/login — login (email, password) → mengembalikan token

POST /api/logout — logout (menghapus token)

# 🏷️ Courses (Class)

GET /api/courses — list semua course

POST /api/courses — tambah course

GET /api/courses/{id} — detail course

PUT /api/courses/{id} — update course

DELETE /api/courses/{id} — hapus course

# ✍️ Enrollment

POST /api/enroll/{courseId} — user ter-autentikasi mendaftar ke course

GET /api/my-enrollments — daftar course user (yang sedang login)

# ⚙️ Persyaratan (local)

PHP >= 8.1

Composer

MySQL / MariaDB (phpMyAdmin opsional)

Git

(opsional) Postman atau curl

# 🛠️ Cara menjalankan (setup langkah demi langkah)

── Clone repo

git clone https://github.com/<username>/<repo>.git
cd belajar-linkedin-class


── Install dependency

composer install


Edit .env sesuai DB:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=belajar_linkedin_db
DB_USERNAME=root
DB_PASSWORD=


── (Jika belum) Install & publish Sanctum

composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate


── Jalankan migration

php artisan migrate

── Jalankan server

php artisan serve
# akses default: http://127.0.0.1:8000

🔁 Contoh request & response

Pastikan header:
Content-Type: application/json
Accept: application/json
Untuk route yang butuh auth, tambah header: Authorization: Bearer <token>

# 1) Register

Request

POST /api/register
Content-Type: application/json


Body:

{
  "name": "Iyz",
  "email": "iyz@example.com",
  "password": "12345678"
}


Response (201 Created)

{
  "user": { "id": 1, "name": "Iyz", "email": "iyz@example.com", ... },
  "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
}

# 2) Login

Request

POST /api/login


Body:

{
  "email": "iyz@example.com",
  "password": "12345678"
}


Response

{
  "user": { ... },
  "token": "1|xxxxxxxxxxxxxxxxxxxx"
}


Gunakan token:

Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxx

# 3) Create Course

Request

POST /api/courses
Authorization: Bearer <token>


Body:

{
  "title": "Laravel Basics",
  "description": "Belajar dasar Laravel",
  "teacher": "Pak Aji"
}


Response (201)

{
  "id": 1,
  "title": "Laravel Basics",
  "description": "Belajar dasar Laravel",
  "teacher": "Pak Aji",
  "created_at": "2025-07-30T...",
  "updated_at": "2025-07-30T..."
}

# 4) Enroll (daftarkan user yg login ke course id 2)

Request

POST /api/enroll/2
Authorization: Bearer <token>


Response (201)

{
  "id": 5,
  "user_id": 1,
  "course_id": 2,
  "created_at": "2025-07-30T10:00:00.000000Z",
  "updated_at": "..."
}


Jika sudah terdaftar:

{ "message": "Already enrolled" }
