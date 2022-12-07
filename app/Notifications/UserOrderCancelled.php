<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

class UserOrderCancelled extends Notification
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
        return [
            'database',
            'mail',
            FcmChannel::class,
        ];
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
            ->greeting('Halo!')
            ->line("Pemesanan untuk nomor order {$this->order->number} sudah dibatalkan.")
            ->line('Silahkan cek status pesanan anda di aplikasi.')
            ->line('Terima kasih telah menggunakan Aplikasi Wisata Pulau Setan!');
    }
    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData([
                'object_id' => $this->order->id,
                'body' => "Pemesanan anda untuk nomor order {$this->order->number} telah di batalkan",
                'title' => 'Pemesanan di cancel',
                'object_type' => Order::class,
                'action' => null,

            ])
            ->setNotification(
                \NotificationChannels\Fcm\Resources\Notification::create()
                    ->setTitle('Pemesanan dibatalkan')
                    ->setBody("Pemesanan anda untuk nomor order {$this->order->number} telah di batalkan")
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
            'object_id' => $this->order->id,
            'body' => "Pemesanan anda untuk nomor order {$this->order->number} telah dibatalkan",
            'title' => 'Pemesanan dibatalkan',
            'object_type' => Order::class,
            'action' => null,
        ];
    }
}
