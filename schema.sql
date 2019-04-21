
USE daily_plan;
CREATE TABLE user (
id                 INT AUTO_INCREMENT PRIMARY KEY,
user_name          CHAR(64) NOT NULL UNIQUE,
email              CHAR(128) NOT NULL UNIQUE,
password           CHAR(64) UNIQUE,
registration_date  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE project (
id       INT AUTO_INCREMENT PRIMARY KEY,
category CHAR(32),
user_id  INT
);

CREATE TABLE task (
id         INT AUTO_INCREMENT PRIMARY KEY,
title      CHAR(64),
dt_add     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
status     INT,
url_file   CHAR(128),
deadline   TIMESTAMP,
user_id    INT,
project_id INT
);