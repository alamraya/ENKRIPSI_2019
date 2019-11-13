<?php

class Rail
{
    public function getRails($numberOfLetters, $numberOfRails)
    {
        //todo: error handling: throw exception if empty
        $n = $numberOfRails - 1;
        $matrixIndices = array();
        for ($i=0; $i<$numberOfLetters; $i++)
        {
            $descent = $this->isDescending($numberOfRails, $i);
            if ($descent) {
                $matrixIndices[$i] = $i % $n;
            } else {
                $matrixIndices[$i] = $n - ($i % $n);
            }
        }
        return $matrixIndices;
    }

    private function isDescending($numberOfRails, $letterIndex)
    {
        $quotient = $letterIndex / ($numberOfRails - 1);
        if (floor($quotient) & 1) {
            //odd
            return false;
        } else {
            //even
            return true;
        }
    }
}
