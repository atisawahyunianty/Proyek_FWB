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

### 🧑‍💼 Penyelenggara
Role organisasi atau kelompok yang bertanggung jawab mengusulkan dan menjalankan kegiatan.

**Fitur utama:**
- Mengajukan kegiatan
- Melihat status kegiatan yang diajukan
- Melihat daftar warga yang mendaftar ke kegiatan mereka

### 👤 Warga
Role masyarakat umum yang bisa mendaftar kegiatan desa dan memberikan komentar.

**Fitur utama:**
- Melihat daftar kegiatan yang tersedia (status approved)
- Mendaftar kegiatan yang diinginkan
- Melihat riwayat pendaftaran kegiatan
- Memberikan komentar terhadap kegiatan

---

## 🗄️ Tabel-Tabel Database

### 1. `users`

| Field              | Tipe Data     | Keterangan                                  |
|-------------------|---------------|---------------------------------------------|
| id                | BIGINT        | Primary Key (auto increment)                |
| name              | String        | Nama pengguna                               |
| email             | String        | Email unik pengguna                         |
| email_verified_at | Timestamp     | Tanggal verifikasi email (nullable)         |
| password          | String        | Password terenkripsi                        |
| role              | String        | Peran pengguna (warga, pemerintah, penyelenggara) |
| created_at        | Timestamp     | Tanggal dibuat                              |
| updated_at        | Timestamp     | Tanggal diperbarui                          |

### 2. `wargas`

| Field         | Tipe Data | Keterangan                             |
|---------------|-----------|----------------------------------------|
| id            | BIGINT    | Primary key (auto increment)           |
| nik           | String    | Nomor Induk Kependudukan (unik)        |
| nama          | String    | Nama lengkap warga                     |
| tanggal_lahir | Date      | Tanggal lahir warga                    |
| alamat        | String    | Alamat tempat tinggal                 |
| user_id       | BIGINT    | Relasi ke tabel `users`               |
| created_at    | Timestamp | Tanggal dibuat                         |
| updated_at    | Timestamp | Tanggal diperbarui                     |

### 3. `pemerintahs`

| Field     | Tipe Data | Keterangan                            |
|-----------|-----------|----------------------------------------|
| id        | BIGINT    | Primary key                           |
| user_id   | BIGINT    | Foreign key ke `users`                |
| jabatan   | String    | Nama jabatan pemerintah (nullable)    |
| created_at| Timestamp | Tanggal dibuat                        |
| updated_at| Timestamp | Tanggal diperbarui                    |

### 4. `penyelenggaras`

| Field            | Tipe Data | Keterangan                               |
|------------------|-----------|------------------------------------------|
| id               | BIGINT    | Primary key (auto increment)             |
| user_id          | BIGINT    | Foreign key ke `users`                   |
| nama_organisasi  | String    | Nama organisasi/instansi penyelenggara   |
| created_at       | Timestamp | Tanggal dibuat                           |
| updated_at       | Timestamp | Tanggal diperbarui                       |

### 5. `kegiatans`

| Field             | Tipe Data | Keterangan                                         |
|-------------------|-----------|----------------------------------------------------|
| id                | BIGINT    | Primary key (auto increment)                      |
| judul             | String    | Judul kegiatan                                     |
| deskripsi         | Text      | Deskripsi kegiatan                                 |
| tanggal           | Date      | Tanggal pelaksanaan kegiatan                       |
| lokasi            | String    | Lokasi kegiatan                                    |
| status            | ENUM      | Status kegiatan (pending, approved, rejected)      |
| penyelenggara_id  | BIGINT    | Foreign key ke `users` (penyelenggara)             |
| created_at        | Timestamp | Tanggal dibuat                                     |
| updated_at        | Timestamp | Tanggal diperbarui                                 |

### 6. `pendaftarans`

| Field        | Tipe Data | Keterangan                       |
|--------------|-----------|----------------------------------|
| id           | BIGINT    | Primary key (auto increment)     |
| warga_id     | BIGINT    | Foreign key ke `wargas`         |
| kegiatan_id  | BIGINT    | Foreign key ke `kegiatans`      |
| created_at   | Timestamp | Tanggal dibuat                   |
| updated_at   | Timestamp | Tanggal diperbarui               |

### 7. `komentars`

| Field        | Tipe Data | Keterangan                               |
|--------------|-----------|------------------------------------------|
| id           | BIGINT    | Primary key (auto increment)             |
| warga_id     | BIGINT    | Foreign key ke `wargas`                 |
| kegiatan_id  | BIGINT    | Foreign key ke `kegiatans`              |
| isi_komentar | Text      | Isi komentar warga terhadap kegiatan     |
| created_at   | Timestamp | Tanggal komentar dibuat                  |
| updated_at   | Timestamp | Tanggal komentar diperbarui              |

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
