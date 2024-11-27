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