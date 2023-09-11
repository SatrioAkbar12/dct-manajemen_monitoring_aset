<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use NotificationChannels\Telegram\TelegramMessage;

class KmTargetPassedServisRutinKendaraanNotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $servis_rutin;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($servis)
    {
        $this->servis_rutin = $servis;
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
     * @return \NotificationChannels\Telegram\TelegramMessage
     */
    public function toTelegram($notifiable)
    {
        $notif = TelegramMessage::create()
            ->to($notifiable)
            ->content(" ! ! ! ! !   REMINDER   ! ! ! ! !\n\n")
            ->line("*Servis rutin kendaraan :*\n")
            ->line("Jenis kendaraan : " . $this->servis_rutin->kendaraan->jenisKendaraan->nama)
            ->line("Kendaraan : " . $this->servis_rutin->kendaraan->nopol . " - " . $this->servis_rutin->kendaraan->merk . " " . $this->servis_rutin->kendaraan->tipe . " " . $this->servis_rutin->kendaraan->warna)
            ->line("KM saat ini : " . $this->servis_rutin->kendaraan->km_saat_ini )
            ->line("KM target servis : " . $this->servis_rutin->km_target)
            ->line("\n*Segera untuk melakukan servis rutin kendaraan karena telah mencapai target KM servis*\n\n_Terima kasih_");

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
