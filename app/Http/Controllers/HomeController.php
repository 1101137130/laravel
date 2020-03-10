<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Item;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Amount;
use App\AmountRecord;

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
    //檢查客戶金額是否足夠
    public function checkUserAmount($user, $amount)
    {

        $amountmodel = Amount::where('user_id', $user->id)->first();
        $useramount = $amountmodel->amount;
        if ($useramount == null) {
            $error = '找不到您的金額紀錄';
            return $error;
        } elseif ($useramount <= 0 or $useramount <= $amount) {
            $error = '您的存款不足';
            return $error;
        } else {
            $updateamount = $useramount - $amount;
            try {
                Amountrecord::create(['user_id' => $user->id, 'amount' => $amount, 'status' => 1]);
                $amountmodel->update(['amount' => $updateamount]);
                return true;
            } catch (Exception $e) {
                $error = $e;
                return $error;
            }
        }
    }

    public function neworder($request, $amount, $bet_object) //order處理
    {
        $user = Auth::user();
        if ($this->checkUserAmount($user, $amount)) {

            $request = json_decode($request);

            if ($request != false) {
                try {
                    Order::create([
                        'username' => $user->username,
                        'user_id' => $user->id,
                        'item_id' => $request->id,
                        'amount' => $amount,
                        'bet_object' => $bet_object,
                        'status' => 1, //新建
                        'item_rate' => $request->rate
                    ]);
                } catch (Exception $error) {
                    return $error;
                }
            }
        } else {
            return $error;
        }
    }
    public function clientorder(Request $request)
    {
        //object1 指得是莊家 winlost指的是輸贏
        //object2 指得是莊家
        $object1winlostamount = $request->object1winlostamount;
        $object2winlostamount = $request->object2winlostamount;
        $object1bigsmallamount = $request->object1bigsmallamount;
        $object2bigsmallamount = $request->object2bigsmallamount;
        $object1singledobleamount = $request->object1singledobleamount;
        $object2singledobleamount = $request->object2singledobleamount;

        $error = null;

        //判斷客戶是否有下住 如果有就新增一張注單
        if ($object1winlostamount != null) {
            $error = $this->neworder($request->object1winlost, $object1winlostamount, 1);
        }
        if ($object2winlostamount != null) {
            $error = $this->neworder($request->object2winlost, $object2winlostamount, 2);
        }
        if ($object1bigsmallamount != null) {
            $error = $this->neworder($request->object1bigsmall, $object1bigsmallamount, 1);
        }
        if ($object2bigsmallamount != null) {
            $error = $this->neworder($request->object2bigsmall, $object2bigsmallamount, 2);
        }
        if ($object1singledobleamount != null) {
            $error = $this->neworder($request->object1singledoble, $object1singledobleamount, 1);
        }
        if ($object2singledobleamount != null) {
            $error = $this->neworder($request->object2singledoble, $object2singledobleamount, 2);
        }
        if ($error == null) {
            $request->session()->flash('status', '下單成功！');
        } else {
            $request->session()->flash('status', '下單失敗！');
        }

        return redirect('game');
    }
}
