<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProblemSolution extends Model
{
    protected $table='problem_solution';
    protected $primaryKey='psoid';
    const DELETED_AT=null;
}
