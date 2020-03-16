<?php

namespace App\CheckersClass;

use App\CheckersClass\updateOrder;
use App\CheckersClass\convertStatus;

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
            $result = $this->getWin($result, $item[4]);

            return $this->alterDataPositive($result, $item);
        }
        if ($item[0] == '輸') {
            $result = $this->getWin($result);

            return $this->alterDataNagtive($result, $item);
        }
        if ($item[0] == '大') {
            $result = $this->getBig($result, $item[4]);

            return $this->alterDataPositive($result, $item);
        }
        if ($item[0] == '小') {
            $result = $this->getBig($result, $item[4]);

            return $this->alterDataNagtive($result, $item);
        }
        if ($item[0] == '單') {
            $result = $this->getSingle($result, $item[4]);

            return $this->alterDataPositive($result, $item);
        }
        if ($item[0] == '雙') {
            $result = $this->getSingle($result, $item[4]);

            return $this->alterDataNagtive($result, $item);
        }
    }

    public function getResult($result) //取得總賽果
    {
        $result = $this->getWin($result);
        if ($result == 1) {

            return '莊家';
        }
        if ($result == 2) {

            return '閒家';
        }
        return '平手';
    }

    public function getWin($result)
    {
        $ob1 = 0;
        $ob2 = 0;
        for ($i = 0; $i <= 2; $i++) {
            if ($result[$i][2]['result'] == '莊家') {
                $ob1++;
            }
            if ($result[$i][2]['result'] == '閒家') {
                $ob2++;
            }
        }
        if ($ob1 >= 2) {

            return 1;
        } elseif ($ob2 >= 2) {

            return 2;
        } else {

            return 0;
        }
    }
    
    public function replaceObject($object)
    {
        if ($object == 1) {
            $object = 'object1';
        } else {
            $object = 'object2';
        }

        return $object;
    }

    public function getBig($result, $object)
    {
        $ob = 0;
        $object = $this->replaceObject($object);


        for ($i = 0; $i <= 2; $i++) {
            $ob += $result[$i][$object]['card'];
        }
        if ($ob > 9 && $ob != 9) {

            return 1;
        } else {

            return false;
        }
    }

    public function getSingle($result, $object)
    {
        $object = $this->replaceObject($object);

        $ob = 0;
        for ($i = 0; $i <= 2; $i++) {
            $ob += $result[$i][$object]['card'];
        }
        if ($ob % 2 == 1) {

            return 1;
        } else {

            return false;
        }
    }

    public function alterDataPositive($result, $item)
    {
        $updatorder = new updateOrder;
        $status = new convertStatus;
        if ($result == $item[4]) {

            $win = $status->convertWinLostStatus('win');
            $error = $updatorder->update($item, $win); //更改訂單狀態 為贏
            if ($error) {

                return $error;
            }
            return '贏';
        } else {
            $lost = $status->convertWinLostStatus('lost');

            $error = $updatorder->update($item, $lost); //更改訂單狀態 為輸
            if ($error) {

                return $error;
            }

            return '輸';
        }
    }

    public function alterDataNagtive($result, $item)
    {
        $updatorder = new updateOrder;
        $status = new convertStatus;

        if ($result != $item[4] && $result != false) {
            $win = $status->convertWinLostStatus('win');
            $error = $updatorder->update($item, $win); //更改訂單狀態 為贏
            if ($error) {

                return $error;
            }
            return '贏';
        } else {
            $lost = $status->convertWinLostStatus('lost');
            $error = $updatorder->update($item, $lost); //更改訂單狀態 為輸
            if ($error) {
                return $error;
            }

            return '輸';
        }
    }
}
