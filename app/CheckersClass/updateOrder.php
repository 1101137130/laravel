<?php

namespace App\CheckersClass;

use App\Order;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\CheckersClass\convertWinLostStatus;

class updateOrder
{
    public function update($item, $status)
    {
        $convertstatuse = new convertStatus;
        $status = $convertstatuse->convertWinLostStatus($status);
        $user = Auth::user();
        $order = new Order;
        try {
            $order
                ->where('item_id', $item[1])
                ->where('user_id', $user->id)
                ->where('bet_object', $item[4])
                ->orderBy('created_at', 'desc')
                ->first()
                ->update(['status' => $status]);
        } catch (Exception $e) {

            return $e;
        }
    }
}
