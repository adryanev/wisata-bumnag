<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmMessage;

class UserTicketApproved extends Notification
{
    use Queueable;

    /**
     * Order
     *
     * @var App\Models\Order
     */
    private $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail', FcmChannel::class];
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
            ->greeting('Tiket digunakan.')
            ->line("Tiket anda untuk nomor order {$this->order->number} Sudah digunakan");
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData(['data' => ['is_success' => true]])
            ->setTopic('ticket')
            ->setNotification(
                \NotificationChannels\Fcm\Resources\Notification::create()
                    ->setTitle('Tiket digunakan')
                    ->setBody("Tiket anda untuk nomor order {$this->order->number} Sudah digunakan")
            );
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
            'id' => $this->order->id,
            'type' => Ticket::class,
            'number' => $this->order->number,
            'title' => 'Tiket digunakan',
            'body' => "Tiket anda untuk nomor order {$this->order->number} Sudah digunakan",

        ];
    }
}
