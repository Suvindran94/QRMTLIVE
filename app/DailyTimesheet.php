<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyTimesheet extends Model
{
    use SoftDeletes;
    protected $table = 'daily_timesheet';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [ 'id', 'staffid', 'name', 'dept', 'location', 'daily_date', 'start_work', 'start_lunch', 'end_work', 'end_lunch', 'start_ot', 'end_ot', 'onleave', 'mc', 'status', 'deleted_at', 'created_at', 'createdby', 'updated_at', 'updatedby'];
}
