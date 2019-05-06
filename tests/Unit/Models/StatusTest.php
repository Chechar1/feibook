<?php

namespace Tests\Unit\Models;

use App\User;
use Tests\TestCase;
use App\Models\Status;
use App\Models\Comment;
use App\Traits\HasLikes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase{

    /** @test */
    public function a_status_model_must_use_the_trait_has_likes()
    {

        $this->assertClassUsesTrait(HasLikes::class, Status::class);
    }
}
