# oc-blog-poo
This is the public repository of my 5th project on OpenClassrooms. The goal of this project is to create from A to Z a full functional basic blog using PHP in OOP and Bootstrap.
# Installation guide
## 1. Git clone the repository into your WAMP or MAMP directory

## 2. Create a database
E.g "blog".

## 3. Update the file lib/DBFactory.php.dist with your database credentials

    $db = new PDO('mysql:host=HOST;dbname=NAME', 'USER', 'PASSWORD');

Don't forget to delete the .dist
## 4. Create the "posts" table

  CREATE TABLE `posts` (
  `id` smallint(5) unsigned NOT NULL,
  `author` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

  ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `posts`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;

## 5. Download the vendors
Avec Composer :

    php composer.phar install
    
## 6. Create some fake articles
Go to /blog.php and click on the link "Créer 10 articles de démo". It will create 10 fake articles.

## 7. Bazinga !