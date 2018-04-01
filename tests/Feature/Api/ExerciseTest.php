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
            'description' => 'a chest movement',
            'image_path' => 'http://google.com/images/HSioxhasJ',
        ];


        $this->json('POST', '/api/v1/exercises', $body)
            ->assertStatus(201);
    }

    public function testExerciseAreUpdatedCorrectly()
    {
        $exercise = factory(Exercise::class)->create();

        $body = [
            'name' => 'bench press',
            'description' => 'a chest movement',
            'image_path' => 'http://google.com/images/HSioxhasJ',
        ];

        $this->json('PUT', '/api/v1/exercises/' . $exercise->id, $body)
            ->assertStatus(200)
            ->assertJsonFragment([
                "id" => 1,
                "name" => "bench press",
                "description" => "a chest movement",
                "image_path" => "http://google.com/images/HSioxhasJ",
            ]);
    }

    public function testExerciseAreListedCorrectly()
    {
        $exercise = factory(Exercise::class)->create([
            'name' => 'bench press',
            'description' => 'a chest movement',
            'image_path' => 'http://google.com/images/HSioxhasJ',
        ]);

        $response = $this->call('GET', 'api/v1/exercises');
        $this->assertEquals(200, $response->status());

        $exercises = $response->json();

        $this->assertEquals(1, $exercises[0]['id']);
        $this->assertEquals('bench press', $exercises[0]['name']);
        $this->assertEquals('http://google.com/images/HSioxhasJ', $exercises[0]['image_path']);
        $this->assertEquals('a chest movement', $exercises[0]['description']);
    }

    public function testExercisesAreDeletedCorrectly()
    {
        $exercise = factory(Exercise::class)->create();

        $this->json('DELETE', 'api/v1/exercises/' . $exercise->id, [])
        ->assertStatus(204);
    }
}
