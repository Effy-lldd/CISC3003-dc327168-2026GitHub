-- A.09 Create Database and Table
CREATE DATABASE IF NOT EXISTS cisc3003_scenario_a;
USE cisc3003_scenario_a;

CREATE TABLE IF NOT EXISTS user_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    feedback TEXT NOT NULL,
    gender VARCHAR(20) NOT NULL,
    interests VARCHAR(255) NOT NULL,
    course VARCHAR(50) NOT NULL,
    submission_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);