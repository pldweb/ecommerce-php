CREATE TABLE mitra (
    id_mitra CHARACTER(50) NOT NULL PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat VARCHAR(100) NOT NULL,
    contact VARCHAR(50) NOT NULL,
    jenis VARCHAR(100) NOT NULL,
    jumlah_aset int(50) NOT NULL,
    tanggal_pendirian date NOT NULL
);