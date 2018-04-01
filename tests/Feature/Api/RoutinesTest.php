<?php

namespace Tests\Feature\Api;

use App\Routine;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RoutinesTest extends TestCase
{
    use DatabaseMigrations;

    public function testRoutinesAreCreatedCorrectly()
    {
       $body = [
           'user_id' => 1,
           'name' => 'Upper Body Workout A',
       ];

       $this->json('POST', '/api/v1/routines', $body)
           ->assertStatus(201);
    }

    public function testRoutinesAreUpdatedCorrectly()
    {
        $routine = factory(Routine::class)->create();
        
        $body = [
           'user_id' => 2,
           'name' => 'Upper Body Workout B',
        ];
               
        $this->json('PUT', '/api/v1/routines/' . $routine->id, $body)
            ->assertStatus(200)
            ->assertJsonFragment([
                'user_id' => 2,
                'name' => 'Upper Body Workout B',
            ]);
    }

    public function testRoutinesAreListedCorrectly()
    {
        $routine = factory(Routine::class)->create([
            'user_id' => 1,
            'name' => 'Upper Body Workout A'
        ]);

        $response = $this->call('GET', 'api/v1/routines');
        $this->assertEquals(200, $response->status());

        $routines = $response->json();

        $this->assertEquals(1, $routines[0]['id']);
        $this->assertEquals(1, $routines[0]['user_id']);
        $this->assertEquals('Upper Body Workout A', $routines[0]['name']);
    }

    public function testRoutinesAreDeletedCorrectly()
    {
        $routine = factory(Routine::class)->create();

        $this->json('DELETE', 'api/v1/routines/' . $routine->id, [])
        ->assertStatus(204);
    }

    public function testRoutinesBelongToAUser()
    {       
       $user = factory(User::class)->create([
           'id' => 3
       ]);
       
       $routine = factory(Routine::class)->create([
           'user_id' => $user->id
       ]);

       $this->assertEquals($user->id, $routine->user_id);
    }
}
