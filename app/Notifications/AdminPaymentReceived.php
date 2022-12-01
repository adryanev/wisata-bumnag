<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminPaymentReceived extends Notification implements ShouldBroadcast
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
        return ['database', 'mail', 'broadcast'];
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
            ->greeting('Halo')
            ->line("Order dengan nomor {$this->order->number} sudah dibayar oleh Pengguna.")
            ->line("Pembayaran sebesar: {$this->order->total_price}");
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title' => 'Pembayaran diterima',
            'message' => "Order dengan nomor {$this->order->number} sudah dibayar oleh pengguna.",
            'id' => $this->order->id,
            'total_price' => $this->order->total_price,
            'type' => Order::class,

        ]);
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
            'title' => 'Pembayaran diterima',
            'message' => "Order dengan nomor {$this->order->number} sudah dibayar oleh pengguna.",
            'id' => $this->order->id,
            'total_price' => $this->order->total_price,
            'type' => Order::class,


        ];
    }
}
