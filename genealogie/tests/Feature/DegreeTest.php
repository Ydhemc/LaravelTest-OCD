<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DegreeTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_degree_with()
    {
        $person84 = Person::factory()->create(['id' => 84]);
        $person1265 = Person::factory()->create(['id' => 1265]);

        $person84->parents()->attach(248);
        $person248 = Person::find(248);
        $person248->children()->attach($person84);

        $degree = $person84->getDegreeWith(1265);

        $this->assertIsInt($degree);
        $this->assertEquals(13, $degree); 

        \Log::info("Degré de parenté: " . $degree);
    }
}
