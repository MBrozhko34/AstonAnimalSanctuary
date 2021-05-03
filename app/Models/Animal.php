<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Animal extends Model
{
    use Sortable;
    use HasFactory;
    protected $fillable = ['species','DOB', 'description'];
    public $sortable = ['name','species', 'DOB'];
}
