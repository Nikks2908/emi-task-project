<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    protected $table = 'user'; // singular per assignment
    protected $fillable = ['username','password'];
    protected $hidden   = ['password','remember_token'];
    public function getAuthIdentifierName() { return 'id'; }
    // Username-based auth:
    public function getAuthIdentifier() { return $this->getKey(); }
}

