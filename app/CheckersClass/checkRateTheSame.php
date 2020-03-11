<?php

namespace App\CheckersClass;

use Exception;
use App\Amount;
use App\AmountRecord;
use App\Item;

class checkRateTheSameClass
{
    public function check($id, $rate)
    {
        $itemrate=Item::find($id);
        if($itemrate->rate == $rate){
            return true;
        }else{
            return false;
        }
    }
}
