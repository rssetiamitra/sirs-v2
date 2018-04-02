/*
SQLyog Professional v12.4.1 (64 bit)
MySQL - 10.1.21-MariaDB 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `tmp_user_profile` (
	`up_id` int (11),
	`fullname` varchar (765),
	`pob` varchar (165),
	`dob` date ,
	`address` text ,
	`no_telp` varchar (45),
	`no_hp` varchar (45),
	`gender` char (3),
	`about_me` text ,
	`path_foto` varchar (765),
	`user_id` int (11)
); 
insert into `tmp_user_profile` (`up_id`, `fullname`, `pob`, `dob`, `address`, `no_telp`, `no_hp`, `gender`, `about_me`, `path_foto`, `user_id`) values('1','Muhammad Amin Lubis','Tangerang','1990-11-23','Jl. Kerinci Blok E 36 No 10 Pondok Indah Kutabumi Tangerang',NULL,'085819655296','L','Bermimpilah setinggi langit, jika kau terjauth, maka kau akan terjatuh diantara bintang - bintang. Ir. Soekarno <br>\r\nBerani hidup tak takut mati, takut mati jangan hidup, takut hidup mati saja. KH. Imam Zarkasyi',NULL,'1');
