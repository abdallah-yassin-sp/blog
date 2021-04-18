-- craete Users table
CREATE TABLE users (
    user_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)

--create Articles table
CREATE TABLE articles (
    article_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    body VARCHAR(250) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id INT(10),
    cat_name VARCHAR(50) NOT NULL,
    comment_id INT(10)
)

--create Categories table
CREATE TABLE categories (
    category_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cat_name VARCHAR(50) NOT NULL
)

--create Comments table
CREATE TABLE comments (
    comment_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    body VARCHAR(250) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    article_id INT(10) NOT NULL
)

--Add default user
INSERT INTO users (first_name, last_name, email, password) VALUES ("admin", "admin", "admin@blog.com", "12345");

--Add categories
INSERT INTO categories (cat_name) VALUES ("architecture");
INSERT INTO categories (cat_name) VALUES ("art-and-illustration");
INSERT INTO categories (cat_name) VALUES ("business-and-corporate");
INSERT INTO categories (cat_name) VALUES ("culture-and-education");
INSERT INTO categories (cat_name) VALUES ("e-commerce");
INSERT INTO categories (cat_name) VALUES ("design-agencies");

--Add some articles
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_1", "article_1_body", "1", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_2", "article_2_body", "1", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_3", "article_3_body", "2", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_4", "article_4_body", "2", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_5", "article_5_body", "3", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_6", "article_6_body", "3", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_7", "article_7_body", "4", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_8", "article_8_body", "4", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_9", "article_9_body", "5", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_10", "article_10_body", "5", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_11", "article_11_body", "6", "1");
Insert INTO articles (title, body, cat_id, user_id) VALUES ("article_12", "article_12_body", "6", "1");