<h1 align="center">WritersHub</h1>

<hr/>

<h3 align="center">Platfrom Karya Buku Digital: Unggah dan Baca</h3>

---

<p align="center">
  <img src="https://github.com/user-attachments/assets/36f5b8ce-b59d-4c5d-892f-31a6f36b31b5" alt="Logo Unsulbar" width="200"/>
</p>

<p align="center">
  <strong>Atisa Wahyunianti</strong><br/><br/>
  <strong>D0223328</strong><br/><br/>
  <strong>Framework Web Based</strong><br/><br/>
  <strong>2025</strong>
</p>

---

## 👥 Role dan Fitur-fiturnya

### Admin
Admin adalah peran yang memiliki kontrol penuh atas platform dan bertanggung jawab untuk menjaga kelancaran operasional serta mengelola konten yang ada.

**Fitur utama:**
- Login admin
- Lihat semua buku/cerita 
- Bisa melihat ulasan
- Bisa melilhat akun user
- Menghapus akun pengguna, misalnya jika melanggar aturan
- Menghapus ulasan yang mengandung kata kasar, spam, atau tidak pantas
- Menghapus buku yang tidak sesuai aturan

### Penulis
Penulis adalah peran yang memiliki hak untuk mengunggah dan mengelola karya mereka, seperti buku atau cerita yang ingin dibagikan dengan pembaca.

**Fitur utama:**
- Login
- Mengelola Cerita, Penulis dapat mengedit informasi cerita (judul, deskripsi, cover, status).
- Mengelola Bab: Penulis bisa menambah, mengedit, dan menghapus chapter dalam ceritanyanya.
- Mengelola Ulasan: Penulis bisa melihat ulasan dari pembaca tentang bukunya.
- Penulis bisa melihat profil pembaca

### Pembaca
Pembaca  adalah  peran  yang  mengonsumsi  karya  yang  diunggah  oleh  penulis  dan memberikan interaksi balik berupa ulasan, rating, dan preferensi bacaan mereka.

**Fitur utama:**
- Login
- Membaca  Buku:  Pembaca  dapat  membaca  buku  yang  telah  dipublikasikan, berpindah antar bab, dan melanjutkan bacaan mereka.
- Memberikan Ulasan: Pembaca dapat memberikan ulasan dan rating untuk buku yang sudah dibaca.
- Menyimpan buku: Pembaca dapat menyimpan buku ke bookmark untuk dibaca di kemudian hari
- Pembaca bisa melihat profil penulis

---

## 🗄️ Tabel-Tabel Database

### 1. `users`

| Nama field      | Tipe data                        | Keterangan                                      |
|------------------|----------------------------------|--------------------------------------------------|
| user_id         | BigIncrements                    | ID unik pengguna (Primary Key, auto)           |
| username        | String                           | Nama pengguna yang digunakan untuk login        |
| email           | String                           | Alamat email pengguna, unik                     |
| password        | String                           | Kata sandi terenkripsi untuk login              |
| role            | Enum('admin', 'penulis', 'pembaca') | Menentukan hak akses                           |
| created_at      | Timestamps                       | Tanggal dan waktu akun dibuat                  |
| updated_at      | Timestamps                       | Tanggal dan waktu akun terakhir diperbarui     |


### 2. Tabel `books`

| Nama field    | Tipe data   | Keterangan                              |
|---------------|-------------|------------------------------------------|
| book_id       | BigIncrements | ID unik buku (Primary Key, auto)       |
| user_id       | foreignId   | ID penulis (foreign key dari `users`)   |
| title         | String      | Judul buku yang ditampilkan kepada pembaca                         |
| description   | String      | Deskripsi singkat isi buku              |
| cover_image   | String      | Lokasi gambar sampul (URL atau path)    |
| status        | Enum        | Status buku: ‘terbit’ untuk publik, ‘draft’ untuk pribadi/masih ditulis         |
| created_at    | Timestamps  | Tanggal dan waktu akun dibuat           |
| updated_at    | Timestamps  | Tanggal dan waktu akun diperbarui       |

### 3. Tabel `chapters`

