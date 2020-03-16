<?php

namespace App\CheckersClass;

class gameStart
{

    public function start()
    {
        $object1 = array(1, 2, 3, 4, 5);
        $object2 = array(1, 2, 3, 4, 5);
        shuffle($object1);
        shuffle($object2);

        $result = array();

        for ($i = 0; $i <= 2; $i++) {
            $result[$i] = $this->compare($object1[$i], $object2[$i]);
        }

        $gameend = new gameEnd;
        $finalresult = $gameend->getResult($result);
        $array = array('finalresult' => $finalresult);
        array_push($result, $array);
        return $result;
    }
    public function com($banker, $player)
    {
        if ($banker == $player) {
            $result = array($banker,$player,3);   //平手 設為3

            return $result;
        }

        if($banker==5 && $player==1){
            $result = array($banker,$player,2);   //閒家 贏設為2

            return $result;
        }

        if($banker==1 && $player==5){
            $result = array($banker,$player,1);   //莊家 贏設為1

            return $result;
        }

        if($banker > $player){
            $result = array($banker,$player,1);   //莊家 贏設為1

            return $result;
        }

        if($banker < $player){
            $result = array($banker,$player,2);   //閒家 贏設為2

            return $result;
        }

    }
    public function compare($ob1, $ob2)
    {
        $arrayob = array(
            'object1' => array('card' => $ob1),
            'object2' => array('card' => $ob2)
        );
        if ($ob1 == $ob2) {
            $result = array('result' => '平手');
            array_push($arrayob, $result);

            return $arrayob;
        }
        if ($ob1 == 1 && $ob2 == 5) {
            $result = array('result' => '莊家');
            array_push($arrayob, $result);

            return $arrayob;
        } elseif ($ob1 == 5 && $ob2 == 1) {
            $result = array('result' => '閒家');
            array_push($arrayob, $result);

            return $arrayob;
        } else {
            if ($ob1 - $ob2 > 0) {
                $result = array('result' => '莊家');
                array_push($arrayob, $result);

                return $arrayob;
            } else {
                $result = array('result' => '閒家');
                array_push($arrayob, $result);

                return $arrayob;
            }
        }
    }
}
