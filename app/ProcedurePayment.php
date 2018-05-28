<?php

namespace App;

use Carbon\Carbon;

class ProcedurePayment extends BaseModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'procedure_payment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_relation_id',
        'user_id',
        'name',
        'account_number',
        'account_bank',
        'account_holder',
        'payment_total',
        'installment_total_1',
        'installment_total_2',
        'installment_total_3',
        'installment_date_1',
        'installment_date_2',
        'installment_date_3',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    
    protected $with = [
    ];
    
    public function userRelation() 
    {
        return $this->hasOne('\App\UserRelation', 'id', 'user_relation_id');
    }
    
    public function user() 
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
    
}
