use twitter_track;

CREATE TABLE IF NOT EXISTS twitter_user (
         id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
         username VARCHAR(40) NOT NULL UNIQUE,
         description VARCHAR(200)
       ) TYPE=innodb;
       
CREATE TABLE IF NOT EXISTS tweet (
         id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
         tweet_id_str VARCHAR(40) NOT NULL UNIQUE,
         text VARCHAR(400),
         created_at TIMESTAMP,
         twitter_user_id INT,
         FOREIGN KEY(twitter_user_id) REFERENCES twitter_user(id) ON UPDATE CASCADE 
         	ON DELETE SET NULL
       ) TYPE=innodb;
