<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use MongoDB\Client;
use MongoDB\Database;

class DBTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $connection = DB::connection('mongodb');
        $this->assertInstanceOf(Database::class, $connection->getMongoDB());
        $this->assertInstanceOf(Client::class, $connection->getMongoClient());
    }
}
