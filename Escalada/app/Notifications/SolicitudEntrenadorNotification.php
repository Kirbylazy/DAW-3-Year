<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Notifications\Notification;

class SolicitudEntrenadorNotification extends Notification
{
    public function __construct(public User $entrenador) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'tipo'            => 'solicitud_entrenador',
            'entrenador_id'   => $this->entrenador->id,
            'entrenador_name' => $this->entrenador->name,
            'mensaje'         => "{$this->entrenador->name} quiere ser tu entrenador.",
        ];
    }
}
