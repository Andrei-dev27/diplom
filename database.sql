CREATE DATABASE microblog;

CREATE TABLE roles(
id INT AUTO_INCREMENT PRIMARY KEY,
role_name varchar(40) NOT NULL
);

CREATE TABLE users(
id INT AUTO_INCREMENT PRIMARY KEY,
user_name varchar(60) NOT NULL,
pass varchar(60) NOT NULL,
user_image varchar(100) NOT NULL DEFAULT 'img/avatars/avatar_user.jpg',
role_id INT NOT NULL,
FOREIGN KEY(role_id) REFERENCES roles(id)
);

CREATE TABLE categories(
id INT AUTO_INCREMENT PRIMARY KEY,
categorie_name varchar(40) NOT NULL
);

CREATE TABLE posts(
id INT AUTO_INCREMENT PRIMARY KEY,
categorie_id INT NOT NULL,
FOREIGN KEY(categorie_id) REFERENCES categories(id),
user_id INT NOT NULL,
FOREIGN KEY(user_id) REFERENCES users(id),
post_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
post_message varchar(300) NOT NULL,
link varchar(100) NOT NULL,
post_image varchar(100) NOT NULL DEFAULT 'img/velocity.png'
);

CREATE TABLE comments(
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
FOREIGN KEY(user_id) REFERENCES users(id),
post_id INT NOT NULL,
FOREIGN KEY(post_id) REFERENCES posts(id),
comment_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
comment_text varchar(500) NOT NULL
);

CREATE TABLE likes(
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
FOREIGN KEY(user_id) REFERENCES users(id),
post_id INT NOT NULL,
FOREIGN KEY(post_id) REFERENCES posts(id)
);