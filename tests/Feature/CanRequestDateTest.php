<?php

namespace Tests\Feature;

use App\Models\Date;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanRequestdateTest extends TestCase
{
    use RefreshDatabase;

        /** @test */
    public function guests_users_cannot_create_date_request()
    {
        $recipient = factory(User::class)->create();

        $response = $this->postJson(route('dates.store', $recipient));

        $response->assertStatus(401);
    }

    /** @test */
    public function can_create_date_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        $this->actingAs($sender)->postJson(route('dates.store', $recipient));

        $this->assertDatabaseHas('dates', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);
    }
       /** @test */
       public function guests_users_cannot_delete_date_request()
       {
           $recipient = factory(User::class)->create();

           $response = $this->deleteJson(route('dates.destroy', $recipient));

           $response->assertStatus(401);
       }


    /** @test */
    public function can_delete_date_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Date::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);

        $this->actingAs($sender)->deleteJson(route('dates.destroy', $recipient));

        $this->assertDatabaseMissing('dates', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);
    }

    /** @test */
    public function guests_users_cannot_accept_date_request()
    {
        $user = factory(User::class)->create();

        $response = $this->postJson(route('accept-dates.store', $user));

        $response->assertStatus(401);
    }

    /** @test */
    public function can_accept_date_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Date::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);

        $this->actingAs($recipient)->postJson(route('accept-dates.store', $sender));

        $this->assertDatabaseHas('dates', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'accepted'
        ]);
    }

    /** @test */
    public function guests_users_cannot_deny_date_request()
    {
        $user = factory(User::class)->create();

        $response = $this->deleteJson(route('accept-dates.destroy', $user));

        $response->assertStatus(401);
    }


    /** @test */
    public function can_deny_date_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Date::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);

        $this->actingAs($recipient)->deleteJson(route('accept-dates.destroy', $sender));

        $this->assertDatabaseHas('dates', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'denied'
        ]);
    }
}
