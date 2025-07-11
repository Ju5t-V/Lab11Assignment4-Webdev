CREATE DATABASE IF NOT EXISTS expenditure_db;
USE expenditure_db;
CREATE TABLE IF NOT EXISTS expenditures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50),
    amount FLOAT,
    date DATE
);