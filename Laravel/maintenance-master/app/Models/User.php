<?php

namespace App\Models;

use Adldap\Laravel\Traits\AdldapUserModelTrait;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Orchestra\Model\User as Eloquent;

class User extends Eloquent implements AuthorizableContract
{
    use Authorizable, AdldapUserModelTrait;
}
