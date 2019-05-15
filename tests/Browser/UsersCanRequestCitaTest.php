<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\Cita;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCanRequestCitaTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function senders_can_create_and_delete_cita_requests()
    {
        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($sender, $recipient) {
            $browser->loginAs($sender)
                ->visit(route('users.show', $recipient))
                ->press('@request-cita')
                ->waitForText('Cancelar solicitud')
                ->assertSee('Cancelar solicitud')
                ->visit(route('users.show', $recipient))
                ->assertSee('Cancelar solicitud')
                ->press('@request-cita')
                ->waitForText('Solicitar amistad')
                ->assertSee('Solicitar amistad')
            ;
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function recipients_can_accept_and_deny_cita_requests()
    {
        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Cita::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);

        $this->browse(function (Browser $browser) use ($sender, $recipient) {
            $browser->loginAs($recipient)
                ->visit(route('accept-citas.index'))
                ->assertSee($sender->name)
                ->press('@accept-cita')
                ->waitForText('pueden concretar una cita')
                ->assertSee('pueden concretar una cita')
                ->visit(route('accept-citas.index'))
                ->assertSee('pueden concretar una cita')
            ;
        });
    }

}
