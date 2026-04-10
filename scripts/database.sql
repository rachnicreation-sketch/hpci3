-- Migration Database for HPCI-SARL CMS
CREATE DATABASE IF NOT EXISTS hpci_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hpci_db;

-- Table des administrateurs
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des actualités
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255),
    category VARCHAR(50),
    published_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table de la médiathèque
CREATE TABLE IF NOT EXISTS media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    file_url VARCHAR(255) NOT NULL,
    type ENUM('image', 'video') DEFAULT 'image',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des offres d'emploi
CREATE TABLE IF NOT EXISTS jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(255) NOT NULL,
    location VARCHAR(100),
    description TEXT,
    deadline DATE,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des paramètres (Maintenance, etc.)
CREATE TABLE IF NOT EXISTS settings (
    setting_key VARCHAR(50) PRIMARY KEY,
    setting_value TEXT
);

-- Insertion de l'admin par défaut (admin / admin1234 - à changer en prod)
-- Note : En PHP on utilisera password_hash
INSERT INTO admins (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); -- password: password

-- Paramètre de maintenance par défaut
INSERT INTO settings (setting_key, setting_value) VALUES ('maintenance_mode', 'off');
INSERT INTO settings (setting_key, setting_value) VALUES ('maintenance_message', 'Nous sommes actuellement en maintenance. Nous revenons très bientôt !');
