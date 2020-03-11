<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
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

    public function clientorder(Request $map)
    {
        // $itemid = $request->object1winlost;
        // $rate = 
        // checkRateTheSameClass::check($itemid,$rate);
        //object1 指得是莊家 winlost指的是輸贏 其他以此類推
        //object2 指得是閒家 
        
        //$request = json_decode($request);
        print_r($map->all()) ;
        exit();
        // $object1winlostamount = $request->object1winlostamount;
        // $object2winlostamount = $request->object2winlostamount;
        // $object1bigsmallamount = $request->object1bigsmallamount;
        // $object2bigsmallamount = $request->object2bigsmallamount;
        // $object1singledobleamount = $request->object1singledobleamount;
        // $object2singledobleamount = $request->object2singledobleamount;

        // $error = null;
        // $count = 0;
        // //判斷客戶是否有下注 如果有就新增一張注單
        // if ($object1winlostamount != null) {
        //     $error = orderCreate::new($request->object1winlost, $object1winlostamount, 1);
        //     $count++;
        // }
        // if ($object2winlostamount != null) {
        //     $error =orderCreate::new($request->object2winlost, $object2winlostamount, 2);
        //     $count++;
        // }
        // if ($object1bigsmallamount != null) {
        //     $error =orderCreate::new($request->object1bigsmall, $object1bigsmallamount, 1);
        //     $count++;
        // }
        // if ($object2bigsmallamount != null) {
        //     $error =orderCreate::new($request->object2bigsmall, $object2bigsmallamount, 2);
        //     $count++;
        // }
        // if ($object1singledobleamount != null) {
        //     $error =orderCreate::new($request->object1singledoble, $object1singledobleamount, 1);
        //     $count++;
        // }
        // if ($object2singledobleamount != null) {
        //     $error =orderCreate::new($request->object2singledoble, $object2singledobleamount, 2);
        //     $count++;
        // }

        // if ($error == null && $count != 0) {
        //     $request->session()->flash('status', '下單成功！');
        // } else {
        //     if ($count == 0) {
        //         $request->session()->flash('error', '沒有輸入金額');
        //     } else {
        //         $request->session()->flash('error', '下單失敗！');
        //     }
        // }

        // return redirect('game');
    }
}
