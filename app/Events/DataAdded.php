<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DataAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        // $this->data = $data;
        $this->data = [
            'id' => $data->id,
            'tgl_operasi' => $data->tgl_operasi,
            'jam_operasi' => $data->jam_operasi,
            'nama_pasien' => $data->nama_pasien,
            'usia_s_usia' => $data->usia . ' ' . $data->s_usia, // Gabungkan usia dan s_usia
            // 'usia' => $data->usia,
            // 's_usia' => $data->s_usia,
            'no_cm' => $data->no_cm,
            'diagnosa' => $data->diagnosa,
            'tindakan' => $data->tindakan,
            'dokter' => ['nama_dokter' => $data->dokter->nama_dokter], // Nama dokter dari relasi
            'ruang_operasi' => $data->ruang_operasi,
            'status' => $data->status,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('Y-m-d');
        return new Channel('data-added.' . $today);
    }
}
