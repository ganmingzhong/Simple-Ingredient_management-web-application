CREATE DATABASE ingredient_mgmt;

CREATE TABLE authors(
  Author_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Author_username VARCHAR(255),
  Author_name VARCHAR(255),
  Author_pw VARCHAR(255),
  );

CREATE TABLE ingredient(
  Ing_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Ing_name VARCHAR(255),
  Ing_amount int ,
  Ing_unit VARCHAR(255),
  Ing_type VARCHAR(255),
  Ing_expdate DATE 
  );

INSERT INTO authors(Author_id,Author_username,Author_name,Author_pw)
VALUES(1,"User","John",1234);
