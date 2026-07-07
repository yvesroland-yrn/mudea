<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AdminMessagesRoutesTest extends TestCase
{
    public function test_admin_messages_routes_are_registered(): void
    {
        $this->assertTrue(Route::has('admin.messages'));
        $this->assertTrue(Route::has('admin.messages.show'));
        $this->assertTrue(Route::has('admin.messages.status'));
    }
}
