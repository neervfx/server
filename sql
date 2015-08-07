
//Create your data base first and run the following code to create a table with some element
CREATE TABLE mytable
(
    id VARCHAR(30) NOT NULL DEFAULT 'Anonymous' PRIMARY KEY,
    quiz VARCHAR(10) NOT NULL DEFAULT 'Anonymous',
    word VARCHAR(10) NOT NULL DEFAULT 'Anonymous',
    coin VARCHAR(10) NOT NULL DEFAULT ‘Anonymous'
    time VARCHAR(10) NOT NULL DEFAULT 'Anonymous'
)
ENGINE=InnoDB;
