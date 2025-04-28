<?php

namespace Elb\GmailSender;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class GmailSender
{
    protected $user;
    protected $password;
    protected $fromName;

    public function __construct()
    {
        $this->user = config('gmail-sender.gmail_user', 'byoungchullee@gmail.com');
        $this->password = config('gmail-sender.gmail_password');
        $this->fromName = config('gmail-sender.gmail_name', '이병철');
    }

    /**
     * 메일 보내기
     *
     * @param string $toEmail 수신자 이메일
     * @param string $subject 메일 제목
     * @param string $body 메일 본문
     * @return string
     * @throws \Exception
     */
    public function send($toEmail, $subject, $body)
    {
        $mail = new PHPMailer(true);

        echo 'test';

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $this->user;
            $mail->Password = $this->password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // 발신자 (고정)
            $mail->setFrom($this->user, $this->fromName);
            // 수신자
            $mail->addAddress($toEmail);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            return "Email sent successfully to {$toEmail}";
        } catch (Exception $e) {
            throw new \Exception("Email sending failed: {$mail->ErrorInfo}");
        }
    }

     /**
     * 간단한 텍스트 메일 전송
     *
     * @param string $to 수신자 이메일
     * @param string $subject 메일 제목
     * @param string $body 메일 본문
     * @return bool
     */
    public function sendMail(string $to, string $subject, string $body): bool
    {
        $from = config('gmail-sender.from_address', env('GMAIL_SENDER_FROM'));
        $fromName = config('gmail-sender.from_name', env('GMAIL_SENDER_NAME'));

        Mail::raw($body, function ($message) use ($to, $subject, $from, $fromName) {
            $message->from($from, $fromName)
                    ->to($to)
                    ->subject($subject);
        });

        return true;
    }
}