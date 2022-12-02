<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

class UserPaymentReceived extends Notification
{
    use Queueable;

    /**
     * Order Payment Received
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
            // FcmChannel::class,
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
            ->line("Pembayaran untuk nomor order {$this->order->number} sudah diterima.")
            ->line('Silahkan cek status pesanan anda di aplikasi.')
            ->line('Terima kasih telah menggunakan Aplikasi Wisata Pulau Setan!');
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData([
                'id' => $this->order->id,
                'order_number' => $this->order->number,
                'total_price' => $this->order->total_price,
                'is_success' => true,
                'type' => Order::class,
            ])
            ->setNotification(
                \NotificationChannels\Fcm\Resources\Notification::create()
                    ->setTitle('Pembayaran diterima')
                    ->setBody("Pembayaran anda untuk nomor order {$this->order->number} telah kami terima")
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
            'order_number' => $this->order->number,
            'total_price' => $this->order->total_price,
            'is_success' => true,
            'type' => Order::class,
        ];
    }
}
