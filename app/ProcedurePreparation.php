<?php

namespace App;

use Carbon\Carbon;

class ProcedurePreparation extends BaseModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'procedure_preparation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_relation_id',
        'user_id',
        'name',
        'venue',
        'preparation_at',
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
        $models = self::whereRaw("DATE_FORMAT(DATE_SUB(preparation_at, INTERVAL 1 HOUR), '%Y-%m-%d %H') = '" . Carbon::now()->format('Y-m-d H') . "'")
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
            $message = Message::where('procedure_preparation_id', $model->id)->first();
            if (!$message) {
                $message = new Message();   
                $message->created_at = Carbon::now()->toDateTimeString();
            }
            $message->procedure_preparation_id = $model->id;
            $message->user_relation_id = $model->user_relation_id;
            $message->name = 'Persiapan: ' . $model->name;
            $message->description = 'Tanggal ' . Carbon::parse($model->preparation_at)->format('d M Y H:i') . ' dan bertempat di ' . $model->venue;
            $message->start_date = Carbon::parse($model->preparation_at)->toDateString();
            $message->file = 'default.jpg';
            $message->end_date = Carbon::parse($model->preparation_at)->addDay()->toDateString();
            $message->is_all_date = 0;
            $message->status = self::STATUS_ACTIVE;
            $message->message_at = Carbon::now()->toDateTimeString();
            $message->updated_at = Carbon::now()->toDateTimeString();
            $message->save();
            
            if (count($users) > 0) {
                $fields = [
                    'app_id' => 'c054887d-802a-4395-9603-51e82b790459',
                    'data' => [
                        'id' => $model->id,
                        'name' => $model->name,
                        'venue' => $model->venue,
                        'preparation_at' => $model->preparation_at,
                    ],
                    'contents' => [
                        'en' => strip_tags(substr("Bertempat di " . $model->venue . " " . Carbon::parse($model->preparation_at)->format('d M Y H:i'), 0, 80)),
                    ],
                    'headings' => [
                        'en' => "Persiapan: " . $model->name,
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
