# oc-blog-poo
This is the public repository of my 5th project on OpenClassrooms. The goal of this project is to create from A to Z a full functional basic blog using PHP in OOP and Bootstrap.
# Installation guide
1- Git clone the repository into your WAMP or MAMP directory.

2- Create a database.

3- Update the file lib/DBFactory.php with your database credentials.

4- Create the "posts" table by executing this request :
  
  CREATE TABLE `posts` (
  `id` smallint(5) unsigned NOT NULL,
  `author` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

  - Then populate the table by adding some fake data with this request :

  INSERT INTO `posts` (`id`, `author`, `title`, `subtitle`, `content`, `createdAt`, `updatedAt`) VALUES
  (1, 'Quentin L''eilde', 'Lorem Ipsum Titre 1', 'Lorem Ipsum Sous Titre 1', 'Laboriosam consequatur saepe veritatis enim doloribus voluptatem expedita. Deleniti saepe deleniti quae voluptas nihil. Dolor quis quidem consequatur architecto eos dolorem. Quaerat fugit qui exercitationem corporis. Mollitia expedita pariatur eius non temporibus consectetur.', '2017-03-08 16:36:17', '2017-03-08 16:36:17'),
  (2, 'Quentin L''eilde', 'Lorem Ipsum Titre 2', 'Lorem Ipsum Sous Titre 2', 'Laboriosam consequatur saepe veritatis enim doloribus voluptatem expedita. Deleniti saepe deleniti quae voluptas nihil. Dolor quis quidem consequatur architecto eos dolorem. Quaerat fugit qui exercitationem corporis. Mollitia expedita pariatur eius non temporibus consectetur.', '2017-03-08 16:36:17', '2017-03-08 16:36:17'),
  (3, 'Quentin L''eilde', 'Lorem Ipsum Titre 3', 'Lorem Ipsum Sous Titre 3', 'Laboriosam consequatur saepe veritatis enim doloribus voluptatem expedita. Deleniti saepe deleniti quae voluptas nihil. Dolor quis quidem consequatur architecto eos dolorem. Quaerat fugit qui exercitationem corporis. Mollitia expedita pariatur eius non temporibus consectetur.', '2017-03-08 16:36:17', '2017-03-08 16:36:17'),
  (4, 'Quentin L''eilde', 'Lorem Ipsum Titre 4', 'Lorem Ipsum Sous Titre 4', 'Laboriosam consequatur saepe veritatis enim doloribus voluptatem expedita. Deleniti saepe deleniti quae voluptas nihil. Dolor quis quidem consequatur architecto eos dolorem. Quaerat fugit qui exercitationem corporis. Mollitia expedita pariatur eius non temporibus consectetur.', '2017-03-08 16:36:17', '2017-03-08 16:36:17'),
  (5, 'Quentin L''eilde', 'Lorem Ipsum Titre 5', 'Lorem Ipsum Sous Titre 5', 'Laboriosam consequatur saepe veritatis enim doloribus voluptatem expedita. Deleniti saepe deleniti quae voluptas nihil. Dolor quis quidem consequatur architecto eos dolorem. Quaerat fugit qui exercitationem corporis. Mollitia expedita pariatur eius non temporibus consectetur.', '2017-03-08 16:36:17', '2017-03-08 16:36:17'),
  (6, 'Quentin L''eilde', 'Lorem Ipsum Titre 6', 'Lorem Ipsum Sous Titre 6', 'Laboriosam consequatur saepe veritatis enim doloribus voluptatem expedita. Deleniti saepe deleniti quae voluptas nihil. Dolor quis quidem consequatur architecto eos dolorem. Quaerat fugit qui exercitationem corporis. Mollitia expedita pariatur eius non temporibus consectetur.', '2017-03-08 16:36:17', '2017-03-08 16:36:17');
  
  - Open the file index.php
  - Bazinga !
