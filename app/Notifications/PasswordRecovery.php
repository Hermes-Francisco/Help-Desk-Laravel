<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordRecovery extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $token;

    public function __construct($token)
    {
        $this->token = $token;
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
                ->greeting('Olá, '.$notifiable->name.'!')
                ->subject('Link de Recuperação de Senha')
                ->line('Enviamos esse email porque recebemos um pedido de recuperação de senha para sua conta')
                ->action('Recuperar Senha', url('/reset-password/'. $this->token . '?email='.$notifiable->email))
                ->line('Esse link irá expirar em 60 minutos')
                ->line('Se você não precisa recuperar sua senha, pode ignorar esse email')
                ->salutation('Até mais');
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
