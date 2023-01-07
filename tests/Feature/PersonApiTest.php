<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_show_all_people()
    {
        $person = Person::factory()
            ->count(10)
            ->create();

        $response = $this->getJson(route('person.index'));
        $response->assertSuccessful();
        $response->assertJsonCount(10);
    }

    /** @test */
    public function should_store_person()
    {
        $person = Person::factory()
            ->make();

        $response = $this->postJson(route('person.store'), $person->toArray());
        $response->assertSuccessful();

        $this->assertDatabaseHas('people', [
            'name'      => $person->name,
            'email'     => $person->email,
            'whatsapp'  => $person->whatsapp,
            'phone'     => $person->phone
        ]);
    }

    /** @test */
    public function should_show_a_person()
    {
        $person = Person::factory()
            ->create();

        $response = $this->getJson(route('person.show', $person));
        $response->assertSuccessful();
    }

    /** @test */
    public function should_update_person()
    {
        $person = Person::factory()
            ->create();
        $payload = [ ... $person->toArray()];
        $payload['name'] = 'Novo nome';

        $response = $this->putJson(route('person.update', $person), $payload);
        $response->assertSuccessful();

        $this->assertDatabaseHas('people', [
            'name'  => 'Novo nome'
        ]);
    }

    /** @test */
    public function should_delete_person()
    {
        $person = Person::factory()
            ->create();

        $response = $this->deleteJson(route('person.destroy', $person));
        $response->assertSuccessful();

        $this->assertDatabaseMissing('people', [
            'name'  => $person->name
        ]);
    }
}
