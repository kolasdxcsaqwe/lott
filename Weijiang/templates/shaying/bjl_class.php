<?php

class bjl {

    private $per = 180;
    private $feng = 10;
    private $start = "00:00:00";
    private $end = "23:59:59";
    private $open = 1;
    private $init_time = "2018-04-13";
    private $init_no = 203166;

    public function __construct() {
        
    }
    public function Result($player, $bank) {
        $res = array();
		$kkp=array();
		$kkb=array();
        foreach ($player as $key => $value) {
            $zhi = $value % 13 + 1;
			$kkp[]=$zhi;
            $p+=($zhi >= 10 ? 0 : $zhi);
        }
        foreach ($bank as $key => $value) {
            $zhi = $value % 13 + 1;
			$kkb[]=$zhi;
            $b+=($zhi >= 10 ? 0 : $zhi);
        }
        if ($p % 10 > $b % 10) {
            $res[] = "PlayerWin";
        } elseif ($p % 10 < $b % 10) {
            $res[] = "BankerWin";
        } else {
            $res[] = "Draw";
        }
        if (count($player) == 2 && count($bank) == 2) {
            $res[] = "SML";
        }else{
            $res[] = "BIG";
        }
        if (count(array_unique($kkb)) < count($kkb)) {
            $res[] = "BankerPair";
            $res[] = "AnyPair";
        }
        if (count(array_unique($kkp)) < count($kkp)) {
            $res[] = "PlayerPair";
            $res[] = "AnyPair";
        }
		return $res;
    }

    public function getPB($data) {
        $data=  explode(',', $data);
        $p = array();
        $b = array();
        foreach ($data as $key => $value) {
            if ($key % 2 == 0) {
                $p[] = $value;
            } else {
                $b[] = $value;
            }
        }
        return array(
            'p' => $p,
            'b' => $b
        );
    }
    public function HtmlCard($data) {
        $res = array();
        foreach ($data as $key => $value) {
            $zhi = $value % 13 + 1;
			if($zhi==11){
				$zhi='J';
			}
			if($zhi==12){
				$zhi='Q';
			}
			if($zhi==13){
				$zhi='K';
			}
            $key = floor($value / 13);
            switch ($key) {
                case 0:
                    $zhi = '♠' . $zhi;
                    break;
                case 1:
                    $zhi = '♥' . $zhi;
                    break;
                case 2:
                    $zhi = '♦' . $zhi;
                    break;
                case 3:
                    $zhi = '♣' . $zhi;
                    break;
            }

            $res[] = $zhi;
        }
        return $res;
    }

    public function newCode() {
   //     $cur = $this->get_period_info($this->getTodayCur());

            $poker = array();
            for ($index = 0; $index < 22; $index++) {
                $poker[$index] = $index;
            }
            //开奖号码
            $code = array();
            $rank = array_rand($poker, 6);
            //实际点数
            $p = 0;
            $b = 0;
            //有效点数
            $yxp = 0;
            $yxb = 0;

            $poker1 = $rank[0] % 13 + 1;
            $poker1 = $poker1 >= 10 ? 0 : $poker1;
            $p+=$poker1;
            $code[] = $rank[0];

            $poker2 = $rank[1] % 13+1;
            $poker2 = $poker2 >= 10 ? 0 : $poker2;
            $b+=$poker2;
            $code[] = $rank[1];

            $poker3 = $rank[2] % 13+1;
            $poker3 = $poker3 >= 10 ? 0 : $poker3;
            $p+=$poker3;
            $code[] = $rank[2];

            $poker4 = $rank[3] % 13+1;
            $poker4 = $poker4 >= 10 ? 0 : $poker4;
            $b+=$poker4;
            $code[] = $rank[3];

            $yxp = $p % 10;
            $yxb = $b % 10;
            if ($yxp == 8 || $yxp == 9 || $yxb == 8 || $yxb == 9) {
                
            } else {

                $poker5 = $rank[4] % 13;
                $poker5 = $poker5 >= 10 ? 0 : $poker5;
                $p+=$poker5;
                $code[] = $rank[4];
                $yxp = $p % 10;
                $yxb = $b % 10;
                if ($yxp < $yxb) {
                    
                } else {
                    $poker6 = $rank[5] % 13;
					if($poker6>=10){
						$poker6=0;
					}
                    $b+=$poker6;
                    $code[] = $rank[5];
                }
            }
            $code_str=  implode(",", $code);
            //$code_str = set_opencode(10, $cur["periodNumber"], $code_str);
			//$code_str="0,13,1,14,2,15";
            //insert_query('fn_open', array('term' => $cur["periodNumber"], 'code' => $code_str, 'time' =>$cur["awardTime"] , 'type' => 10, 'next_term' => $cur["periodNumber"] + 1, 'next_time' => $cur["next_awardTime"]));
            return $code_str;
        
    }

    public function getErr($no) {
        $data = array(
            1 => '彩种未开启',
            2 => '彩种今日已结束',
            3 => '彩种今日未开始',
        );
        return $data[$no];
    }

    public function getTodayCur() {
        if (!$this->open) {
            return FALSE;
        } else {
            if (time() > strtotime(date("Y-m-d {$this->end}"))) {
                return FALSE;
            } elseif (time() < strtotime(date("Y-m-d {$this->start}"))) {
                return FALSE;
            }

            $now2begin = time() - strtotime(date("Y-m-d {$this->start}"));
            $periodNumber = floor($now2begin / $this->per);
            return $periodNumber;
        }
    }

    public function get_period_info($day_no) {
        //初始设置的日期和初始期数
        $days = (strtotime(date("Y-m-d")) - strtotime($this->init_time)) / (3600 * 24);
        //根据当前设置计算每天开奖期数
        $day_c = ceil((strtotime(date("Y-m-d {$this->end}")) - strtotime(date("Y-m-d {$this->start}")) ) / $this->per);

        //从初始日期到现在日期的期数
        $num1 = $days * $day_c;
        $periodNumber = $this->init_no + $num1 + $day_no;
        $stm = strtotime(date("Y-m-d {$this->start}")) + $day_no * $this->per;
        $awardTime = date("Y-m-d H:i:s", $stm);
        $awardTime1 = date("Y-m-d H:i:s", $stm + $this->per);
        return array(
            'periodNumber'      => $periodNumber,
            'awardTime'         => $awardTime,
            'next_periodNumber' => $periodNumber + 1,
            'next_awardTime'    => $awardTime1,
        );
    }

    public function getNex() {
        
    }

    public function kj() {
        
    }

    public function pj() {
        
    }

}
