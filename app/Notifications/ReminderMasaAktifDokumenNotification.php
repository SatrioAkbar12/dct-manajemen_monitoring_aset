<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use NotificationChannels\Telegram\TelegramMessage;

class ReminderMasaAktifDokumenNotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $masa_aktif_dokumen_kendaraan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($masa_aktif_dokumen)
    {
        $this->masa_aktif_dokumen_kendaraan = $masa_aktif_dokumen;
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
            ->line("*Masa aktif dokumen kendaraan : *\n")
            ->line("Dokumen : " . $this->masa_aktif_dokumen_kendaraan->tipeDokumen->nama_dokumen )
            ->line("Kendaraan : " . $this->masa_aktif_dokumen_kendaraan->kendaraan->nopol . " - " . $this->masa_aktif_dokumen_kendaraan->kendaraan->merk . " " . $this->masa_aktif_dokumen_kendaraan->kendaraan->tipe . " " . $this->masa_aktif_dokumen_kendaraan->kendaraan->warna)
            ->line("Masa aktif : " . $this->masa_aktif_dokumen_kendaraan->tanggal_masa_berlaku)
            ->line("\nSegera perbarui masa aktif dokumen sebelum *" . Carbon::parse($this->masa_aktif_dokumen_kendaraan->tanggal_masa_berlaku)->translatedFormat('l, d F Y') . "*\n\n_Terima kasih_");

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

    public function dontSend($notifiable) {
        return $this->masa_aktif_dokumen_kendaraan->kendaraan->tanggal_perbarui_dokumen == null;
    }
}
