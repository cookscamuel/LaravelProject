<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    // This allows the URL to be displayed with the ID for the specific item.
    protected $primaryKey = 'item_id';
}
