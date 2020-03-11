<?php

namespace App\CheckersClass;

use App\Order;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\CheckersClass\checkUserAmountClass;
use App\CheckersClass\checkRateTheSameClass;

class orderCreate
{
    public function new($request, $amount, $bet_object) //order處理
    {
        $user = Auth::user();
        if (checkUserAmountClass::check($user, $amount)) {

            $request = json_decode($request);
            $checkrate = checkRateTheSameClass::check($request->id, $request->rate);
            
            if ($checkrate == false) {
                $error = '賠率已變動';
                return $error;
            }

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
}
