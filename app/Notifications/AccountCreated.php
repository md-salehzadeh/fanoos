<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
		 return (new MailMessage)
			->subject('ثبت نام شما با موفقیت انجام شد')
			->success()
			->greeting('باسلام,')
			->line('ثبت نام شما با موفقیت انجام شد')
			->line('به منظور تکمیل فرایند ثبت نام لطفا بر روی لینک زیر کلیک نمایید تا حساب کاربری شما فعال گردد.')
			->action('فعالسازی حساب', url('/').'/api/auth/virify')
			->salutation("باتشکر,\r\nفانوس");
	}

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
