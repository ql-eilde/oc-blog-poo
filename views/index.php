<?php
require '../lib/autoload.php';

$db = DBFactory::getConnexionWithPDO();
$manager = new PostsManagerPDO($db);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil du site</title>
    <meta charset="utf-8" />
</head>

<body>
<p><a href="admin.php">Accéder à l'espace d'administration</a></p>
<?php
if (isset($_GET['id']))
{
    $post = $manager->getUnique((int) $_GET['id']);

    echo '<p>Par <em>', $post->author(), '</em>, le ', $post->createdAt()->format('d/m/Y à H\hi'), '</p>', "\n",
    '<h2>', $post->title(), '</h2>', "\n",
    '<h3>', $post->subtitle(), '</h3>', "\n",
    '<p>', nl2br($post->content()), '</p>', "\n";

    if ($post->createdAt() != $post->updatedAt())
    {
        echo '<p style="text-align: right;"><small><em>Modifiée le ', $post->updatedAt()->format('d/m/Y à H\hi'), '</em></small></p>';
    }
}

else
{
    echo '<h2 style="text-align:center">Liste des 5 derniers posts</h2>';

    foreach ($manager->getList(0, 5) as $post)
    {
        if (strlen($post->content()) <= 200)
        {
            $contenu = $post->content();
        }

        else
        {
            $debut = substr($post->content(), 0, 200);
            $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

            $contenu = $debut;
        }

        echo '<h4><a href="?id=', $post->id(), '">', $post->title(), '</a></h4>', "\n",
        '<p>', nl2br($contenu), '</p>';
    }
}
?>
</body>
</html>