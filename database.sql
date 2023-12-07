-- Tabel Guru
CREATE TABLE IF NOT EXISTS guru (
    id_guru INT PRIMARY KEY AUTO_INCREMENT,
    nama_guru VARCHAR(255),
    mata_pelajaran VARCHAR(255),
    data_kontak VARCHAR(255)
);

-- Tabel Siswa
CREATE TABLE IF NOT EXISTS siswa (
    id_siswa INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255),
    usia INT,
    alamat VARCHAR(255),
    data_kontak VARCHAR(255),
    riwayat_belajar TEXT
);

-- Tabel Jadwal_Bimbingan
CREATE TABLE IF NOT EXISTS jadwal_bimbingan (
    id_jadwal INT PRIMARY KEY AUTO_INCREMENT,
    id_siswa INT,
    id_guru INT,
    mata_pelajaran VARCHAR(255),
    tanggal DATE,
    waktu TIME,
    status VARCHAR(50),
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa),
    FOREIGN KEY (id_guru) REFERENCES guru(id_guru)
);

-- Tabel Materi_Pelajaran
CREATE TABLE IF NOT EXISTS materi_pelajaran (
    id_materi INT PRIMARY KEY AUTO_INCREMENT,
    mata_pelajaran VARCHAR(255),
    tingkat_kelas VARCHAR(50),
    sumber_belajar VARCHAR(50)
);

-- Tabel Komunikasi_Pesan
CREATE TABLE IF NOT EXISTS komunikasi_pesan (
    id_pesan INT PRIMARY KEY AUTO_INCREMENT,
    id_sender INT,
    id_receiver INT,
    isi_pesan TEXT,
    waktu_kirim DATETIME,
    status_pesan VARCHAR(50),
    FOREIGN KEY (id_sender) REFERENCES guru(id_guru),
    FOREIGN KEY (id_receiver) REFERENCES siswa(id_siswa)
);

-- Tabel Dashboard_Statistik
CREATE TABLE IF NOT EXISTS dashboard_statistik (
    id_statistik INT PRIMARY KEY AUTO_INCREMENT,
    jumlah_siswa INT,
    jumlah_jadwal_bimbingan INT,
    kinerja_guru INT
);

-- Tabel Laporan
CREATE TABLE IF NOT EXISTS laporan (
    id_laporan INT PRIMARY KEY AUTO_INCREMENT,
    id_siswa INT,
    jenis_laporan VARCHAR(255),
    isi_laporan TEXT,
    waktu_pelaporan DATETIME,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa)
);
