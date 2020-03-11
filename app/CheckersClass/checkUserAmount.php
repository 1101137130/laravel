<?php

namespace App\CheckersClass;

use Exception;
use App\Amount;
use App\AmountRecord;

class checkUserAmountClass
{
    public function check($user, $amount)
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
}
