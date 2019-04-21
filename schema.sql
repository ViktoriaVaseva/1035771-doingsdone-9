CREATE DATABASE daily_plan;

CREATE TABLE user (
id       INT AUTO_INCREMENT PRIMARY KEY,
name     char(64) NOT NULL UNIQUE,
email    CHAR(128) NOT NULL UNIQUE,
password CHAR(64) UNIQUE,
date     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE project (
id       INT AUTO_INCREMENT PRIMARY KEY,
category CHAR(32),
user_id  INT
);

CREATE TABLE task (
id         INT AUTO_INCREMENT PRIMARY KEY,
name       CHAR(64),
dt_add     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
status     INT,
fail       CHAR(256),
valid      TIMESTAMP,
user_id    INT,
project_id INT
);