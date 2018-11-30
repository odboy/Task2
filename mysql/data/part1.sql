create database task2_1;

CREATE USER 'task2'@'%' IDENTIFIED BY 'task2pass';
GRANT Create, Delete, Insert, Select, Update ON task2_1.* TO task2@'%';
FLUSH PRIVILEGES;

use task2_1;
create table users (
id int(6) unsigned auto_increment primary key,
name varchar(20) not null,
email varchar(30) not null,
salary int(8) unsigned not null );

INSERT INTO users VALUES(1,'Lucia','Lucia@task.cn',3000);
INSERT INTO users VALUES(2,'Danny','Danny@task.cn',4500);
INSERT INTO users VALUES(3,'Alina','Alina@task.cn',2700);
INSERT INTO users VALUES(4,'Jameson','Jameson@task.cn',10000);
INSERT INTO users VALUES(5,'Allie','Allie@task.cn',6000);

create table flag(flag varchar(100) not null);
INSERT INTO flag VALUES('flag{task2.1-WellDone}');

