<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    const ID = "id";
    const INCOMING_MESSAGE = "incoming_message";
    const OUTGOING_MESSAGE = "outgoing_message";
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';
    const DELETED_AT = 'deleted_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::INCOMING_MESSAGE,
        self::OUTGOING_MESSAGE,
    ];
    
    protected $hidden = [
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
