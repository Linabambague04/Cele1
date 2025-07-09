<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
   public function userroles(){
        return $this->hasMany(UserRole::class);
   }
}
