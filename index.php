<?php
session_start();
include 'views/includes/header.php';

?>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if (isset($_SESSION['emailsent'])){
                        echo '<div class="alert alert-success" role="alert">', $_SESSION['emailsent'], '</div>';
                        unset($_SESSION['emailsent']);
                    }
                    elseif (isset($_SESSION['emailnotsent'])){
                        echo '<div class="alert alert-danger" role="alert">', $_SESSION['emailnotsent'], '</div>';
                        unset($_SESSION['emailnotsent']);
                    }
                    ?>
                    <img class="img-responsive" src="views/libraries/img/profile.png" alt="">
                    <div class="intro-text">
                        <span class="name">Quentin L'eilde</span>
                        <hr class="star-light-1">
                        <span class="skills">Développeur Web - Au service de vos innovations.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Mon CV</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>Si vous êtes intéressé par mon profil, je vous invite à télécharger mon CV disponible ci-dessous.</p>
                </div>
                <div class="col-lg-4">
                    <p>Je suis ouvert à toutes vos propositions, spécialement si elles comportent des problématiques liées au PHP.</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="views/libraries/pdf/cv.pdf" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Télécharger mon CV
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contactez moi</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form action="contact.php" method="post">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Nom et Prénom</label>
                                <input type="text" class="form-control" placeholder="Nom et Prénom" name="name" required data-validation-required-message="Saisissez votre nom et prénom svp.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Adresse email</label>
                                <input type="email" class="form-control" placeholder="Adresse email" name="email" required data-validation-required-message="Saisissez votre adresse email svp.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" name="message" required data-validation-required-message="Saisissez votre message svp."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php
include 'views/includes/footer.php';

?>