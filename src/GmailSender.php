<?php

namespace Elb\GmailSender;

use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Part\TextPart;
use Symfony\Component\Mime\Part\Multipart\AlternativePart;

class GmailSender
{
    protected $from;
    protected $fromName;

    public function __construct()
    {
        $this->from = config('gmail-sender.from_address', env('GMAIL_SENDER_FROM', 'byoungchullee@gmail.com'));
        $this->fromName = config('gmail-sender.from_name', env('GMAIL_SENDER_NAME', '이병철'));
    }

    /**
     * 텍스트 메일 전송
     *
     * @param string $to 수신자 이메일
     * @param string $subject 메일 제목
     * @param string $textBody 메일 본문 (텍스트)
     * @return bool
     */
    public function sendText(string $to, string $subject, string $textBody): bool
    {
        Mail::raw($textBody, function ($message) use ($to, $subject) {
            $message->from($this->from, $this->fromName)
                ->to($to)
                ->subject($subject);
        });

        return true;
    }

    /**
     * HTML 메일 전송
     *
     * @param string $to 수신자 이메일
     * @param string $subject 메일 제목
     * @param string $htmlBody 메일 본문 (HTML)
     * @return bool
     */
    public function sendHtml(string $to, string $subject, string $htmlBody): bool
    {
        Mail::html($htmlBody, function ($message) use ($to, $subject) {
            $message->from($this->from, $this->fromName)
                ->to($to)
                ->subject($subject);
        });

        return true;
    }

    /**
     * 텍스트 + HTML 함께 보내는 Multipart 메일 전송
     *
     * @param string $to 수신자 이메일
     * @param string $subject 메일 제목
     * @param string $htmlBody 메일 본문 (HTML)
     * @param string $textBody 메일 본문 (텍스트)
     * @return bool
     */
    public function sendMultipart(string $to, string $subject, string $htmlBody, string $textBody): bool
    {
        Mail::send([], [], function ($message) use ($to, $subject, $htmlBody, $textBody) {
            $message->from($this->from, $this->fromName)
                ->to($to)
                ->subject($subject);

            // 여기 수정: Multipart AlternativePart 객체로 설정
            $multipart = new AlternativePart(
                new TextPart($textBody, 'utf-8'),
                new TextPart($htmlBody, 'utf-8', 'html')
            );

            $message->getSymfonyMessage()->setBody($multipart);
        });

        return true;
    }
}
