<?php

namespace App\Scores;

class ScoresOperation
{
    public function showScore($score, $dealer) {
        if ($dealer == true) {
            switch ($score) {
                case 1100:
                    return 500;
                    break;
                case 2000:
                    return 1000;
                    break;
                case 4000:
                    return 2000;
                    break;
                case 7900:
                    return 3900;
                    break;
                case 1500:
                    return 700;
                    break;
                case 2700:
                    return 1300;
                    break;
                case 5200:
                    return 2600;
                    break;
                case 1600:
                    return 800;
                    break;
                case 3200:
                    return 1600;
                    break;
                case 6400:
                    return 3200;
                    break;
                case 2400:
                    return 1200;
                    break;
                case 4700:
                    return 2300;
                    break;
                default:
                    return $score/2;
                    break;
            }
        } else {
            switch ($score) {
                case 1100:
                    return 300;
                    break;
                case 2000:
                    return 500;
                    break;
                case 4000:
                    return 1000;
                    break;
                case 7900:
                    return 2000;
                    break;
                case 1500:
                    return 400;
                    break;
                case 2700:
                    return 700;
                    break;
                case 5200:
                    return 1300;
                    break;
                case 1600:
                    return 400;
                    break;
                case 3200:
                    return 800;
                    break;
                case 6400:
                    return 1600;
                    break;
                case 2400:
                    return 600;
                    break;
                case 4700:
                    return 1200;
                    break;
                default:
                    return $score/4;
                    break;
            }
        }
    }

    public function genten($score) {
        return "<font color=\"red\">" . -$score . "</font>";
    }

    public function ryuukyoku($check, $h_player, $turn, $wantscore) {
        $counttenpai = 0;
        $tenpai = array();

        for ($i=0; $i<4; $i++){
            $tenpai[$i] = false;
        }

        //聴牌分岐
        if ($h_player-5 >= 8) {
            $tenpai[3] = true;
            if ($h_player-5-8 >= 4){
                $tenpai[2] = true;
                if ($h_player-5-8-4 >= 2) {
                    $tenpai[1] = true;
                    if ($h_player-5-8-4-2 == 1) {
                        $tenpai[0] = true;
                    } else {
                        $tenpai[0] = false;
                    }
                } else {
                    $tenpai[1] = false;
                    if ($h_player-5-8-4 == 1) {
                        $tenpai[0] = true;
                    } else {
                        $tenpai[0] = false;
                    }
                }
            } else {
                $tenpai[2] = false;
                if ($h_player-5-8 >= 2) {
                    $tenpai[1] = true;
                    if ($h_player-5-8-2 == 1) {
                        $tenpai[0] = true;
                    } else {
                        $tenpai[0] = false;
                    }
                } else {
                    $tenpai[1] = false;
                    if ($h_player-5-8 == 1) {
                        $tenpai[0] = true;
                    } else {
                        $tenpai[0] = false;
                    }
                }
            }
        } else {
            $tenpai[3] = false;
            if ($h_player-5 >= 4){
                $tenpai[2] = true;
                if ($h_player-5-4 >= 2) {
                    $tenpai[1] = true;
                    if ($h_player-5-4-2 == 1) {
                        $tenpai[0] = true;
                    } else {
                        $tenpai[0] = false;
                    }
                } else {
                    $tenpai[1] = false;
                    if ($h_player-5-4 == 1) {
                        $tenpai[0] = true;
                    } else {
                        $tenpai[0] = false;
                    }
                }
            } else {
                $tenpai[2] = false;
                if ($h_player-5 >= 2) {
                    $tenpai[1] = true;
                    if ($h_player-5-2 == 1) {
                        $tenpai[0] = true;
                    } else {
                        $tenpai[0] = false;
                    }
                } else {
                    $tenpai[1] = false;
                    if ($h_player-5 == 1) {
                        $tenpai[0] = true;
                    } else {
                        $tenpai[0] = false;
                    }
                }
            }
        }


        //聴牌者の数
        for ($i=0; $i<4; $i++) {
            if ($tenpai[$i] == true) {
                $counttenpai++;
            }
        }

        for ($i=0; $i<4; $i++) {
            if ($check == (((int)($turn/100)%4)+$i)%4){
                if ($wantscore == false) {
                    return $tenpai[$i];
                } else {
                    if ($tenpai[$i] == true) {
                        if ($counttenpai == 4) {
                            return 0;
                        } else if ($counttenpai == 3) {
                            return 1000;
                        } else if ($counttenpai == 2) {
                            return 1500;
                        } else if ($counttenpai == 1) {
                            return 3000;
                        }
                    } else {
                        if ($counttenpai == 3) {
                            return $this->genten(3000);
                        } else if ($counttenpai == 2) {
                            return $this->genten(1500);
                        } else if ($counttenpai == 1) {
                            return $this->genten(1000);
                        } else if ($counttenpai == 0) {
                            return 0;
                        }
                    }
                }
            }
        }
    }
}