<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    // This allows the URL to be displayed with the ID for the specific category.
    protected $primaryKey = 'category_id';
}
