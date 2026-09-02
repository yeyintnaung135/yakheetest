<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_has_fillable_attributes(): void
    {
        $user = new User([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret123',
        ]);

        $this->assertSame('John Doe', $user->name);
        $this->assertSame('john@example.com', $user->email);
    }

    public function test_password_is_automatically_hashed(): void
    {
        $user = new User([
            'password' => 'plain-password',
        ]);

        $this->assertNotSame('plain-password', $user->password);
        $this->assertTrue(Hash::check('plain-password', $user->password));
    }

    public function test_password_and_remember_token_are_hidden_from_serialization(): void
    {
        $user = new User([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'secret123',
            'remember_token' => 'token123',
        ]);

        $array = $user->toArray();

        $this->assertArrayNotHasKey('password', $array);
        $this->assertArrayNotHasKey('remember_token', $array);
    }

    public function test_email_verified_at_is_cast_to_datetime(): void
    {
        $user = new User;
        $user->email_verified_at = '2026-01-01 12:00:00';

        $this->assertInstanceOf(Carbon::class, $user->email_verified_at);
    }
}
