<?php
require 'lib/autoload.php';
require 'lib/csrf.php';

session_start();
$db = DBFactory::getConnexionWithPDO();
$manager = new PostsManagerPDO($db);

if (isset($_GET['modifier']))
{
    $post = $manager->getUnique((int) $_GET['modifier']);
}

if (isset($_POST['auteur']) && check_token())
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
$token = generate_token();
?>

<?php
include 'views/includes/header.php';
?>
<section id="form">
    <div class="container">
        <div class="row" style="padding-top:20px">
            <div class="col-lg-12">
                <form action="admin.php" method="post">
                    <p style="text-align: center">
                        <?php
                        if (isset($message))
                        {
                            echo $message, '<br />';
                        }
                        ?>
                    </p>    
                    <?php if (isset($erreurs) && in_array(Posts::INVALID_AUTHOR, $erreurs)) echo 'L\'auteur est invalide.<br />'; ?>
                    <div class="form-group">
                        <label for="author">Auteur :</label>
                        <input type="text" name="auteur" class="form-control" value="<?php if (isset($post)) echo $post->author(); ?>" <?php if (!isset($_GET['modifier'])) echo 'required'; ?>/>
                    </div>

                    <?php if (isset($erreurs) && in_array(Posts::INVALID_TITLE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
                    <div class="form-group">
                        <label for="title">Titre :</label>
                        <input type="text" name="titre" class="form-control" value="<?php if (isset($post)) echo $post->title(); ?>" <?php if (!isset($_GET['modifier'])) echo 'required'; ?>/>
                    </div>

                    <?php if (isset($erreurs) && in_array(Posts::INVALID_SUBTITLE, $erreurs)) echo 'Le sous-titre est invalide.<br />'; ?>
                    <div class="form-group">
                        <label for="subtitle">Sous-titre :</label>
                        <input type="text" name="sous-titre" class="form-control" value="<?php if (isset($post)) echo $post->subtitle(); ?>" />
                    </div>

                    <?php if (isset($erreurs) && in_array(Posts::INVALID_CONTENT, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
                    <div class="form-group">
                        <label for="content">Contenu :</label>
                        <textarea rows="8" cols="60" class="form-control" name="contenu" <?php if (!isset($_GET['modifier'])) echo 'required'; ?>><?php if (isset($post)) echo $post->content(); ?></textarea>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
                    <?php
                    if(isset($post) && !$post->isNew())
                    {
                        ?>
                        <input type="hidden" name="id" value="<?= $post->id() ?>" />
                        <div class="button">
                            <button type="submit" class="btn btn-default">Modifier</button>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="button">
                            <button type="submit" class="btn btn-default">Ajouter</button>
                        </div>
                        <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include 'views/includes/footer.php';
?>