<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreated extends Notification
{
//    use Queueable;

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
        $appName = config('app.name');
        $nome = $notifiable->name;
        $matricula = $notifiable->enrolment;
        $senha = $notifiable->passwordDesc;
//        dd($notifiable,$senha);die;
        return (new MailMessage)
                    ->subject("Sua conta no $appName foi criada, seu bosta.")
                    ->greeting("Olá $nome .")
                    ->line("Seu numero de mátricula foi gerado, sua mátricula é: $matricula .")
                    ->line("A sua senha é: $senha .")
                    ->action('Notification Action', url('/'))
                    ->line('Obrigado e seja BEM VINDO !');
    }

}
