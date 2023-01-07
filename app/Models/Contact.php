<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['value', 'person_id', 'contact_type_id'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function contactType()
    {
        return $this->belongsTo(ContactType::class);
    }
}
