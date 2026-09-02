<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user_via_factory(): void
    {
        $user = User::factory()->create([
            'name' => 'Mg Mg',
            'email' => 'mgmg@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'mgmg@example.com',
        ]);
    }

    public function test_cannot_create_duplicate_user_email(): void
    {
        User::factory()->create([
            'email' => 'duplicate@example.com',
        ]);

        $this->expectException(QueryException::class);

        User::factory()->create([
            'email' => 'duplicate@example.com',
        ]);
    }

    public function test_database_seeder_seeds_default_test_user(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);
    }
}
