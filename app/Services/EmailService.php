<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    private string $to = '';
    private string $template = '';
    private string $subject = '';
    private array $payload = [];

    public static function make(): EmailService
    {
        return new EmailService();
    }

    public function send(): bool
    {
        if (!$this->to)
            return false;

        if (!$this->subject)
            $this->subject('ecommerceShipping');

        Mail::send($this->template, ['payload' => $this->payload], function ($message) {
            $message
                ->to($this->to)
                ->subject($this->subject);

            $message->from(config('mail.from.address'), config('mail.from.name'));
        });

        return !Mail::failures();
    }

    public function to(string $to = ''): EmailService
    {
        $this->to = $to;

        return $this;
    }

    public function template(string $template = ''): EmailService
    {
        $this->template = $template;

        return $this;
    }

    public function subject(string $subject = ''): EmailService
    {
        $this->subject = $subject;

        return $this;
    }

    public function setPayload(array $payload = []): EmailService
    {
        $this->payload = $payload;

        return $this;
    }
}
