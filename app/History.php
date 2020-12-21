<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'chat_history';

    const ID = "id";
    const INCOMING_MESSAGE = "incoming_message";
    const MESSAGE_ID = "message_id";
    const USER_ID = "user_id";
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';
    const DELETED_AT = 'deleted_at';

    const REL_MESSAGE = "message";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::INCOMING_MESSAGE,
        self::MESSAGE_ID,
        self::USER_ID,
    ];

    protected $hidden = [
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
