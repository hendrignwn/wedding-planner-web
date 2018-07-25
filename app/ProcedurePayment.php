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
        'description',
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
    
    public static function sendPushNotification()
    {
        $models = self::where("installment_date_1", Carbon::now()->toDateString())
                    ->orWhere("installment_date_2", Carbon::now()->toDateString())
                    ->orWhere("installment_date_3", Carbon::now()->toDateString())
                    ->get();
        if (!$models) {
            return null;
        }
        
        foreach ($models as $model) {
            $users = [];
            if ($model->userRelation->getMaleUserIdToken() != null) {
                $users[] = $model->userRelation->getMaleUserIdToken();
            }
            if ($model->userRelation->getFemaleUserIdToken() != null) {
                $users[] = $model->userRelation->getFemaleUserIdToken();
            }
            if (count($users) > 0) {
                $content = 'Segera lakukan pembayaran';
                switch (Carbon::now()->toDateString()) {
                    case $model->installment_date_1:
                        $content = 'Pembayaran sebesar Rp. ' . number_format($model->installment_total_1) . 
                            ' jatuh tempo pada tanggal ' . Carbon::parse($model->installment_date_1)->format('d M Y') . 
                            '. Total Keseluruhan Pembayaran sebesar Rp. ' . number_format($model->payment_total);
                        break;
                    case $model->installment_date_2:
                        $content = 'Pembayaran sebesar Rp. ' . number_format($model->installment_total_2) . 
                            ' jatuh tempo pada tanggal ' . Carbon::parse($model->installment_date_2)->format('d M Y') . 
                            '. Total Keseluruhan Pembayaran sebesar Rp. ' . number_format($model->payment_total);
                        break;
                    case $model->installment_date_3:
                        $content = 'Pembayaran sebesar Rp. ' . number_format($model->installment_total_3) . 
                            ' jatuh tempo pada tanggal ' . Carbon::parse($model->installment_date_3)->format('d M Y') . 
                            '. Total Keseluruhan Pembayaran sebesar Rp. ' . number_format($model->payment_total);
                        break;
                }
                
                $message = Message::where('procedure_payment_id', $model->id)->first();
                if (!$message) {
                    $message = new Message();   
                    $message->created_at = Carbon::now()->toDateTimeString();
                }
                $message->procedure_payment_id = $model->id;
                $message->user_relation_id = $model->user_relation_id;
                $message->name = 'Pembayaran: ' . $model->name;
                $message->description = $content;
                $message->file = 'default.png';
                $message->start_date = Carbon::now()->toDateString();
                $message->end_date = Carbon::now()->addDay()->toDateString();
                $message->is_all_date = 0;
                $message->status = self::STATUS_ACTIVE;
                $message->message_at = Carbon::now()->toDateTimeString();
                $message->updated_at = Carbon::now()->toDateTimeString();
                $message->save();
                
                $fields = [
                    'app_id' => 'c054887d-802a-4395-9603-51e82b790459',
                    'data' => [
                        'id' => $model->id,
                        'name' => $model->name,
                    ],
                    'contents' => [
                        'en' => $content,
                    ],
                    'headings' => [
                        'en' => "Pembayaran: " . $model->name,
                    ],
                    'include_player_ids' => $users,
                    'badge_count' => 1
                ];

                $notification = json_encode($fields);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json; charset=utf-8',
                    'Authorization: Basic MTFmN2ZlZDItZjMxOS00YWRlLTg2YzEtYzkyNmY0NWM4OTQy'
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $notification);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                $response = curl_exec($ch);
                curl_close($ch);

                \Illuminate\Support\Facades\Log::info('Procedure Preparation Send Notification Success with params ' . $notification);
                \Illuminate\Support\Facades\Log::info('Procedure Preparation Send Notification Success with response ' . $response);
            }
        }
    }
    
}
