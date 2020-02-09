<?php
namespace App\Models\DTO;

class SendMail
{

    protected $to;
    protected $from;
    protected $name;
    protected $replyTo;
    protected $subject;
    protected $messageTxt;
    protected $messageHtml;

    // getters
    public function getTo()
    {
        return $this->to;
    }
    public function getFrom()
    {
        return $this->from;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getReplyTo()
    {
       return $this->replyTo;
    }
    public function getSubject()
    {
        return $this->subject;
    }
    public function getMessageTxt()
    {
        return $this->messageTxt;
    }
    public function getMessageHtml()
    {
        return $this->messageHtml;
    }

    // setters
    public function setTo($to)
    {
        $this->to = $to;
    }
    public function setFrom($from)
    {
        $this->from = $from;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    public function setMessageTxt($messageTxt)
    {
        $this->messageTxt = $messageTxt;
    }
    public function setMessageHtml($messageHtml)
    {
        $this->messageHtml = $messageHtml;
    }

}