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
}

