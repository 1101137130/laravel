<?php

namespace App\CheckersClass;

use App\CheckersClass\updateOrder;

class gameEnd
{
    public function end($request, $result)
    {
        foreach ($request as $item) {
            $this->toClientBet($item, $result);
        }
    }
    public function toClientBet($item, $result)
    {
        if ($item[0] == '贏') {
            $this->win($item, $result);
        }
        if ($item[0] == '輸') {
            $this->lost($item, $result);
        }
        if ($item[0] == '大') {
            $this->big($item, $result);
        }
        if ($item[0] == '小') {
            $this->small($item, $result);
        }
        if ($item[0] == '單') {
            $this->single($item, $result);
        }
        if ($item[0] == '雙') {
            $this->double($item, $result);
        }
    }

    public function winlost($result)
    {
        $ob1 = 0;
        $ob2 = 0;
        for ($i = 0; $i <= 2; $i++) {
            if ($result[$i][0]['result'] == '莊家') {
                $ob1++;
            }
            if ($result[$i][0]['result'] == '閒家') {
                $ob2++;
            }
        }
        if ($ob1 >= 2) {
            return 1;
        } elseif ($ob2 >= 2) {
            return 2;
        } else {
            return false;
        }
    }

    public function bigsmall($result)
    {
        $ob1 = 0;
        $ob2 = 0;
        for ($i = 0; $i <= 2; $i++) {
            $ob1 += $result[$i]['object1']['card'];
            $ob2 += $result[$i]['object2']['card'];
        }
        if ($ob1 > $ob2) {
            return 1;
        } elseif ($ob1 < $ob2) {
            return 2;
        } else {
            return false;
        }
    }

    public function singledouble($result)
    {
        $ob1 = 0;
        $ob2 = 0;
        for ($i = 0; $i <= 2; $i++) {
            $ob1 += $result[$i]['object1']['card'];
            $ob2 += $result[$i]['object2']['card'];
        }
        if ($ob1 % 2 == 1) {
            return 1;
        } elseif ($ob2 % 2 == 1) {
            return 2;
        } else {
            return false;
        }
    }
    public function win($item, $result)
    {
        $result = $this->winlost($result);
        return $this->alterDataPositive($result,$item);

    }

    public function lost($item, $result)
    {
        $result = $this->winlost($result);
        return $this->alterDataNagtive($result,$item);
    }

    public function big($item, $result)
    {
        $result = $this->bigsmall($result);
        return $this->alterDataPositive($result,$item);

    }

    public function small($item, $result)
    {
        $result = $this->bigsmall($result);
        return $this->alterDataNagtive($result,$item);
    }

    public function single($item, $result)
    {
        $result = $this->singledouble($result);
        return $this->alterDataPositive($result,$item);
    }
    public function double($item, $result)
    {
        $result = $this->singledouble($result);
        return $this->alterDataNagtive($result,$item);
    }
    public function alterDataPositive($result,$item)
    {
        $updatorder = new updateOrder;

        if ($result == $item[4] ) {
            $error = $updatorder->update($item, 2); //更改訂單狀態 為贏
            if ($error) {
                return $error;
            }
            return '贏';
        } else {
            $error = $updatorder->update($item, 3); //更改訂單狀態 為輸
            if ($error) {
                return $error;
            }
            return '輸';
        }
    }

    public function alterDataNagtive($result,$item)
    {
        $updatorder = new updateOrder;

        if ($result != $item[4] && $result != false) {
            $error = $updatorder->update($item, 2); //更改訂單狀態 為贏
            if ($error) {
                return $error;
            }
            return '贏';
        } else {
            $error = $updatorder->update($item, 3); //更改訂單狀態 為輸
            if ($error) {
                return $error;
            }
            return '輸';
        }
    }
}
