<?php

namespace App\Models;

use App\Traits\GetSettings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, GetSettings;
}
