<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/api/v1/quotes', ['Accept' => 'application/vnd.api+json'])->assertResponseOk();
    }
}
