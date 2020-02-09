<?php
    // require && uses
    require 'Models/DAO/FormContactManager.php';
    use App\Models\DAO\FormContactManager;
    require 'Models/DAO/SendMailManager.php';
    use App\Models\DAO\SendMailManager;

    /**
     * everything is in 'Models/DAO' for functions/actions && 'Models/DTO' for getters/setters
     */
    $formContact = New FormContactManager();
    if($formContact->isFormContactSent()){
        if($formContact->isFormContactVerified()){
            // protected htmlspecialchars in App\Models\DAO\SendMailManager.php
            $newMail = New SendMailManager(
                $formContact->getName(),
                $formContact->getEmail(),
                $formContact->getSubject(),
                $formContact->getTextarea()
            );
            $newMail->sendMail();
            $formContact->cleanForm();
        }
    }
?>
<?php require 'part/header.php' ?>
    <section>
        <h2>TRAVAILLONS ENSEMBLE À LA RÉALISATION DE VOTRE PROJET</h2>
            <p>Ancien militaire reconverti dans le développement web, je suis spécialisé dans le développement de sites personnalisés et adaptés aux besoins des indépendants, start-up, TPE et PME, je vous apporte de la visibilité sur internet et une intégration au monde du Web en toute sérénité !</p>
            <h3>DÉVELOPPEMENT</h3>
            <p>Grâce à la visibilité offerte par votre site web, développez votre chiffre d'affaire et votre clientèle en toute simplicité.</p>
            <h3>SÉCURITÉ ET SÉRÉNITÉ</h3>
            <p>Tous les projets réalisés sont sécurisés en https et protégés contre la majorité des attaques ou des piratages, communiquez l'esprit tranquille.</p>
            <h3>SUIVI SUR LE LONG TERME</h3>
            <p>Economisez votre temps en profitant d'un suivi personnalisé de votre site : maintenance, entretien et mises à jours, je vous accompagne !</p>
    </section>
    <div class="background-img01"></div>
    <section>
        <h2>RÉALISATION D'UN DEVIS</h2>
            <p>Ensemble, nous réalisons votre devis personnalisé et adapté à votre situation et à vos besoins.</p>
            <h3>CONCEPTION</h3>
            <p>Le site est ensuite minutieusement construit ligne par ligne pour qu'il vous ressemble vraiment.</p>
            <h3>LIVRAISON</h3>
            <p>Le site vous est livré et présenté en détail pour que vous puissiez comprendre son fonctionnement</p>
            <h3>FORMATION</h3>
            <p>Directement dans vos locaux, je vous forme ainsi que vos collaborateurs à la prise en main de votre site et à l'ajout de contenu.</p>
            <h3>RESPONSIVE DESIGN</h3>
            <p>Le contenu créé spécialement pour votre site est adapté à tous les terminaux, vos visiteurs peuvent naviguer avec leur appareil préféré.</p>
    </section>
    <div class="background-img02"><div class="separateur"></div></div>
    <section>
        <h2>PRISE DE CONTACT</h2>
            <h3>Travaillons ensemble</h3>
            <p>
                Remplissez le formulaire de contact, je vous recontacte ensuite sous 24h.
                On se rencontre dans votre établissement ou dans le lieu de votre choix
            </p>
        <form id="form-contact" action="index.php#form-contact" method="POST">
            <fieldset><legend>Formulaire de contact</legend>
                <?php
                    if(isset($formContact)):
                        // must be destroy
                        //var_dump($_POST);
                        foreach($formContact->getErrors() as $error):
                        ?>
                            <div class="form-row errors">
                                <?= $error ?>
                            </div>
                        <?php
                        endforeach;
                    endif;
                ?>
                <?php
                    if(isset($newMail)):
                        // must be destroy also
                        // var_dump($newMail);
                        ?>
                            <div class="form-row success">
                                Message envoyé par : <?= $newMail->getReplyTo(); ?>
                            </div>
                            <!--
                            <div class="form-row success">
                                Pour : <?php // $newMail->getTo(); ?>
                            </div>
                            -->
                            <div class="form-row success">
                                Sujet : <?= $newMail->getSubject(); ?>
                            </div>
                            <div class="form-row success">
                                Message : <?= $newMail->getMessageTxt(); ?>
                            </div>
                        <?php
                    endif;
                ?>
                <div class="form-row">
                    <div class="form-row label">
                        <label for="name">Nom :</label>
                    </div>
                    <div class="form-row">
                        <input type="text" id="name" name="name" placeholder="celestin" value="<?= !isset($_POST['name']) ? null : htmlspecialchars($_POST['name']); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-row label">
                        <label for="email">Email :</label>
                    </div>
                    <div class="form-row">
                        <input type="email" name="email" id="email" placeholder="celestin@caramail.fr" value="<?= !isset($_POST['email']) ? null : htmlspecialchars($_POST['email']); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-row label">
                        <label for="subject">Objet :</label>
                    </div>
                    <div class="form-row">
                        <select id="subject" name="subject">
                            <optgroup label="type de demande">
                                <option value="0" <?= (isset($_POST['subject']))? (($_POST['subject'] == 0)? 'selected' : NULL ) : 'selected'; ?>>Demande de projet web</option>
                                <option value="1" <?= (isset($_POST['subject']))? (($_POST['subject'] == 1)? 'selected' : NULL ) : NULL; ?>>Prise de contact</option>
                                <option value="2" <?= (isset($_POST['subject']))? (($_POST['subject'] == 2)? 'selected' : NULL ) : NULL; ?>>Question(s)</option>
                                <!-- <option value="3" <?php // (isset($_POST['subject']))? (($_POST['subject'] == 3)? 'selected' : NULL ) : NULL; ?> disabled>Choisis !</option> !-->
                            </optgroup>
                        </select>
                    </div>
                </div>
                <!-- <div class="form-row">
                    je suis un robot :
                    <label for="check-robot-no">non !
                        <input type="radio" name="check-robot" id="check-robot-no" value="check-robot-no" checked>
                    </label>
                    <label for="check-robot-yes">ui... (n'enverra pas le mail)
                        <input type="radio" name="check-robot" id="check-robot-yes" value="check-robot-yes">
                    </label>
                </div> -->
                <input type="hidden" name="hidden-droid" value="">
                <hr>
                <div class="form-row">
                    <label for="textarea">Votre message :</label>
                </div>
                <div class="form-row">
                    <textarea name="textarea" id="textarea" cols="1" rows="20"><?= !isset($_POST['textarea']) ? 'Entrez votre message ici' : htmlspecialchars($_POST['textarea']); ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-row">
                        <p>Résoudre : </p>
                        <p id="form-captcha-eco-txt"></p>
                        <input type="number" id="form-captcha-eco" name="form-captcha-eco" value="" placeholder="0">
                    </div>
                </div>
                <div class="form-row">
                    <button type="reset" id="reset" value="reset">reset</button>
                    <button type="submit" id="submit" value="submit">envoyer</button>
                </div>
            </fieldset>
        </form>
    </section>

<script src="js/form.js"></script>
<?php require 'part/footer.php' ?>