<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Item;
use Exception;
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
        return view('home');
    }

    public function game()
    {

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
        $request = json_decode($request,true);
        print_r($request);
        exit();
        $object1winlost =$request->object1winlost;
        echo $object1winlost['rate'] ;
        // Get the currently authenticated user...
        $user = Auth::user();
        $status = 1; //新建
        $host = 1; //莊家
        $player = 2; //閒家
        try {
            $neworder = Order::new();
            $neworder->create([
                'username' => $user,
                'user_id' => $user->id,
                'item_id' => $request->object1winlost,
                'bet_object' => $host,
                'status' => $status,
                'item_rate' => $object1winlost['rate']
            ]);
        } catch (Exception $e) {
            return $e;
        }
        $request->object1winlost;
    }
}
