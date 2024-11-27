CREATE TABLE role (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255),
    alamat TEXT,
    nomor_telp VARCHAR(15),
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES role(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kategori_produk
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama VARCHAR(100),
    parent_id INT DEFAULT NULL,
    FOREIGN KEY (parent_id) REFERENCES kategori_produk (id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE brand_produk
(
    id         INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama       VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE produk
(
    id          INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama        VARCHAR(100),
    brand_id    INT       DEFAULT NULL,
    kategori_id INT       DEFAULT NULL,
    harga       VARCHAR(255),
    diskon      VARCHAR(15),
    stok        INTEGER,
    deskripsi   TEXT,
    foto        VARCHAR(255),
    FOREIGN KEY (brand_id) REFERENCES brand_produk (id),
    FOREIGN KEY (kategori_id) REFERENCES kategori_produk (id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE transaksi(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    user_id INT DEFAULT NULL,
    ongkir VARCHAR(255),
    total VARCHAR(255),
    status VARCHAR(255),
    foreign key (user_id) references user(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE detail_transaksi
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    transaksi_id INT DEFAULT NULL,
    produk_id INT DEFAULT NULL,
    harga_produk VARCHAR(255) DEFAULT NULL,
    foreign key (produk_id) references produk(id),
    foreign key (transaksi_id) references transaksi(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);