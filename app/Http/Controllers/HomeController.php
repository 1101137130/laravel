<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\CheckersClass\gameStart;
use App\CheckersClass\gameEnd;
use App\CheckersClass\orderCreate;
use Illuminate\Support\Facades\Auth;

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
        
        if($user['manage_rate'] == 1){
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
        //傳送資料到頁面
        $items = Item::all();
        $win = $items->where('itemname', '贏')->first();
        $lost = $items->where('itemname', '輸')->first();
        $big = $items->where('itemname', '大')->first();
        $small = $items->where('itemname', '小')->first();
        $single = $items->where('itemname', '單')->first();
        $doble = $items->where('itemname', '雙')->first();
        return view('game', [
            'win' => $win,
            'lost' => $lost,
            'big' => $big,
            'small' => $small,
            'single' => $single,
            'doble' => $doble,
            'items' => $items
        ]);
    }

    public function clientorder(Request $request)
    {
        $gamestart = new gameStart;
        $gameend = new gameEnd;
        $request = json_decode($request->order,1);
        
        foreach($request as $item){
            $error = orderCreate::new($item);
        }
        if ($error == null ) {
            
            $result = $gamestart->start();
            
            $gameend->end($request,$result);
            return $result;
        } else {
            return $error;
        }
    }
}
