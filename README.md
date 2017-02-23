# oc-blog-poo
This is the public repository of my 5th project on OpenClassrooms. The goal of this project is to create from A to Z a full functional basic blog using PHP in OOP and Bootstrap.
# Installation guide
1- Git clone the repository into your WAMP or MAMP directory.

2- Open MySQL and do the followings :
  - Create a database called "projet5".
  - Create the "posts" table by executing this request :
  
  CREATE TABLE `posts` (
  `id` smallint(5) unsigned NOT NULL,
  `author` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
  
  - Open the file index.php
  - Bazinga !
