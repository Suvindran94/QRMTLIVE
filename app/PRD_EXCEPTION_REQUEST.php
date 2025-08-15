<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PRD_EXCEPTION_REQUEST extends Model
{
    protected $table = 'PRD_EXCEPTION_REQUEST';
    protected $primaryKey = 'ID';
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = ['ID', 'PRD_ID', 'EXCEPTION_TYPE', 'OPER_ID', 'WEIGHT', 'UNIT', 'SCANNED_QRCODE', 'STATUS', 'REMARKS', 'STK_WEIGHT', 'STD_WEIGHT', 'TOLERANCE_WEIGHT', 'TD_DIFF_MINUS', 'TD_DIFF_PLUS', 'BYPASSED_AT', 'BYPASSED_BY', 'CREATED_AT', 'CREATED_BY', 'UPDATED_AT', 'UPDATED_BY'];
}
