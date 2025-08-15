<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PRD_TRX extends Model
{
    protected $table = 'PRD_TRX';
    protected $primaryKey = 'ID';
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = ['ID', 'PRD_SEQ_BY_OPER', 'PRD_ID', 'WO_ID', 'WO_QTY','PRD_TRX','SO_NO', 'PACK_METH', 'STK_CODE', 'PBAG', 'TOTAL_STD_BAG', 'CURRENT_SMALL_BAG', 'CURRENT_STD_BAG', 'NUMBER', 'ZONE_ID', 'DEVICE', 'OPER_STAFF_ID', 'START_DATETIME', 'END_DATETIME', 'EXCEPTION', 'EXCEPTION_STATUS', 'PRD_STATUS', 'STEP1', 'STEP2', 'STEP3', 'STEP4', 'STEP5', 'STEP6', 'CURRENTSTEP', 'CREATED_AT', 'UPDATED_AT'];
}
