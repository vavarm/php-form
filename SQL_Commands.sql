CREATE TABLE `user` (
    userId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    userName varchar(128) NOT NULL,
    userEmail varchar(128) NOT NULL,
    userUid varchar(128) NOT NULL,
    userPwd varchar(128) NOT NULL
);