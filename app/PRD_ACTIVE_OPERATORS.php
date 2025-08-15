<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PRD_ACTIVE_OPERATORS extends Model
{
    protected $table = 'PRD_ACTIVE_OPERATORS';
    protected $primaryKey = 'ID';
    const CREATED_AT = 'TRX_CREATE_DATE';
    const UPDATED_AT = 'TRX_UPD_DATE';

    protected $fillable = ['ID', 'STAFF_ID', 'NAME', 'ZONE', 'TRX_CREATE_DATE', 'TRX_UPD_DATE'];
}
