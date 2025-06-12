<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class SlugGeneratorTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_it_generates_a_slug(): void
    {
        // Define a simple Property stub for testing
        $property = new class(['name' => 'My Beautiful Villa'])
        {
            public $name;

            public function __construct($attributes)
            {
                $this->name = $attributes['name'] ?? null;
            }
        };
        $slug = \Illuminate\Support\Str::slug($property->name);

        $this->assertEquals('my-beautiful-villa', $slug);
    }
}
