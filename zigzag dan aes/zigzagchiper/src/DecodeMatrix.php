<?php

include_once 'Rail.php';

class DecodeMatrix
{
    public function __construct() {
        $this->rail = new Rail;
    }

    public function getDecodeMatrix($textArray, $numberOfRails)
    {
        $decodeMatrix = array();
        if ($numberOfRails <=1) {
            throw new InvalidArgumentException('The number of rails must be greater than one.\n');
        }

        $numberOfLetters = count($textArray);
        $rails = $this->rail->getRails($numberOfLetters, $numberOfRails);

        for ($i = 0; $i < $numberOfRails; $i++)
        {
            $rail = array();
            foreach ($rails as $m => $n)
            {
                $rail[$i][] = ".";
                $rail[$n][$m] = "?";
            }
            array_push($decodeMatrix, $rail[$i]);
        }

        $decodeMatrixWithLetters = $this->matchInputWithDecodeMatrix($decodeMatrix, $textArray);
        return $decodeMatrixWithLetters;
    }

    private function matchInputWithDecodeMatrix($decodeMatrix, $textArray)
    {
        foreach ($decodeMatrix as &$rail) {
            foreach ($rail as $k => &$placeholder) {
                foreach($textArray as $l => $letter) {
                    if ($placeholder == "?") {
                        $placeholder = $textArray[$l];
                        unset($textArray[$l]);
                    }
                }
            }
        }
        return $decodeMatrix;
    }
}
