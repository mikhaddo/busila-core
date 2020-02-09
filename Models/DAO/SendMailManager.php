<?php
namespace App\Models\DAO;

require 'Models/DTO/SendMail.php';
use App\Models\DTO\SendMail;

class SendMailManager extends SendMail
{

    /**
     * construct needs :
     *  ->name
     *  ->replyTo (email)
     *  ->subject
     *  ->messageBrut (textarea)
     */
    public function __construct($name, $replyTo, $subject, $messageBrut)
    {
        // Default
        $this->setFrom('noreply@mysite.com');
        $this->setTo('mik@localhost'); # localhost

        // 3 mousquetaires
        $this->setName(htmlspecialchars($name));
        $this->setReplyTo(htmlspecialchars($replyTo));
        $this->setSubject(htmlspecialchars($subject));

        // recompilation messages version TXT && HTML
        $this->setMessageTxt($messageBrut);
        $this->setMessageHtml("<html><head></head><body><strong>". htmlspecialchars($messageBrut) ."</strong></body></html>");
    }

    /**
     * sending mail... Really nothing to touch !
     */
    public function sendMail()
    {
        // line-break and borders
        $crlf = "\r\n";
        $boundary = "-----=".md5(rand());

        // firtname, lastname, email from expéditeur (noreply@mysite.fr)
        // then email for reply
        $headers = "From: \"". $this->getName() ."\"<". $this->getFrom() .">".$crlf;
        $headers.= "Reply-to: \"". $this->getName() ."\"<". $this->getReplyTo() .">".$crlf;
        // convention
        $headers.= "MIME-Version: 1.0".$crlf;
        $headers.= "Content-Type: multipart/alternative;".$crlf." boundary=\"$boundary\"".$crlf;

        // message[] version TXT
        $message = $crlf."--".$boundary.$crlf;
        $message.= "Content-Type: text/plain; charset=\"UTF-8\"".$crlf;
        $message.= "Content-Transfer-Encoding: 8bit".$crlf;
        $message.= $crlf.$this->getMessageTxt().$crlf;
        $message.= $crlf."--".$boundary.$crlf;
        // message[] version HTML
        $message.= "Content-Type: text/html; charset=\"UTF-8\"".$crlf;
        $message.= "Content-Transfer-Encoding: 8bit".$crlf;
        $message.= $crlf.$this->getMessageHtml().$crlf;
        $message.= $crlf."--".$boundary."--".$crlf;
        $message.= $crlf."--".$boundary."--".$crlf;

        // send mail !
        mail($this->getTo(),$this->getSubject(),$message,$headers);
    }

}