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
            $nb_posts = $manager->count();
            if($nb_posts > 0){
                $limit = 5;
                $nb_pages = ceil($nb_posts / $limit);
                $page = min($nb_pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                    'options' => array(
                        'default' => 1,
                        'min_range' => 1,
                        ),
                    )));
                $offset = ($page - 1) * $limit;
                $start = $offset + 1;
                $end = min(($offset + $limit), $nb_posts);
                $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
                $nextlink = ($page < $nb_pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $nb_pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
                foreach ($manager->getList($offset, $limit) as $post) {
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
                echo '
                <div id="paging">
                    <p>', $prevlink, ' Page ', $page, ' sur ', $nb_pages, ' ', $nextlink, '</p>
                </div>';
            } else {
                echo '<h1>Aucun article pour le moment</h1>';
            }
            ?>
        </div>
    </section>
<?php
}

include 'views/includes/footer.php';
?>