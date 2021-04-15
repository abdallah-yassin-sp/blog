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
    article_id INT(10) NOT NULL,
    user_id INT(10) NOT NULL
)

--Add categories
INSERT INTO categories (cat_name) VALUES ("architecture");
INSERT INTO categories (cat_name) VALUES ("art-and-illustration");
INSERT INTO categories (cat_name) VALUES ("business-and-corporate");
INSERT INTO categories (cat_name) VALUES ("culture-and-Education");
INSERT INTO categories (cat_name) VALUES ("e-commerce");
INSERT INTO categories (cat_name) VALUES ("design-agencies");