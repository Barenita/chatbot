<?php

namespace App\Http\Controllers;
use App\Message; 
use App\History; 
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\HistoryController;

class MessageController extends Controller
{
    use ApiResponser;
    private static $instance;
    protected $HistoryController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->HistoryController = HistoryController::getInstance();
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Return matching messages
     * @param  Illuminate\Http\Request
     * @return Illuminate\Http\Response
     */
    public function getMatchingMessages(Request $request)
    {
        try{
            $historyRequest = new Request();

            $rules = [
                History::INCOMING_MESSAGE => 'required',
                History::USER_ID => 'required|integer',
            ];

            $this->validate($request, $rules);

            $incoming_message = $request->get(Message::INCOMING_MESSAGE);
            $searchWords = explode(' ', $incoming_message);

            $messages = Message::query();
            foreach($searchWords as $word){
                $messages->Where(Message::INCOMING_MESSAGE, 'LIKE', '%'.$word.'%');
            }

            $messages = $messages->select(Message::ID, Message::OUTGOING_MESSAGE)->distinct()->get();
            
            if($messages->count() == 1)
                $messages = $messages->first(); 
            else
                $messages = Message::select(Message::ID, Message::OUTGOING_MESSAGE)
                            ->Where(Message::INCOMING_MESSAGE, '')
                            ->get()->first();

            $arrayRequest = [
                History::INCOMING_MESSAGE => $incoming_message,
                History::MESSAGE_ID => $messages->id,
                History::USER_ID => $request->get(History::USER_ID)];

            $historyRequest->merge($arrayRequest);
            $this->HistoryController->store($historyRequest);
            
            return $this->successResponse($messages); 
        }
        catch (Exception $e ) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Return messages list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse(Message::all());
    }

    
}
