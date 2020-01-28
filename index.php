<?php
    /**
     * form : call to values
     * verification
     * send mail
     */
    if(
        isset($_POST['name']) &&
        isset($_POST['email']) &&
        isset($_POST['subject']) &&
        isset($_POST['hidden-droid']) &&
        // isset($_POST['check-robot']) && # obsolete
        isset($_POST['textarea']) &&
        isset($_POST['form-captcha-eco'])
    ){
        /**
         * after call for all elements, verification of the content
         */

        // verification name
        if(empty($_POST['name'])){
            $errors[] = 'Veillez rentrer un nom !';
        } else if(!preg_match('/^[a-zA-Z\-\s\'áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]{3,100}$/', $_POST['name'])){
            $errors[] = 'nom incorrect : trop long | trop court ; minucules, Majuscules, -, , \' ';
        }

        // verification email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'email pas bon';
        }

        // verification subject && assoc $subject_result
        if(
            $_POST['subject'] != 0 &&
            $_POST['subject'] != 1 &&
            $_POST['subject'] != 2 &&
            $_POST['subject'] != 3
        ){
            $errors[] = 'le sujet n\'est pas bon !';
        } else {
            // conversion 0-1-2-3 in hard-text. not so good, we are in procedural mode.
            switch ($_POST['subject']){
                case 0:
                    $subject_result = '00 : Demande de projet web';
                    break;
                case 1:
                    $subject_result = '01 : Prise de contact';
                    break;
                case 2:
                    $subject_result = '02 : Question(s)';
                    break;
                case 3:
                    $subject_result = '03 : Choisis ! :(';
                    break;
                default:
                    $subject_result = NULL;
            }
        }

        // verification hidden-droid
        if(!empty($_POST['hidden-droid'])){
            $errors[] = 'vous êtes un robot il me semble';
        }

        // verification check-robot, not use
        // if($_POST['check-robot'] != 'check-robot-no'){
        //     $errors[] = 'on coche la case robot comme cela ?';
        // }

        // verification textarea (false positif ?)
        // or write function with regex for resend purified textarea to the user
        if(empty($_POST['textarea'])){
            $errors[] = 'votre message est vide !';
        } else if(
            !preg_match(
                '/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ\.\_\-\s\'\?\!\(\)\#\@\:\;\,\/\\\+\*\=\&\£\$\€]{20,5000}$/i',
                $_POST['textarea'] )
            ){
                $errors[] = 'message doit compoter entre 20 et 5000 caractères, en évitant les spéciaux';
            }

        // verification form-captcha-eco need two generation numbers
        if(!filter_var($_POST['form-captcha-eco'], FILTER_VALIDATE_INT)){
            $errors[] = 'votre captcha n\'est pas un numéro !';
        } /* else if( $_POST['form-captcha-eco'] != (10+$number_captcha_rnd)){
            $errors[] = 'vous vous êtes trompés dans l\'addition.';
        } */

        /**
         * and if nothing goes to errors[] :
         */
        if(!isset($errors)){
            $success = 'Message envoyé par : ' . htmlspecialchars($_POST['name']);

            /**
             * sending mail...
             */
            // what mail server ? postfix ? 1&1 ?
            $to = 'mik@localhost'; # localhost
            // $to = 'celestin@gmail.com'; # be carrefull when you send mails, spamming GMAIL !

            //$subject = $_POST['subject'];
            $subject = $subject_result;

            // message version TEXT and HTML
            $message_txt = $_POST['textarea'];
            $message_html = "<html><head></head><body><strong>". htmlspecialchars($_POST['textarea']) ."</strong></body></html>";

            // line-break and borders
            $crlf = "\r\n";
            $boundary = "-----=".md5(rand());

            // firtname, lastname, email from expéditeur (noreply@monsite.fr)
            // then email for reply
            $headers = "From: \"". htmlspecialchars($_POST['name']) ."\"<noreply@busila-core.com>".$crlf;
            $headers.= "Reply-to: \"". htmlspecialchars($_POST['name']) ."\"<". htmlspecialchars($_POST['email']) .">".$crlf;

            // convention
            $headers.= "MIME-Version: 1.0".$crlf;
            $headers.= "Content-Type: multipart/alternative;".$crlf." boundary=\"$boundary\"".$crlf;

            // message[] version TXT
            $message = $crlf."--".$boundary.$crlf;
            $message.= "Content-Type: text/plain; charset=\"UTF-8\"".$crlf;
            $message.= "Content-Transfer-Encoding: 8bit".$crlf;
            $message.= $crlf.$message_txt.$crlf;
            $message.= $crlf."--".$boundary.$crlf;
            // message[] version HTML
            $message.= "Content-Type: text/html; charset=\"UTF-8\"".$crlf;
            $message.= "Content-Transfer-Encoding: 8bit".$crlf;
            $message.= $crlf.$message_html.$crlf;
            $message.= $crlf."--".$boundary."--".$crlf;
            $message.= $crlf."--".$boundary."--".$crlf;

            // send mail !
            mail($to,$subject,$message,$headers);
            $mail_sended = [
                'to' => $to,
                'subject' => $subject,
                'message' => $message_html,
                'message_txt' => $message_txt,
                'message_html' => $message_html,
                'headers' => $headers,
            ];

        } # endmail

    } # endform

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
                    if(isset($errors)):
                        // must be destroy
                        //var_dump($_POST);
                        foreach($errors as $error):
                        ?>
                            <div class="form-row errors">
                                <?= $error ?>
                            </div>
                        <?php
                        endforeach;
                    endif;
                ?>
                <?php
                    if(isset($success)):
                        // must be destroy also
                        //var_dump($_POST);
                        //var_dump($mail_sended);
                        ?>
                            <div class="form-row success">
                                <?= $success; ?>
                            </div>
                            <div class="form-row success">
                                Pour : <?= $mail_sended['to']; ?>
                            </div>
                            <div class="form-row success">
                                Sujet : <?= $mail_sended['subject']; ?>
                            </div>
                            <div class="form-row success">
                                Message : <?= $mail_sended['message_txt']; ?>
                            </div>
                        <?php
                    endif;
                ?>
                <?php
                    /**
                     * debug formulaire
                     */
                    //echo isset($subject_result)? ( isset($_POST['subject'])? $subject_result : NULL ) : NULL;
                    //echo isset($_POST['form-captcha-eco'])? $_POST['form-captcha-eco'] . ' != ' . (10+$number_captcha_rnd) : NULL;
                 ?>
                <div class="form-row">
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" placeholder="celestin" value="<?= !isset($_POST['name']) ? null : htmlspecialchars($_POST['name']); ?>">
                </div>
                <div class="form-row">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" placeholder="celestin@caramail.fr" value="<?= !isset($_POST['email']) ? null : htmlspecialchars($_POST['email']); ?>">
                </div>
                <div class="form-row">
                    <label for="subject">Objet :</label>
                    <select id="subject" name="subject">
                        <optgroup label="type de demande">
                        <option value="0" <?= (isset($_POST['subject']))? (($_POST['subject'] == 0)? 'selected' : NULL ) : NULL; ?>>Demande de projet web</option>
                        <option value="1" <?= (isset($_POST['subject']))? (($_POST['subject'] == 1)? 'selected' : NULL ) : NULL; ?>>Prise de contact</option>
                        <option value="2" <?= (isset($_POST['subject']))? (($_POST['subject'] == 2)? 'selected' : NULL ) : NULL; ?>>Question(s)</option>
                        <option value="3" <?= (isset($_POST['subject']))? (($_POST['subject'] == 3)? 'selected' : NULL ) : 'selected'; ?> disabled>Choisis !</option>
                        </optgroup>
                    </select>
                </div>
                <!-- <div class="form-row">
                    je suis un robot :
                    <label for="check-robot-no">non !
                        <input type="radio" name="check-robot" id="check-robot-no" value="check-robot-no" checked>
                    </label>
                    <input type="hidden" name="hidden-droid" value="">
                    <label for="check-robot-yes">ui... (n'enverra pas le mail)
                        <input type="radio" name="check-robot" id="check-robot-yes" value="check-robot-yes">
                    </label>
                </div> -->
                <hr>
                <div class="form-row">
                    <label for="textarea">Votre message :</label>
                </div>
                <div class="form-row">
                    <textarea name="textarea" id="textarea" cols="20" rows="20"><?= !isset($_POST['textarea']) ? 'C\'est pour raconter des babioles.' : htmlspecialchars($_POST['textarea']); ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-row">
                        <p>Résoudre : </p>
                        <p id="form-captcha-eco-txt"></p>
                        <input type="number" id="form-captcha-eco" name="form-captcha-eco" value="" placeholder="0">
                    </div>
                    <button type="reset" id="reset" value="reset">reset</button>
                    <button type="submit" id="submit" value="submit">envoie</button>
                </div>
            </fieldset>
        </form>
    </section>

<script src="js/form.js"></script>

<?php require 'part/footer.php' ?>
<?php
    /**
     * ob style PHP parts
     */
    //$title = $post['title'];
    //ob_start();
    //$content = ob_get_clean();
    //require('index.php');
?>
