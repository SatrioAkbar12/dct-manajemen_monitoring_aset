<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class PeminjamanAktifToolNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $transaksi_peminjaman;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($transaksi)
    {
        $this->transaksi_peminjaman = $transaksi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['telegram'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTelegram($notifiable)
    {
        $notif = TelegramMessage::create()
            ->to($notifiable)
            ->content(" ! ! ! ! !     REMINDER     ! ! ! ! ! \n\n")
            ->line("*Peminjaman Tools : *\n")
            ->line("Peminjam : " . $this->transaksi_peminjaman->user->nama)
            ->line("Keperluan : " . $this->transaksi_peminjaman->keperluan)
            ->line("Lokasi tujuan : " . $this->transaksi_peminjaman->lokasi_tujuan)
            ->line("Tools : ");

        foreach($this->transaksi_peminjaman->listTools as $listTools) {
            $notif = $notif->line("- " . $listTools->aset->kode_aset . " - " . $listTools->aset->tool->merk . " " . $listTools->aset->tool->nama . " " . $listTools->aset->tool->model);
        }

        $notif = $notif->line("\n*Telah melewati tanggal pengembalian tools*\n\n_Terima kasih_");

        return $notif;
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
