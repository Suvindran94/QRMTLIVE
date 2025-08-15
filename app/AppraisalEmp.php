<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class AppraisalEmp extends Model
{
    protected $table = 'appraisal_employee';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'emp_id', 'emp_name', 'emp_position', 'department', 'division', 'section', 'supervisor_id', 'supervisor_name', 'supervisor_position', 'flag', 'form', 'createdBy', 'created_at', 'updatedBy', 'updated_at', 'prev_verify', 'prev_ack', 'status', 'reallocated', 'resign_date', 'resign_reason', 'resign_remarks'];

}
