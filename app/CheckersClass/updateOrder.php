<?php

namespace App\CheckersClass;

use App\Order;
use Exception;
use Illuminate\Support\Facades\Auth;


class updateOrder
{
    public function update($item, $status)
    {
        $user = new Auth;
        $order = new Order;
        try {
            $order
                ->where('item_id', $item[1])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->first()
                ->update(['status' => $status]);
        } catch (Exception $e) {
            return $e;
        }
    }
}
