<?php

namespace Tests\Unit\Models;

use App\Models\Cita;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CitaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_cita_request_belongs_to_a_sender()
    {
        $sender = factory(User::class)->create();

        $cita = factory(Cita::class)->create(['sender_id' => $sender->id]);

        $this->assertInstanceOf(User::class, $cita->sender);
    }

    /** @test */
    public function a_cita_request_belongs_to_a_recipient()
    {
        $recipient = factory(User::class)->create();

        $cita = factory(Cita::class)->create(['recipient_id' => $recipient->id]);

        $this->assertInstanceOf(User::class, $cita->recipient);
    }
}
