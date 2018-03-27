<?php

namespace Tests\Feature\Api;

use App\Exercise;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ExerciseTest extends TestCase
{
    use DatabaseMigrations;

    public function testExerciseAreCreatedCorrectly()
    {
        $body = [
            'name' => 'bench press',
            'body_part' => 'chest',
            'description' => 'a chest movement',
        ];

        $this->json('POST', '/api/exercises', $body)
            ->assertStatus(201);
    }

    public function testExerciseAreUpdatedCorrectly()
    {
        $exercise = factory(Exercise::class)->create();

        $body = [
            'name' => 'bench press',
            'body_part' => 'chest',
            'description' => 'a chest movement',
        ];

        $this->json('PUT', '/api/exercises/' . $exercise->id, $body)
            ->assertStatus(200)
            ->assertJson([
                'name' => 'bench press',
                'body_part' => 'chest',
                'description' => 'a chest movement',
            ]);;
    }

    public function testExerciseAreListedCorrectly()
    {
        $exercise = factory(Exercise::class)->create([
            'name' => 'bench press',
            'body_part' => 'chest',
            'description' => 'a chest movement',
        ]);

        $response = $this->call('GET', 'api/exercises');
        $this->assertEquals(200, $response->status());

        $exercises = $response->json();

        $this->assertEquals(1, $exercises[0]['id']);
        $this->assertEquals('bench press', $exercises[0]['name']);
        $this->assertEquals('chest', $exercises[0]['body_part']);
        $this->assertEquals('a chest movement', $exercises[0]['description']);
    }

    public function testExercisesAreDeletedCorrectly()
    {
        $exercise = factory(Exercise::class)->create();

        $this->json('DELETE', 'api/exercises/' . $exercise->id, [])
        ->assertStatus(204);
    }
}
