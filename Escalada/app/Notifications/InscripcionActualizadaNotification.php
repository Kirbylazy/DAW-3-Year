<?php

namespace App\Notifications;

use App\Models\Inscripcion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class InscripcionActualizadaNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly Inscripcion $inscripcion,
        public readonly ?string $motivo = null
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'tipo'           => 'inscripcion_actualizada',
            'competicion_id' => $this->inscripcion->competicion_id,
            'competicion'    => $this->inscripcion->competicion->name,
            'estado'         => $this->inscripcion->estado,
            'motivo'         => $this->motivo,
        ];
    }
}
