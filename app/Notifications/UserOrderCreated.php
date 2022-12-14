<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

class UserOrderCreated extends Notification implements ShouldQueue
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

            ->greeting('Halo, Pesanan Dibuat.')
            ->subject("Order {$this->order->number} dibuat")
            ->line("Pesanan Anda berhasil dibuat, dengan nomor order {$this->order->number}.")
            ->line("Silahkan bayar pesanan anda dalam waktu 24 Jam.")
            ->line('Pembayaran hanya bisa dilakukan di dalam Aplikasi Wisata Pulau Setan.');
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData([
                'object_id' => $this->order->id,
                'object_type' => Order::class,
                'title' => 'Order Dibuat',
                'body' => "Pesanan dengan nomor order {$this->order->number} berhasil dibuat!",
                'action' => null

            ])
            ->setNotification(
                \NotificationChannels\Fcm\Resources\Notification::create()
                    ->setTitle('Order Dibuat')
                    ->setBody("Pesanan dengan nomor order {$this->order->number} berhasil dibuat!")
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
            'object_type' => Order::class,
            'title' => 'Order Dibuat',
            'body' => "Pesanan dengan nomor order {$this->order->number} berhasil dibuat!",
            'action' => null
        ];
    }
}
