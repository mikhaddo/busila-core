<?php
namespace App\Models\DAO;

require 'Models/DTO/FormContact.php';
use App\Models\DTO\FormContact;

class FormContactManager extends FormContact
{

    /**
     * form : call to values
     * isset($_POST['check-robot']) && # obsolete
     */
    public function isFormContactSent()
    {
        if(
            isset($_POST['name']) &&
            isset($_POST['email']) &&
            isset($_POST['subject']) &&
            isset($_POST['hidden-droid']) &&
            isset($_POST['textarea']) &&
            isset($_POST['form-captcha-eco'])
        ){
            return TRUE;
        }
    }

    /**
     * mini-method cleaning the form !
     */
    public function cleanForm()
    {
        $_POST['name'] = NULL;
        $_POST['email'] = NULL;
        $_POST['subject'] = NULL;
        $_POST['textarea'] = NULL;
        $_POST['form-captcha-eco'] = NULL;
    }

    /**
     * after call for all elements, verification of the content
     */
    public function isFormContactVerified()
    {

        // verification name
        if(empty($_POST['name'])){
            $this->setErrors('Veillez rentrer un nom !');
        } else if(!preg_match('/^[a-zA-Z\-\s\'áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]{3,100}$/', $_POST['name'])){
            $this->setErrors('nom incorrect : trop long ou trop court ; ou alors caractères : minucules, Majuscules, -, , \' ');
        } else {
            $this->setName($_POST['name']);
        }

        // verification email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $this->setErrors('l\'email entré n\'est pas bon');
        } else {
            $this->setEmail($_POST['email']);
        }

        // verification subject && assoc $this->setSubject
        if(
            $_POST['subject'] != 0 &&
            $_POST['subject'] != 1 &&
            $_POST['subject'] != 2 &&
            $_POST['subject'] != 3
        ){
            $this->setErrors('le sujet n\'est pas bon !');
        } else {
            // conversion 0-1-2-3 in hard-text. not so good, we are in procedural mode.
            // can upgrade this with array[]
            switch ($_POST['subject']){
                case 0:
                    $this->setSubject('00 : Demande de projet web');
                    break;
                case 1:
                    $this->setSubject('01 : Prise de contact');
                    break;
                case 2:
                    $this->setSubject('02 : Question(s)');
                    break;
                case 3:
                    $this->setSubject('03 : Choisis ! :(');
                    break;
                default:
                    $this->setSubject(NULL);
            }
        }

        // verification hidden-droid
        if(!empty($_POST['hidden-droid'])){
            $this->setErrors('vous êtes un robot il me semble');
        }

        // verification check-robot, not use
        // if($_POST['check-robot'] != 'check-robot-no'){
        //     $this->setErrors('on coche la case robot comme cela ?');
        // }

        // verification textarea (false positif ?)
        // or write function with regex for resend purified textarea to the user
        if(empty($_POST['textarea'])){
            $this->setErrors('votre message est vide !');
        } else if(
            !preg_match(
                '/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ\.\_\-\s\'\?\!\(\)\#\@\:\;\,\/\\\+\*\=\&\£\$\€]{20,5000}$/i',
                $_POST['textarea']
            )
        ){
            $this->setErrors('message doit compoter entre 20 et 5000 caractères, en évitant les spéciaux');
        } else {
            $this->setTextarea($_POST['textarea']);
        }

        // verification form-captcha-eco need two generation numbers
        if(!filter_var($_POST['form-captcha-eco'], FILTER_VALIDATE_INT)){
            $this->setErrors('votre captcha n\'est pas un numéro !');
        } /* else if( $_POST['form-captcha-eco'] != (10+$number_captcha_rnd)){
            $this->setErrors('vous vous êtes trompés dans l\'addition.');
        } */

        // return $errors ?
        if(empty($this->getErrors())){
            return TRUE;
        }

    }

}

