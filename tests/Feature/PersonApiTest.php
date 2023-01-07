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
            ->has(Contact::factory()->count(4))
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

        $contacts = Contact::factory(4)->make();

        $payload = [...$person->toArray(), 'contacts' => [...$contacts->toArray()]];

        $response = $this->postJson(route('person.store'), $payload);
        $response->assertSuccessful();

        $this->assertDatabaseHas('people', [
            'name'  => $person->name
        ]);

        $this->assertDatabaseCount('contacts', 4);
    }

     /** @test */
     public function should_show_a_person()
     {
         $person = Person::factory()
             ->has(Contact::factory()->count(4))
             ->create();
      
         $response = $this->getJson(route('person.show', $person));
         $response->assertSuccessful();
     }

    /** @test */
    public function should_update_person()
    {
        $person = Person::factory()
            ->has(Contact::factory()->count(4))
            ->create();


        $contacts2 = Contact::factory(5)->make();

        $payload = ['name' => 'Novo nome', 'contacts' => [...$contacts2->toArray()]];

        $response = $this->putJson(route('person.update', $person), $payload);
        $response->assertSuccessful();

        $this->assertDatabaseHas('people', [
            'name'  => 'Novo nome'
        ]);

        $this->assertDatabaseCount('contacts', 5);
    }

    /** @test */
    public function should_delete_person()
    {
        $person = Person::factory()
            ->has(Contact::factory()->count(4))
            ->create();

        $response = $this->deleteJson(route('person.destroy', $person));
        $response->assertSuccessful();

        $this->assertDatabaseMissing('people', [
            'name'  => $person->name
        ]);

        $this->assertDatabaseEmpty('contacts');
    }
}
