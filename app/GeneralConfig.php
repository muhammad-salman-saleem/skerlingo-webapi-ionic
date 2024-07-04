<?php

namespace App;

use App\Scopes\AgenceScope;
use Illuminate\Database\Eloquent\Model;

class GeneralConfig extends Model
{
    protected $fillable = [
        'label', 'alias'
    ];
}
