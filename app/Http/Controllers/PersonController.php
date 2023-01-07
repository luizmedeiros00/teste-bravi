<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Person::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonRequest $request)
    {
        try {
            $person = Person::create($request->validated());
            return response('operação realizada com sucesso', 200);
        } catch (\Exception $e) {
            return response('Aconteceu algum erro', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return response($person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        try {
            $person->update($request->validated());
            return response('operação realizada com sucesso', 200);
        } catch (\Exception $e) {
            return response('Aconteceu algum erro', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        try {
            $person->delete();
            return response('operação realizada com sucesso', 200);
        } catch (\Exception $e) {
            return response('Aconteceu algum erro', 500);
        }
    }
}
