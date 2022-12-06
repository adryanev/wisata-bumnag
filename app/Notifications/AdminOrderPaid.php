<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class AdminOrderPaid extends Notification
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
        return ['database','mail','broadcast'];
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
            ->greeting('Halo,')
            ->line("Order dengan nomor {$this->order->number} sudah di bayar.");
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title' => 'Pesanan Di Bayar',
            'body' => "Order dengan nomor {$this->order->number} sudah di Bayar",
            'object_id' => $this->order->id,
            'object_type' => Order::class,
            'action' => null,
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
            'title' => 'Pesanan Dibayar',
            'body' => "Order dengan nomor {$this->order->number} sudah di bayar",
            'object_id' => $this->order->id,
            'object_type' => Order::class,
            'action' => null,
        ];
    }
}
