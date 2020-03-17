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

        return view('game');
    }

    public function data()
    {
        if (!Redis::get('isItemSetyet')) {
            $setitemname = new setItemname;
            $setitemname->setItemname();
        }
        $data = Redis::get('Item');
        $array = json_decode($data, true);
        $data = array();
        for ($i = 0; $i < sizeof($array); $i++) {
            array_push($data, array($array[$i]['id'], $array[$i]['itemname'], $array[$i]['rate']));
        }
        return $data;
    }

    public function clientorder(Request $request)
    {
        $gamestart = new gameStart;
        $ordercreate = new orderCreate;

        $order = $request->order;


        if ($order != "true") {
            foreach ($order as $item) {
                $data = $ordercreate->new($item);

                if ($data[0] != true) {
                    $request->session()->flash('error', $data[1]);

                    return $data[1];
                }
            }
            $gameend = new gameEnd;

            $result = $gamestart->start();
            

            array_push($result, $gameend->end($order, $result));

            return $result;
        } else {
            $result = $gamestart->start();

            return $result;
        }
    }
}
