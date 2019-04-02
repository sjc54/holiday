CREATE DATABASE holi_day;

use holi_day;

CREATE TABLE works (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	location VARCHAR(30) NOT NULL,
	activity VARCHAR(50) NOT NULL,
	time VARCHAR(30),
    expenses VARCHAR(30),
	date TIMESTAMP
);