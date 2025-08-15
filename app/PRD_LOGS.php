<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PRD_LOGS extends Model
{
    protected $table = 'PRD_LOGS';
    protected $primaryKey = 'ID';
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = ['ID', 'LOG_TYPE', 'REF_ID', 'USER_ID', 'PRD_ID', 'WEIGHT', 'UNIT', 'STATUS', 'CURRENT_STD_BAG', 'CURRENT_SMALL_BAG', 'SCANNED_QRCODE', 'STK_WEIGHT', 'STD_WEIGHT', 'TOLERANCE_WEIGHT', 'TD_DIFF_MINUS', 'TD_DIFF_PLUS', 'CREATED_AT', 'UPDATED_AT'];
}
