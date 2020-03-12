<?php

namespace App\CheckersClass;

use App\Order;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\CheckersClass\checkUserAmount;
use App\CheckersClass\checkRateTheSame;

class orderCreate
{
    public static function new($item) //order處理
    {
        //item[0]-> itemname; item[1]->itemid  
        //item[2]-> rate ; item[3] -> amount 
        //item[4]-> ocject 1:莊家 2:閒家

        $user = Auth::user();
        $error = checkUserAmount::check($user, $item[3]);
        if ($error == true) {
            $checkrate = checkRateTheSame::check($item[1], $item[2]);
            if ($checkrate == false) {
                $error = '賠率已變動請重新下單！';
                return $error;
            }

            try {
                Order::create([
                    'username' => $user->username,
                    'user_id' => $user->id,
                    'item_id' => $item[1],
                    'amount' => $item[3],
                    'bet_object' => $item[4],
                    'status' => 1, //新建
                    'item_rate' => $item[2]
                ]);
                
            } catch (Exception $error) {
                return $error;
            }
        } else {
            return $error;
        }
    }
}
