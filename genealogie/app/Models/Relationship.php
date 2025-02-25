<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'child_id', 'created_by'];

    public function parent()
    {
        return $this->belongsTo(Person::class, 'parent_id');
    }

    public function child()
    {
        return $this->belongsTo(Person::class, 'child_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
