<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\CheckersClass\gameStart;
use App\CheckersClass\gameEnd;
use App\CheckersClass\orderCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\CheckersClass\setItemname;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user['manage_rate'] == 1) {
            return view('home', [
                'item' => true
            ]);
        }
        return view('home', [
            'item' => false
        ]);
    }
   
    public function game()
    {
        if (!Redis::get('isItemSetyet')) {
            $setitemname = new setItemname;
            $setitemname->setItemname();
        }
        return view('game', [
            'win' => json_decode(Redis::get('贏'), true),
            'lost' => json_decode(Redis::get('輸'), true),
            'big' => json_decode(Redis::get('大'), true),
            'small' => json_decode(Redis::get('小'), true),
            'single' => json_decode(Redis::get('單'), true),
            'double' => json_decode(Redis::get('雙'), true),
            'items' => json_decode(Redis::get('Item'), true),
        ]);
    }

    public function clientorder(Request $request)
    {
        $gamestart = new gameStart;
        //dd($request->order);
        $request =$request->order;
        // $re =json_decode($request->order);
        // dd($re);
        // dd($request);
        // exit;
       
        if ($request != "true") {
            foreach ($request as $item) {
                $error = orderCreate::new($item);
            }
            if ($error == null) {
                $gameend = new gameEnd;

                $result = $gamestart->start();
                $gameend->end($request, $result);
                return $result;
            } else {
                return $error;
            }
        } else {
            $result = $gamestart->start();
            return $result;
        }
    }
}
