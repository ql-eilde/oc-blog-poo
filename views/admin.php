<?php
require '../lib/autoload.php';

$db = DBFactory::getConnexionWithPDO();
$manager = new PostsManagerPDO($db);

if (isset($_GET['modifier']))
{
    $post = $manager->getUnique((int) $_GET['modifier']);
}

if (isset($_GET['supprimer']))
{
    $manager->delete((int) $_GET['supprimer']);
    $message = 'Le post a bien été supprimée !';
}

if (isset($_POST['auteur']))
{
    $post = new Posts(
        [
            'author' => $_POST['auteur'],
            'title' => $_POST['titre'],
            'subtitle' => $_POST['sous-titre'],
            'content' => $_POST['contenu']
        ]
    );

    if (isset($_POST['id']))
    {
        $post->setId($_POST['id']);
    }

    if ($post->isValid())
    {
        $manager->save($post);

        $message = $post->isNew() ? 'Le post a bien été ajouté !' : 'Le post a bien été modifié !';
    }
    else
    {
        $erreurs = $post->erreurs();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administration</title>
    <meta charset="utf-8" />

    <style type="text/css">
        table, td {
            border: 1px solid black;
        }

        table {
            margin:auto;
            text-align: center;
            border-collapse: collapse;
        }

        td {
            padding: 3px;
        }
    </style>
</head>

<body>
<p><a href=".">Accéder à l'accueil du site</a></p>

<form action="admin.php" method="post">
    <p style="text-align: center">
        <?php
        if (isset($message))
        {
            echo $message, '<br />';
        }
        ?>
        <?php if (isset($erreurs) && in_array(Posts::INVALID_AUTHOR, $erreurs)) echo 'L\'auteur est invalide.<br />'; ?>
        Auteur : <input type="text" name="auteur" value="<?php if (isset($post)) echo $post->author(); ?>" /><br />

        <?php if (isset($erreurs) && in_array(Posts::INVALID_TITLE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
        Titre : <input type="text" name="titre" value="<?php if (isset($post)) echo $post->title(); ?>" /><br />

        <?php if (isset($erreurs) && in_array(Posts::INVALID_SUBTITLE, $erreurs)) echo 'Le sous-titre est invalide.<br />'; ?>
        Sous-Titre : <input type="text" name="sous-titre" value="<?php if (isset($post)) echo $post->subtitle(); ?>" /><br />

        <?php if (isset($erreurs) && in_array(Posts::INVALID_CONTENT, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
        Contenu :<br /><textarea rows="8" cols="60" name="contenu"><?php if (isset($post)) echo $post->content(); ?></textarea><br />
        <?php
        if(isset($post) && !$post->isNew())
        {
            ?>
            <input type="hidden" name="id" value="<?= $post->id() ?>" />
            <input type="submit" value="Modifier" name="modifier" />
            <?php
        }
        else
        {
            ?>
            <input type="submit" value="Ajouter" />
            <?php
        }
        ?>
    </p>
</form>

<p style="text-align: center">Il y a actuellement <?= $manager->count() ?> posts. En voici la liste :</p>

<table>
    <tr><th>Auteur</th><th>Titre</th><th>Sous-Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
    <?php
    foreach ($manager->getList() as $post)
    {
        echo '<tr><td>', $post->author(), '</td><td>', $post->title(), '</td><td>', $post->subtitle(), '</td><td>', $post->createdAt()->format('d/m/Y à H\hi'), '</td><td>', ($post->createdAt() == $post->updatedAt() ? '-' : $post->updatedAt()->format('d/m/Y à H\hi')), '</td><td><a href="?modifier=', $post->id(), '">Modifier</a> | <a href="?supprimer=', $post->id(), '">Supprimer</a></td></tr>', "\n";
    }
    ?>
</table>
</body>
</html>