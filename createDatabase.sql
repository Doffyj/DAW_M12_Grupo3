CREATE DATABASE IF NOT EXISTS users;

USE users;

CREATE TABLE IF NOT EXISTS users(id int primary key auto_increment, name varchar(255), pass varchar(255), user_type tinyint);

INSERT INTO users (name, pass, user_type) VALUES ('admin', 'admin', 0);

INSERT INTO users (name, pass, user_type) VALUES ('user', 'user', 1);