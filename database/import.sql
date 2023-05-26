CREATE DATABASE pim;

USE pim;

CREATE TABLE gebruikers (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(40) NOT NULL,
    lastname varchar(40) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(100) NOT NULL,
    phone varchar(50) NOT NULL,
    type ENUM ('normal', 'admin') NOT NULL,
    picture varchar(255),
    dateofbirth DATE NOT NULL,
    info text NULL
);

CREATE TABLE opdrachten (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL,
    time DATE NOT NULL,
    budget INT NOT NULL,
    title VARCHAR(100),
    html_css BOOLEAN,
    php BOOLEAN,
    javascript BOOLEAN,
    sqls BOOLEAN,
    csharp BOOLEAN,
    cplusplus BOOLEAN,
    python BOOLEAN,
    java BOOLEAN,
    requirments TEXT NOT NULL,
    database_skills BOOLEAN,
    bootstrap BOOLEAN,
    archive BOOLEAN,
    development ENUM ('front-end development', 'back-end development' , 'full-stack development' , 'app development' , 'website development' , 'webshop development') NOT NULL,
    userid int NOT NULL, FOREIGN KEY (userid) REFERENCES gebruikers (id)
);

CREATE TABLE contactbericht(
title VARCHAR(100),
email varchar(100) NOT NULL,
requirments TEXT NOT NULL
);