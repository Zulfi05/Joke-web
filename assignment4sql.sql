DROP TABLE IF EXISTS rating;
DROP TABLE IF EXISTS jokes;
DROP TABLE IF EXISTS userinfo;
CREATE TABLE userinfo (
uid INT NOT NULL AUTO_INCREMENT ,
first_name VARCHAR(255),
last_name VARCHAR(255),
username VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
dob DATE ,
avatar VARCHAR(255) ,
primary key (uid)
);

CREATE TABLE jokes( 
joke_id INT NOT NULL AUTO_INCREMENT,
uid INT,
joke VARCHAR(255) NOT NULL, 
joke_tittle VARCHAR(255) NOT NULL,
post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
avg_rating INT,
primary key (joke_id), 
foreign KEY (uid) references userinfo (uid)
);

CREATE TABLE rating(
rating_id INT NOT NULL AUTO_INCREMENT,
joke_id INT ,
uid INT,
rating INT,
primary key (rating_id),
foreign KEY (joke_id) references jokes (joke_id),
foreign KEY (uid) references userinfo (uid)
);