<?php
require 'lib/autoload.php';

$db = DBFactory::getConnexionWithPDO();
$manager = new PostsManagerPDO($db);
?>

<?php
include 'views/includes/header.php';

if (isset($_GET['id']))
{
    $post = $manager->getUnique((int) $_GET['id']);
    ?>
    <section id="blog-posts">
        <div class="container">
            <div class="row" style="padding-top:20px">
                <div class="col-lg-12">
                    <?php echo '
                    <div class="post">
                            <h1>'.htmlspecialchars($post->title()).'</h1>
                            <p><span class="glyphicon glyphicon-time"></span> Article posté le '.$post->createdAt()->format('d/m/Y à H\hi').' par '.htmlspecialchars($post->author()).'</p>
                            <hr>
                            <p class="lead" style="font-size:28px">Chapô: '.htmlspecialchars($post->subtitle()).'</p>
                            <p>'.htmlspecialchars($post->content()).'</p>
                            <hr>
                            <p style="text-align:right"><a class="btn btn-primary" href="admin.php?modifier='.$post->id().'">Modifier l\'article<span class="glyphicon glyphicon-chevron-right"></span></a></p>
                    </div>';
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}

else
{
    ?>
    <section id="blog-posts">
        <div class="container">
    <?php
    foreach ($manager->getList(0, 5) as $post) {
        if (strlen($post->content()) <= 200) {
            $contenu = $post->content();
        } else {
            $debut = substr($post->content(), 0, 200);
            $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

            $contenu = $debut;
        }
        echo '
            <div class="row" style="padding-top:20px">
                <div class="col-lg-12">
                    <div class="posts" style="margin-bottom:60px">
                            <h1>' . htmlspecialchars($post->title()) . '</h1>
                            <p><span class="glyphicon glyphicon-time"></span> Article posté le ' . $post->updatedAt()->format('d/m/Y à H\hi') . '</p>
                            <hr>
                            <p class="lead">' . htmlspecialchars($post->subtitle()) . '</p>
                            <p style="text-align:right"><a class="btn btn-primary" href="?id=' . $post->id() . '">Voir l\'article<span class="glyphicon glyphicon-chevron-right"></span></a></p>
                            <hr>
                    </div>
                </div>
            </div>';
    }
    ?>
        </div>
    </section>
<?php
}

include 'views/includes/footer.php';
?>