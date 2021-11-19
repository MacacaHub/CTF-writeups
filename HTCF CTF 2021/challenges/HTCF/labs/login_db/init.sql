USE usersdb;

DROP TABLE IF EXISTS Users;

CREATE TABLE Users(
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL
);

INSERT INTO Users (username, password) VALUES ('guest', 'guest');
INSERT INTO Users (username, password) VALUES ('admin', '8k13@1laOHga');

