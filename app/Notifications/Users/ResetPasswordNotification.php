<?php

declare(strict_types=1);

namespace App\Notifications\Users;

use Illuminate\Auth\Notifications\ResetPassword as Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class ResetPasswordNotification
 *
 * @package App\Notifications\Users
 */
class ResetPasswordNotification extends Notification
{
    /**
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $url = route('reset-password', [
            'token' => $this->token,
        ]);

        return (new MailMessage)
            ->subject(__('Reset Password Notification'))
            ->line(__('You are receiving this email because we received a password reset request for your account.'))
            ->action(__('Reset Password'), $url)
            ->line(__('If you did not request a password reset, no further action is required.'));
    }
}
