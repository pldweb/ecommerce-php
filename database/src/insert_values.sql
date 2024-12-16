CREATE TABLE matkul(
    kode char(4) primary key not null,
    nama varchar(100) not null
);

CREATE TABLE prodi(
    kode char(4) primary key not null,
    nama varchar(100) not null
);

CREATE TABLE ta(
    kode char(5) primary key not null,
    nama varchar(100) not null
);

CREATE TABLE mahasiswa(
    NIM Char(10) primary key not null,
    Nama varchar(100) not null,
    Kode_matkul char(4) not null,
    Kode_prodi char(4) not null,
    Kode_ta char(5) not null,
    Foreign Key(kode_matkul) REFERENCES matkul(kode),
    Foreign Key(kode_prodi) REFERENCES prodi(kode),
    Foreign Key(kode_ta) REFERENCES ta(kode),
    CONSTRAINT mahasiswa_ta UNIQUE (kode_ta)
);

CREATE TABLE dosen(
    nid char(4) primary key not null,
    nama varchar(100) not null
);

CREATE TABLE pembimbing(
     nid char(4) not null,
     nim char(10) not null,
     Foreign Key(nid) REFERENCES dosen(nid),
     Foreign Key(nim) REFERENCES mahasiswa(nim)
);

INSERT INTO matkul VALUES
     ("M001","Basis Data"),
     ("M002","Data Mining"),
     ("M003","Pemrograman Web");

INSERT INTO prodi VALUES
     ("P001","Sistem Informasi"),
     ("P002","Teknologi Informasi"),
     ("P003","Ilmu Komputer");

INSERT INTO dosen VALUES
     ("D001","Dr.Fauziah"),
     ("D002","Dr.Septi"),
     ("D003","Dr.Ucuk");

INSERT INTO ta VALUES
      ("TA001","Judul 1"),
      ("TA002","Judul 2"),
      ("TA003","Judul 3");

INSERT INTO mahasiswa VALUES
      ("G651170031","Firzatullah","M001","P001","TA001"),
      ("G651170032","Syathir","M001","P001","TA002"),
      ("G651170033","Indry","M002","P003","TA003");

INSERT INTO pembimbing VALUES
      ("D001","G651170031"),
      ("D002","G651170031"),
      ("D003","G651170032"),
      ("D001","G651170032");

