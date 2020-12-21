<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\History;
use App\Message;

class CreateChatHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(History::getTableName(), function (Blueprint $table) {
            $table->bigIncrements(History::ID);
            $table->string(History::INCOMING_MESSAGE);
            $table->unsignedInteger(History::MESSAGE_ID);
            $table->unsignedInteger(History::USER_ID);
            $table->foreign(History::MESSAGE_ID)->references(Message::ID)->on(Message::getTableName());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(History::getTableName());
    }
}
