-- Create the database
CREATE DATABASE ecommerce;

-- Use the database
USE ecommerce;

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,       -- Unique ID for each user
    first_name VARCHAR(50) NOT NULL,         -- User's first name
    last_name VARCHAR(50) NOT NULL,          -- User's last name
    email VARCHAR(100) NOT NULL UNIQUE,      -- User's email, must be unique
    password VARCHAR(255) NOT NULL           -- User's hashed password
);