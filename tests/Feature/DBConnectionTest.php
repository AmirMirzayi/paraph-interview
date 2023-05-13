<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Connection;
use Tests\TestCase;

class DBConnectionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $connection = DB::connection('mongodb');
        $this->assertInstanceOf(Connection::class, $connection);
    }
}
