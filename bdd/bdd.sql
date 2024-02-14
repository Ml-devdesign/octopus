CREATE DATABASE IF NOT EXISTS bdshop; 
USE bdshop;

-- Table admin (admin)
CREATE TABLE IF NOT EXISTS table_admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_login VARCHAR(50),
    admin_password VARCHAR(255),
    admin_name VARCHAR(255)
);

-- Table auteur (auteur)
CREATE TABLE IF NOT EXISTS table_autor (
    autor_ID INT AUTO_INCREMENT PRIMARY KEY,
    autor_firstName VARCHAR(50),
    autor_lastName VARCHAR(50),
    autor_country VARCHAR(50),
    autor_image VARCHAR(255), 
    autor_description VARCHAR(50)
);

-- Table category
CREATE TABLE IF NOT EXISTS table_category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_title VARCHAR(50),
    category_image VARCHAR(255),
    category_description TEXT
);

-- Table type
CREATE TABLE IF NOT EXISTS table_type (
    table_type_ID INT AUTO_INCREMENT PRIMARY KEY,
    table_type_designation TEXT(150),
    table_type_illustration VARCHAR(255), 
    table_type_description TEXT(150)
);

-- Table book (bd)
CREATE TABLE IF NOT EXISTS table_book (
    book_ID INT AUTO_INCREMENT PRIMARY KEY,
    book_isbn VARCHAR(20) UNIQUE,
    book_title VARCHAR(255),
    book_resume TEXT,
    book_publisher VARCHAR(50),
    book_date DATE,
    book_cartoonist VARCHAR(50),
    book_image VARCHAR(255),
    book_description VARCHAR(50),
    book_price DECIMAL(6,2),
    book_type_id INT
);

-- Table customer (client)
CREATE TABLE IF NOT EXISTS table_customer (
    customer_ID INT AUTO_INCREMENT PRIMARY KEY,
    customer_slug VARCHAR(64),-- Slug et le nom ou autre generer par le client 
    customer_Lname VARCHAR(50),
    customer_fname VARCHAR(50),
    customer_email VARCHAR(100) UNIQUE,
    customer_password VARCHAR(64) DEFAULT NULL,
    customer_address VARCHAR(100) UNIQUE,
    customer_zip INT,
    customer_city VARCHAR(50),
    customer_phone VARCHAR(50),
    subscription_description_date DATE,
    customer_subscription_ID INT
);

-- Table sale (client_bd)
CREATE TABLE IF NOT EXISTS table_sale (
    table_sale_ID INT AUTO_INCREMENT PRIMARY KEY,
    table_sale_date DATE,
    table_sale_time TIME,
    table_sale_book_id VARCHAR(255),
    table_sale_customer_id INT,
    table_sale_quantity VARCHAR(255)
);

-- Table subscription (abonnement)
CREATE TABLE IF NOT EXISTS table_subscription (
    subscription_ID INT AUTO_INCREMENT PRIMARY KEY,
    subscription_designation VARCHAR(255),
    subscription_price DECIMAL(6,2),
    subscription_description VARCHAR(50)
);

-- Table book_category (genre_bd)
CREATE TABLE IF NOT EXISTS table_book_category (
    book_category_id INT AUTO_INCREMENT PRIMARY KEY,
    book_category_book VARCHAR(50),
    book_category_category_id INT
);

-- Table book_author (auteur_client)
CREATE TABLE IF NOT EXISTS table_book_author (
    book_author_ID INT AUTO_INCREMENT PRIMARY KEY,
    book_author_book_id INT,
    book_author_author_ID INT
);