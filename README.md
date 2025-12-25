# JurnalKu API – Laravel REST API

REST API sederhana berbasis **Laravel** untuk mengelola data user/siswa.  
API ini digunakan sebagai backend untuk aplikasi Flutter dan berfokus pada operasi **CRUD User**.

> ⚠️ API ini **belum menggunakan autentikasi (public API)** dan ditujukan untuk kebutuhan pembelajaran, tugas sekolah, atau prototype aplikasi.

---

## 🚀 Tech Stack

- Laravel
- PHP
- MySQL
- RESTful API (JSON)
- HTTP Client (Flutter)

---

## 🌐 Base URL
http://127.0.0.1:8000/api


---

## 📌 Fitur API

- Menampilkan seluruh user
- Menampilkan detail user berdasarkan ID
- Menambahkan user baru
- Mengubah data user
- Menghapus user

---

## 📄 Struktur Data User

| Field | Type | Description |
|------|------|------------|
| id | integer | ID user |
| name | string | Nama lengkap |
| email | string | Email user (unik) |
| nis | integer | Nomor Induk Siswa |
| rombel | string | Rombel |
| rayon | string | Rayon |
| image | string \| null | URL foto profil |
| grade | enum | `X`, `XI`, `XII` |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diperbarui |

---

## 🔹 Get All Users

**Endpoint**

🔹GET /users

**Response 200**
```json
[
  {
    "id": 1,
    "name": "Syahputra Winata",
    "email": "user@mail.com",
    "nis": 123456,
    "rombel": "PPLG XII-4",
    "rayon": "Cic 10",
    "image": null,
    "grade": "XII"
  }
]

🔹Get User By ID

Endpoint
GET /users/{id}

Response 200
{
  "id": 1,
  "name": "Syahputra Winata",
  "email": "user@mail.com",
  "nis": 123456,
  "rombel": "PPLG XII-4",
  "rayon": "Cic 10",
  "image": null,
  "grade": "XII"
}

Response 404
{
  "message": "Not Found"
}

🔹Create User

Endpoint
POST /users

Request Body (JSON)
{
  "name": "Putra",
  "email": "putra@mail.com",
  "password": "password123",
  "nis": 123456,
  "rombel": "PPLG XII-4",
  "rayon": "Cic 10",
  "image": "https://example.com/photo.jpg",
  "grade": "XII"
}

Response 201
{
  "id": 1,
  "name": "Putra",
  "email": "putra@mail.com",
  "nis": 123456,
  "rombel": "PPLG XII-4",
  "rayon": "Cic 10",
  "image": null,
  "grade": "XII"
}

Response 422
{
  "errors": {
    "email": ["The email has already been taken."]
  }
}

Update User

Endpoint
PUT /users/{id}
PATCH /users/{id}

Request Body (JSON)
{
  "rombel": "PPLG XII-5",
  "rayon": "Cic 9"
}

Response 200
{
  "id": 1,
  "name": "Putra",
  "email": "putra@mail.com",
  "rombel": "PPLG XII-5",
  "rayon": "Cic 9"
}

Delete User
Endpoint
DELETE /users/{id}
Response 200
{
  "message": "deleted"
}
