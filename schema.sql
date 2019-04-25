CREATE DATABASE daily_plan;
USE daily_plan;
CREATE TABLE user
(
    id                INT AUTO_INCREMENT PRIMARY KEY,
    user_name         VARCHAR(500) NOT NULL,
    email             VARCHAR(500) NOT NULL UNIQUE,
    password          VARCHAR(500),
    registration_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE project
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(500),
    user_id  INT
);

CREATE TABLE task
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    title      VARCHAR(500),
    dt_add     DATETIME DEFAULT CURRENT_TIMESTAMP,
    status     INT,
    url_file   VARCHAR(500),
    deadline   DATE,
    user_id    INT,
    project_id INT
);