<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use NotificationChannels\Telegram\TelegramMessage;

class PeminjamanAktifKendaraanNotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

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
        if($this->dontSend($notifiable)) {
            return [];
        }

        return ['telegram'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \NotificationChannels\Telegram\TelegramMessage
     */
    public function toTelegram($notifiable)
    {
        $notif = TelegramMessage::create()
            ->to($notifiable)
            ->content(" ! ! ! ! !     REMINDER     ! ! ! ! ! \n\n")
            ->line("*Peminjaman Kendaraan : *\n")
            ->line("Peminjam : " . $this->transaksi_peminjaman->user->nama)
            ->line("Keperluan : " . $this->transaksi_peminjaman->keperluan)
            ->line("Lokasi tujuan : " . $this->transaksi_peminjaman->lokasi_tujuan )
            ->line("Jenis Kendaraan : " . $this->transaksi_peminjaman->kendaraan->jenisKendaraan->nama)
            ->line("Kendaraan : " . $this->transaksi_peminjaman->kendaraan->nopol . " - " . $this->transaksi_peminjaman->kendaraan->merk . " " . $this->transaksi_peminjaman->kendaraan->tipe . " " . $this->transaksi_peminjaman->kendaraan->warna)
            ->line("\n*Telah melewati tanggal pengembalian kendaraan*\n\n_Terima kasih_");

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

    public function dontSend($notifiable)
    {
        return $this->transaksi_peminjaman->aktif == 0;
    }
}
