<?php
namespace App\Models\DTO;

class FormContact
{

    protected $errors = [];
    protected $name;
    protected $email;
    protected $subject;
    protected $textarea;

    // getters
    public function getErrors()
    {
        return $this->errors;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getSubject()
    {
        return $this->subject;
    }
    public function getTextarea()
    {
        return $this->textarea;
    }

    // setters
    public function setErrors($error)
    {
        $this->errors[] = $error;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    public function setTextarea($textarea)
    {
        $this->textarea = $textarea;
    }

}
