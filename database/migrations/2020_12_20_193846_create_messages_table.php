<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Message;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Message::getTableName(), function (Blueprint $table) {
            $table->bigIncrements(Message::ID);
            $table->string(Message::INCOMING_MESSAGE);
            $table->string(Message::OUTGOING_MESSAGE);
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
        Schema::dropIfExists(Message::getTableName());
    }
}
