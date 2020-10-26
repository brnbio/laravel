<?php

declare(strict_types=1);

namespace App\Notifications\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * Class UpdatePasswordNotification
 *
 * @package App\Notifications\Users
 */
class UpdatePasswordNotification extends Notification
{
    use Queueable;

    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'message' => 'Your password was updated.',
        ];
    }
}
