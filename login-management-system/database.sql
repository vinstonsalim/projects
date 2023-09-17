CREATE DATABASE php_login_management;

CREATE DATABASE php_login_management_test;

CREATE TABLE users (
    id VARCHAR(255) primary key,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) engine InnoDB;

CREATE TABLE sessions (
    id VARCHAR(255) primary key,
    user_id VARCHAR(255) NOT NULL
) engine InnoDB;


ALTER TABLE sessions
ADD CONSTRAINT fk_session_user
    FOREIGN KEY (user_id)
        REFERENCES users(id)
     ON DELETE CASCADE
     ON UPDATE CASCADE;
