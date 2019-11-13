<?php

include_once 'DecodeMatrix.php';

class RailFenceCipherDecode
{
    public function __construct() {
        $this->decodeMatrix = new DecodeMatrix;
    }

    public function decode($string, $numberOfRails)
    {
        if (empty($string)) {
            throw new InvalidArgumentException('Empty input.\n');
        }
        if ($numberOfRails <=1) {
            throw new InvalidArgumentException('The number of rails must be greater than one.\n');
        }

        $textArray = str_split($string);

        $decodeMatrixWithLetters = $this->decodeMatrix->getDecodeMatrix($textArray, $numberOfRails);
        $outputString = $this->getOutputStringFromMatrix($decodeMatrixWithLetters);
        return $outputString;
    }

    private function getOutputStringFromMatrix($decodeMatrixWithLetters)
    {
        $outputArray = array();
        foreach ($decodeMatrixWithLetters as $key => $matrixRail)
        {
            foreach ($matrixRail as $k => $v) {
                if ($v != "."){
                    $outputArray[$k] = $v;
                }
            }
        }
        ksort($outputArray);
        $outputString = "";
        $outputString .= implode("", $outputArray);
        return $outputString;
    }
}
