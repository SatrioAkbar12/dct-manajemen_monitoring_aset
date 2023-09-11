<?php

namespace App\Notifications;

use App\Models\ServisRutinKendaraan;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use NotificationChannels\Telegram\TelegramMessage;

class TanggalServisRutinKendaraanNotification extends Notification implements ShouldQueue
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
            ->content(" ! ! ! ! !   REMINDER   ! ! ! ! !\n\n")
            ->line("*Servis rutin kendaraan :*\n")
            ->line("Jenis kendaraan : " . $this->servis_rutin->kendaraan->jenisKendaraan->nama)
            ->line("Kendaraan : " . $this->servis_rutin->kendaraan->nopol . " - " . $this->servis_rutin->kendaraan->merk . " " . $this->servis_rutin->kendaraan->tipe . " " . $this->servis_rutin->kendaraan->warna)
            ->line("KM saat ini : " . $this->servis_rutin->kendaraan->km_saat_ini )
            ->line("KM target servis : " . $this->servis_rutin->km_target)
            ->line("Target tanggal servis : " . Carbon::parse($this->servis_rutin->tanggal_target)->translatedFormat('d-m-Y'))
            ->line("\n*Segera melakukan servis rutin kendaraan karena telah melewati target tanggal servis*\n\n_Terima kasih_");

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
        $servis = ServisRutinKendaraan::where('id_kendaraan', $this->servis_rutin->id_kendaraan)->orderBy('created_at', 'desc')->first();

        if($this->servis_rutin->id != $servis->id) {
            return true;
        }
        else {
            return false;
        }
    }
}
