<?php

namespace App;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCanCreateStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
    @test
     */
    public function user_can_create_statuses()
    {
        $user = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/')
                    ->type('body', 'Mi primer status')
                    ->press('#create-status')
//                    ->screenshot('create-status')
                    ->assertSee('Mi primer status')
            ;
        });

    }
}
