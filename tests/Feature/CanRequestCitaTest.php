<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\Cita;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanRequestCitaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_users_cannot_create_cita_request()
    {
        $recipient = factory(User::class)->create();

        $response = $this->postJson(route('citas.store', $recipient));

        $response->assertStatus(401);
    }

    /** @test */
    public function can_create_cita_request()
    {
        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        $response = $this->actingAs($sender)->postJson(route('citas.store', $recipient));

        $response->assertJson([
           'cita_status' => 'pending'
        ]);

        $this->assertDatabaseHas('citas', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);

        $this->actingAs($sender)->postJson(route('citas.store', $recipient));
        $this->assertCount(1, Cita::all());
    }

    /** @test */
    public function guests_users_cannot_delete_cita_request()
    {
        $recipient = factory(User::class)->create();

        $response = $this->deleteJson(route('citas.destroy', $recipient));

        $response->assertStatus(401);
    }

    /** @test */
    public function can_delete_cita_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Cita::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);

        $response = $this->actingAs($sender)->deleteJson(route('citas.destroy', $recipient));

        $response->assertJson([
            'Cita_status' => 'deleted'
        ]);

        $this->assertDatabaseMissing('citas', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);
    }

    /** @test */
    public function guests_users_cannot_accept_cita_request()
    {
        $user = factory(User::class)->create();

        $response = $this->postJson(route('accept-citas.store', $user));

        $response->assertStatus(401);
    }

    /** @test */
    public function can_accept_cita_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Cita::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);

        $this->actingAs($recipient)->postJson(route('accept-citas.store', $sender));

        $this->assertDatabaseHas('citas', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'accepted'
        ]);
    }

    /** @test */
    public function guests_users_cannot_deny_cita_request()
    {
        $user = factory(User::class)->create();

        $response = $this->deleteJson(route('accept-citas.destroy', $user));

        $response->assertStatus(401);
    }

    /** @test */
    public function can_deny_cita_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Cita::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);

        $this->actingAs($recipient)->deleteJson(route('accept-citas.destroy', $sender));

        $this->assertDatabaseHas('citas', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'denied'
        ]);
    }
}
