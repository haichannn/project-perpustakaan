<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group("IndexPageTesting")]
class IndexPageTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function testIndexPageReturnsSuccess()
    {
        $response = $this->get('/books');

        $response->assertStatus(200);
        $response->assertViewIs('books.index');
        $response->assertViewHas('books');
    }
}
