CREATE DATABASE daily_plan;
USE daily_plan;
CREATE TABLE users
(
    id                INT AUTO_INCREMENT PRIMARY KEY,
    user_name         VARCHAR(128) NOT NULL,
    email             VARCHAR(64) NOT NULL UNIQUE,
    password          VARCHAR(128),
    registration_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE project
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(128),
    users_id  INT
);

CREATE TABLE task
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    title      VARCHAR(255),
    dt_add     DATETIME DEFAULT CURRENT_TIMESTAMP,
    status     INT,
    url_file   VARCHAR(500),
    deadline   DATE,
    users_id    INT,
    project_id INT,
    FULLTEXT (title)
);

CREATE FULLTEXT INDEX title ON task(title)