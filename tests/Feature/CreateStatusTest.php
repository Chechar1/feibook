<?php

namespace App;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStatusTest extends TestCase
{
    /**
     @test
     */
    public function a_user_can_create_statuses()
    {
        // 1. Given => Teniendo un usuaio autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);
        // 2. When => Cuando un post request a status
        $this->post(route('status.store'), ['body' => 'Mi primer estado']);
        // 3. Then => Entonces veo un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', [
            'body' => 'Miprimer estado'
        ]);
    }
}
