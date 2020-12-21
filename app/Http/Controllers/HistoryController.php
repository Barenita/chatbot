<?php

namespace App\Http\Controllers;
use App\History; 
use App\Message; 
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HistoryController extends Controller
{
    use ApiResponser;
    private static $instance;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Create an instance of History
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            History::INCOMING_MESSAGE => 'required',
            History::MESSAGE_ID => 'required|integer|exists:'.Message::getTableName().','.Message::ID,
            History::USER_ID => 'required|integer',
        ];

        $this->validate($request, $rules);

        $history = History::create($request->all());

        return $this->successResponse($history, Response::HTTP_CREATED);
    }

    /**
     * Return history list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $history = History::with([
                History::REL_MESSAGE
            ])->get();
        return $this->successResponse($history);
    }

    /**
     * Return chat history by user
     * @param  int $user_id
     * @return Illuminate\Http\Response
     */
    public function getHistoryByUser($user_id)
    {
        $history = History::with([
            History::REL_MESSAGE
        ])->get();
        $history = History::where(History::USER_ID, $user_id)
                            ->with([
                                History::REL_MESSAGE
                            ])->get();

        return $this->successResponse($history); 
    }
}