| Nama field      | Tipe data   | Keterangan                              |
|------------------|-------------|------------------------------------------|
| chapter_id      | BigIncrements | ID unik untuk tiap bab (Primary Key)   |
| book_id         | foreignId   | ID buku (foreign key ke `books`)       |
| title           | String      | Judul bab                               |
| content         | String      | Isi cerita dari bab tersebut           |
| chapter_number  | Int         | Nomor urutan bab (contoh: 1, 2, 3...)   |
| created_at      | Timestamps  | Tanggal dibuat                          |
| updated_at      | Timestamps  | Tanggal diperbarui                      |

### 4. Tabel `reviews`

| Nama field    | Tipe data   | Keterangan                                   |
|---------------|-------------|-----------------------------------------------|
| review_id     | BigIncrements | ID unik untuk ulasan (Primary Key, auto)  |
| book_id       | foreignId   | ID buku yang diulas                         |
| user_id       | foreignId   | ID pembaca yang memberi ulasan              |
| review_text   | String      | Isi teks ulasan dari pembaca                |
| created_at    | Timestamps  | Tanggal dibuat                              |
| updated_at    | Timestamps  | Tanggal diperbarui                          |

### 5. Tabel `bookmarks`

| Nama field    | Tipe data   | Keterangan                                  |
|---------------|-------------|----------------------------------------------|
| bookmark_id   | BigIncrements | ID unik untuk tiap bookmark (Primary Key) |
| book_id       | foreignId   | ID buku yang disimpan                      |
| user_id       | foreignId   | ID pembaca yang menyimpan buku             |
| created_at    | Timestamps  | Tanggal dibuat                             |
| updated_at    | Timestamps  | Tanggal diperbarui                         |

### 6. Tabel `genres`

| Field      | Tipe Data     | Keterangan                                 |
|------------|---------------|--------------------------------------------|
| id         | BigIncrements | ID unik genre (Primary Key, auto increment)|
| name       | String        | Nama genre, bersifat unik                  |
| created_at | Timestamps    | Tanggal dan waktu genre dibuat             |
| updated_at | Timestamps    | Tanggal dan waktu genre diperbarui         |

### 7. Tabel `profil`

| Field      | Tipe Data     | Keterangan                                                                  |
|------------|---------------|-----------------------------------------------------------------------------|
| id         | BigIncrements | ID unik profil (Primary Key, auto increment)                               |
| user_id    | ForeignId     | ID pengguna (relasi ke tabel `users`, unik, `onDelete: cascade`)           |
| name       | String        | Nama lengkap pengguna                                                       |
| bio        | Text          | Deskripsi atau biografi pengguna (boleh kosong / nullable)                 |
| created_at | Timestamps    | Tanggal dan waktu profil dibuat                                            |
| updated_at | Timestamps    | Tanggal dan waktu profil diperbarui                                        |

### 8. Tabel `book_genre`

| Field     | Tipe Data     | Keterangan                                                            |
|-----------|---------------|------------------------------------------------------------------------|
| id        | BigIncrements | ID unik (Primary Key, auto increment)                                 |
| book_id   | ForeignId     | ID buku (relasi ke tabel `books`, `onDelete: cascade`)                |
| genre_id  | ForeignId     | ID genre (relasi ke tabel `genres`, `onDelete: cascade`)              |



---

## 🔗 Relasi Antar Tabel

| Tabel 1        | Relasi | Tabel 2         | Jenis Relasi   | Keterangan                                              |
|----------------|--------|------------------|----------------|----------------------------------------------------------|
| `users`        | 1 : 1  | `wargas`         | One to One     | Satu user bisa menjadi warga (nullable)                  |
| `users`        | 1 : 1  | `pemerintahs`    | One to One     | Satu user adalah satu akun pemerintah                    |
| `users`        | 1 : 1  | `penyelenggaras` | One to One     | Satu user adalah satu akun penyelenggara                |
| `penyelenggaras` | 1 : N | `kegiatans`      | One to Many    | Satu penyelenggara bisa membuat banyak kegiatan         |
| `wargas`       | N : N  | `kegiatans`      | Many to Many   | Lewat tabel `pendaftarans`                              |
| `wargas`       | 1 : N  | `komentars`      | One to Many    | Warga bisa membuat banyak komentar                      |
| `kegiatans`    | 1 : N  | `komentars`      | One to Many    | Satu kegiatan bisa memiliki banyak komentar              |
