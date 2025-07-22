<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
     protected $model = Message::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Contenido del mensaje - párrafo de 1 a 3 oraciones
            'content' => $this->faker->paragraph(rand(1, 3)),
            
            // Fecha de envío - entre 6 meses atrás y ahora
            'sent_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            
            // ID del usuario que envía el mensaje
            'sender_id' => $this->getSenderId(),
            
            // ID del usuario que recibe el mensaje (usando closure para acceder al sender_id)
            'receiver_id' => fn(array $attributes) => $this->getReceiverId($attributes['sender_id']),
        ];
        
    }
     /**
     * Obtiene un ID de usuario válido para ser el remitente
     */
    private function getSenderId(): int
    {
        $user = User::inRandomOrder()->first();
        
        if (!$user) {
            $user = User::factory()->create();
        }
        
        return $user->id;
    }

    /**
     * Obtiene un ID de usuario válido para ser el receptor
     */
    private function getReceiverId(int $senderId): int
    {
        $receiver = User::where('id', '!=', $senderId)->inRandomOrder()->first();
        
        if (!$receiver) {
            $receiver = User::factory()->create();
        }
        
        return $receiver->id;
    }
}
