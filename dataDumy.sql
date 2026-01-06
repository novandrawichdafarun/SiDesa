-- 1. DATA USERS (20 Data)
-- Password untuk semua user adalah: "password"
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES 
(3, 2, 'Yuni Wibowo', 'user1@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(4, 2, 'Bambang Hidayat', 'user2@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(5, 2, 'Joko Susanto', 'user3@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(6, 2, 'Bambang Wijaya', 'user4@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(7, 2, 'Siti Setiawan', 'user5@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(8, 2, 'Rudi Astuti', 'user6@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(9, 2, 'Budi Wijaya', 'user7@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(10, 2, 'Eko Wijaya', 'user8@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(11, 2, 'Eko Pratama', 'user9@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(12, 2, 'Rudi Setiawan', 'user10@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(13, 2, 'Sari Saputro', 'user11@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(14, 2, 'Agus Lestari', 'user12@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(15, 2, 'Siti Saputra', 'user13@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(16, 2, 'Rudi Pertiwi', 'user14@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(17, 2, 'Fajar Astuti', 'user15@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(18, 2, 'Indra Santoso', 'user16@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(19, 2, 'Sari Hidayat', 'user17@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(20, 2, 'Bambang Wijaya', 'user18@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(21, 2, 'Siti Susanto', 'user19@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW()),
(22, 2, 'Wahyu Pertiwi', 'user20@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved', NULL, NOW(), NOW());

-- 2. DATA RESIDENTS (20 Data - Relasi ke User ID 1-20)
INSERT INTO `residents` (`id`, `user_id`, `nik`, `name`, `birth_place`, `birth_date`, `gender`, `address`, `religion`, `marital_status`, `occupation`, `phone`, `status`, `created_at`, `updated_at`) VALUES 
(3, 3, '3501656582799727', 'Yuni Wibowo', 'Bojonegoro', '1974-01-10', 'female', 'Jl. Brawijaya No. 15, Sidoarjo', 'Islam', 'widowed', 'Pedagang', '08123456001', 'active', NOW(), NOW()),
(4, 4, '3504802765536961', 'Bambang Hidayat', 'Mojokerto', '1986-02-28', 'male', 'Jl. Merdeka No. 60, Tuban', 'Islam', 'divorced', 'Petani', '08123456002', 'active', NOW(), NOW()),
(5, 5, '3509310881846205', 'Joko Susanto', 'Surabaya', '1985-07-15', 'female', 'Jl. Gajah Mada No. 38, Mojokerto', 'Islam', 'married', 'Belum/Tidak Bekerja', '08123456003', 'active', NOW(), NOW()),
(6, 6, '3508651140498406', 'Bambang Wijaya', 'Gresik', '1971-09-13', 'male', 'Jl. Gajah Mada No. 9, Lamongan', 'Islam', 'married', 'Petani', '08123456004', 'active', NOW(), NOW()),
(7, 7, '3509111966745623', 'Siti Setiawan', 'Bojonegoro', '1976-02-29', 'male', 'Jl. Gajah Mada No. 91, Mojokerto', 'Islam', 'married', 'Buruh Tani', '08123456005', 'active', NOW(), NOW()),
(8, 8, '3507732826650677', 'Rudi Astuti', 'Gresik', '2001-01-18', 'female', 'Jl. Sudirman No. 89, Mojokerto', 'Islam', 'single', 'Guru', '08123456006', 'active', NOW(), NOW()),
(9, 9, '3509047146713340', 'Budi Wijaya', 'Surabaya', '1997-03-01', 'female', 'Jl. Brawijaya No. 31, Bojonegoro', 'Islam', 'widowed', 'Karyawan Swasta', '08123456007', 'active', NOW(), NOW()),
(10, 10, '3509494233666405', 'Eko Wijaya', 'Bojonegoro', '1977-01-28', 'female', 'Jl. Hayam Wuruk No. 58, Pasuruan', 'Islam', 'single', 'Buruh Tani', '08123456008', 'active', NOW(), NOW()),
(11, 11, '3507480645494236', 'Eko Pratama', 'Sidoarjo', '1993-06-12', 'male', 'Jl. Sudirman No. 2, Jombang', 'Islam', 'married', 'TNI/Polri', '08123456009', 'active', NOW(), NOW()),
(12, 12, '3507678166476353', 'Rudi Setiawan', 'Lamongan', '2003-12-18', 'male', 'Jl. Kartini No. 48, Gresik', 'Islam', 'married', 'Buruh Tani', '08123456010', 'active', NOW(), NOW()),
(13, 13, '3504637282130136', 'Sari Saputro', 'Tuban', '1993-09-14', 'female', 'Jl. Pahlawan No. 79, Jombang', 'Islam', 'single', 'Karyawan Swasta', '08123456011', 'active', NOW(), NOW()),
(14, 14, '3508978198429777', 'Agus Lestari', 'Jombang', '1994-12-09', 'male', 'Jl. Pahlawan No. 91, Bojonegoro', 'Islam', 'divorced', 'Buruh Tani', '08123456012', 'active', NOW(), NOW()),
(15, 15, '3505111541887114', 'Siti Saputra', 'Lamongan', '1994-01-22', 'male', 'Jl. Pahlawan No. 81, Bojonegoro', 'Islam', 'widowed', 'Belum/Tidak Bekerja', '08123456013', 'active', NOW(), NOW()),
(16, 16, '3501440959842788', 'Rudi Pertiwi', 'Malang', '1979-06-12', 'male', 'Jl. Majapahit No. 18, Malang', 'Islam', 'married', 'Belum/Tidak Bekerja', '08123456014', 'active', NOW(), NOW()),
(17, 17, '3502818656289265', 'Fajar Astuti', 'Tuban', '1978-07-30', 'male', 'Jl. Majapahit No. 95, Surabaya', 'Islam', 'widowed', 'Buruh Tani', '08123456015', 'active', NOW(), NOW()),
(18, 18, '3502974098428702', 'Indra Santoso', 'Jombang', '1977-03-16', 'male', 'Jl. Pahlawan No. 63, Malang', 'Islam', 'widowed', 'Buruh Tani', '08123456016', 'active', NOW(), NOW()),
(19, 19, '3509191280370683', 'Sari Hidayat', 'Surabaya', '1998-09-12', 'female', 'Jl. Sudirman No. 2, Mojokerto', 'Islam', 'divorced', 'Pedagang', '08123456017', 'active', NOW(), NOW()),
(20, 20, '3506452081038793', 'Bambang Wijaya', 'Mojokerto', '1997-11-05', 'female', 'Jl. Hayam Wuruk No. 21, Mojokerto', 'Islam', 'married', 'Petani', '08123456018', 'active', NOW(), NOW()),
(21, 21, '3503952109081129', 'Siti Susanto', 'Pasuruan', '1984-07-02', 'female', 'Jl. Diponegoro No. 90, Gresik', 'Islam', 'divorced', 'Belum/Tidak Bekerja', '08123456019', 'active', NOW(), NOW()),
(22, 22, '3507069268138303', 'Wahyu Pertiwi', 'Malang', '1984-11-22', 'male', 'Jl. Brawijaya No. 84, Gresik', 'Islam', 'married', 'PNS', '08123456020', 'active', NOW(), NOW());

-- 3. DATA COMPLAINTS (20 Data)
INSERT INTO `complaints` (`resident_id`, `title`, `content`, `status`, `photo_proof`, `report_date`, `created_at`, `updated_at`) VALUES 
(19, 'Sampah menumpuk di sungai', 'Mohon tindak lanjut untuk Sampah menumpuk di sungai. Kondisi sudah berlangsung selama 1 hari.', 'completed', NULL, NOW(), NOW(), NOW()),
(15, 'Hewan liar masuk pemukiman', 'Mohon tindak lanjut untuk Hewan liar masuk pemukiman. Kondisi sudah berlangsung selama 7 hari.', 'new', NULL, NOW(), NOW(), NOW()),
(16, 'Lampu PJU mati total', 'Mohon tindak lanjut untuk Lampu PJU mati total. Kondisi sudah berlangsung selama 5 hari.', 'new', NULL, NOW(), NOW(), NOW()),
(4, 'Pelayanan kelurahan lambat', 'Mohon tindak lanjut untuk Pelayanan kelurahan lambat. Kondisi sudah berlangsung selama 2 hari.', 'new', NULL, NOW(), NOW(), NOW()),
(12, 'Hewan liar masuk pemukiman', 'Mohon tindak lanjut untuk Hewan liar masuk pemukiman. Kondisi sudah berlangsung selama 5 hari.', 'completed', NULL, NOW(), NOW(), NOW()),
(3, 'Sampah menumpuk di sungai', 'Mohon tindak lanjut untuk Sampah menumpuk di sungai. Kondisi sudah berlangsung selama 9 hari.', 'processing', NULL, NOW(), NOW(), NOW()),
(4, 'Pelayanan kelurahan lambat', 'Mohon tindak lanjut untuk Pelayanan kelurahan lambat. Kondisi sudah berlangsung selama 3 hari.', 'new', NULL, NOW(), NOW(), NOW()),
(5, 'Permohonan fogging nyamuk', 'Mohon tindak lanjut untuk Permohonan fogging nyamuk. Kondisi sudah berlangsung selama 2 hari.', 'processing', NULL, NOW(), NOW(), NOW()),
(4, 'Selokan mampet menyebabkan banjir', 'Mohon tindak lanjut untuk Selokan mampet menyebabkan banjir. Kondisi sudah berlangsung selama 3 hari.', 'completed', NULL, NOW(), NOW(), NOW()),
(19, 'Pelayanan kelurahan lambat', 'Mohon tindak lanjut untuk Pelayanan kelurahan lambat. Kondisi sudah berlangsung selama 5 hari.', 'completed', NULL, NOW(), NOW(), NOW()),
(10, 'Hewan liar masuk pemukiman', 'Mohon tindak lanjut untuk Hewan liar masuk pemukiman. Kondisi sudah berlangsung selama 10 hari.', 'completed', NULL, NOW(), NOW(), NOW()),
(17, 'Lampu PJU mati total', 'Mohon tindak lanjut untuk Lampu PJU mati total. Kondisi sudah berlangsung selama 5 hari.', 'new', NULL, NOW(), NOW(), NOW()),
(21, 'Hewan liar masuk pemukiman', 'Mohon tindak lanjut untuk Hewan liar masuk pemukiman. Kondisi sudah berlangsung selama 7 hari.', 'new', NULL, NOW(), NOW(), NOW()),
(8, 'Hewan liar masuk pemukiman', 'Mohon tindak lanjut untuk Hewan liar masuk pemukiman. Kondisi sudah berlangsung selama 10 hari.', 'completed', NULL, NOW(), NOW(), NOW()),
(8, 'Hewan liar masuk pemukiman', 'Mohon tindak lanjut untuk Hewan liar masuk pemukiman. Kondisi sudah berlangsung selama 9 hari.', 'processing', NULL, NOW(), NOW(), NOW()),
(13, 'Hewan liar masuk pemukiman', 'Mohon tindak lanjut untuk Hewan liar masuk pemukiman. Kondisi sudah berlangsung selama 8 hari.', 'completed', NULL, NOW(), NOW(), NOW()),
(12, 'Permohonan fogging nyamuk', 'Mohon tindak lanjut untuk Permohonan fogging nyamuk. Kondisi sudah berlangsung selama 10 hari.', 'completed', NULL, NOW(), NOW(), NOW()),
(6, 'Permohonan fogging nyamuk', 'Mohon tindak lanjut untuk Permohonan fogging nyamuk. Kondisi sudah berlangsung selama 9 hari.', 'new', NULL, NOW(), NOW(), NOW()),
(22, 'Selokan mampet menyebabkan banjir', 'Mohon tindak lanjut untuk Selokan mampet menyebabkan banjir. Kondisi sudah berlangsung selama 8 hari.', 'completed', NULL, NOW(), NOW(), NOW()),
(18, 'Sampah menumpuk di sungai', 'Mohon tindak lanjut untuk Sampah menumpuk di sungai. Kondisi sudah berlangsung selama 9 hari.', 'completed', NULL, NOW(), NOW(), NOW());

-- 4. DATA LETTER TYPES (Jenis Surat Dasar)
INSERT INTO `letter_types` (`name`, `code`, `created_at`, `updated_at`) VALUES 
-- (1, 'Surat Keterangan Domisili', 'SKD', NOW(), NOW()),
-- (2, 'Surat Keterangan Tidak Mampu', 'SKTM', NOW(), NOW()),
-- (3, 'Surat Keterangan Usaha', 'SKU', NOW(), NOW()),
('Surat Pengantar SKCK', 'SPSKCK', NOW(), NOW()),
('Surat Keterangan Belum Menikah', 'SKBM', NOW(), NOW());

-- 5. DATA LETTER REQUESTS (20 Data)
INSERT INTO `letter_requests` (`user_id`, `letter_type_id`, `status`, `purpose`, `admin_note`, `created_at`, `updated_at`) VALUES 
(3, 4, 'rejected', 'Data kurang lengkap', 'Mohon lengkapi KTP', NOW(), NOW()),
(19, 3, 'rejected', 'Data kurang lengkap', 'Foto buram', NOW(), NOW()),
(11, 1, 'rejected', 'Data kurang lengkap', NULL, NOW(), NOW()),
(9, 5, 'approved', 'Sudah selesai', 'Ok', NOW(), NOW()),
(13, 1, 'approved', 'Sudah selesai', 'Ok', NOW(), NOW()),
(5, 2, 'approved', 'Sudah selesai', 'Ok', NOW(), NOW()),
(20, 5, 'pending', 'Mohon segera diproses', NULL, NOW(), NOW()),
(19, 5, 'approved', 'Sudah selesai', 'Ok', NOW(), NOW()),
(12, 4, 'approved', 'Sudah selesai', 'Ok', NOW(), NOW()),
(15, 5, 'approved', 'Sudah selesai', 'Ok', NOW(), NOW()),
(3, 4, 'approved', 'Sudah selesai', 'Ok', NOW(), NOW()),
(15, 2, 'rejected', 'Data kurang lengkap', 'Perbaiki data', NOW(), NOW()),
(8, 4, 'pending', 'Mohon segera diproses', NULL, NOW(), NOW()),
(17, 2, 'approved', 'Sudah selesai', 'Ok', NOW(), NOW()),
(11, 1, 'pending', 'Mohon segera diproses', NULL, NOW(), NOW()),
(10, 5, 'approved', 'Sudah selesai', 'Ok', NOW(), NOW()),
(6, 5, 'approved', 'Sudah selesai', 'Ok', NOW(), NOW()),
(12, 4, 'pending', 'Mohon segera diproses', NULL, NOW(), NOW()),
(4, 4, 'rejected', 'Data kurang lengkap', 'Dokumen salah', NOW(), NOW()),
(21, 3, 'rejected', 'Data kurang lengkap', NULL, NOW(), NOW());