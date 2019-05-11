<?php

namespace Tests\Feature;

use App\User;
use App\Models\Date;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanRequestDateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_send_Date_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        $this->actingAs($sender)->postJson(route('Dates.store', $recipient));

        $this->assertDatabaseHas('dates', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'accepted' => false
        ]);
    }

    /** @test */
    public function can_accept_Date_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Date::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'accepted' => false
        ]);

        $this->actingAs($recipient)->postJson(route('request-Dates.store', $sender));

        $this->assertDatabaseHas('Dates', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'accepted' => true
        ]);
    }

}
