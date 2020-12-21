<?php

use Illuminate\Database\Seeder;
use App\Message;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers = [
            [Message::INCOMING_MESSAGE => '', Message::OUTGOING_MESSAGE => 'Can you ask me different questions?'],
            [Message::INCOMING_MESSAGE => 'How are you?', Message::OUTGOING_MESSAGE => 'I am fine. Thanks.'],
            [Message::INCOMING_MESSAGE => 'Where are located?', Message::OUTGOING_MESSAGE => 'The moon.'],
            [Message::INCOMING_MESSAGE => 'What are your hours?', Message::OUTGOING_MESSAGE => 'After 9 pm.'],
            [Message::INCOMING_MESSAGE => 'You still there?', Message::OUTGOING_MESSAGE => 'Of course here I am.'],
            [Message::INCOMING_MESSAGE => 'What time do you open?', Message::OUTGOING_MESSAGE => 'At 9 am.'],
        ];

        foreach ($answers as $answer){
            DB::table(Message::getTableName())->insert([
                Message::INCOMING_MESSAGE => $answer[Message::INCOMING_MESSAGE], 
                Message::OUTGOING_MESSAGE => $answer[Message::OUTGOING_MESSAGE],
                'created_at' => Carbon::now() 
                ]);
        }
    }
}
