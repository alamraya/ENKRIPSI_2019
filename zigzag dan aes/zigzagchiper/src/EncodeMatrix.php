<?php

include_once 'Rail.php';

class EncodeMatrix
{
    public function __construct() {
        $this->rail = new Rail;
    }

    public function getEncodeMatrix($textArray, $numberOfRails)
    {
        $matrix = array();
        if ($numberOfRails <=1) {
            throw new InvalidArgumentException('The number of rails must be greater than one.\n');
        }

        $numberOfLetters = count($textArray);
        $rails = $this->rail->getRails($numberOfLetters, $numberOfRails);
        $railsToLetters = $this->getRailsToLetters($textArray, $rails);
        for ($i = 0; $i < $numberOfRails; $i++)
        {
            $rail = array();
            foreach ($railsToLetters as $k => $railToLetter)
            {
                if ($i == $railToLetter[0]) {
                    $rail[$i][] = $railToLetter[1];
                } else {
                    $rail[$i][] = ".";
                }
                //todo: it works also without the "." but the tests must be adjusted
            }
            array_push($matrix, $rail[$i]);
        }
        return $matrix;
    }

    private function getRailsToLetters($textArray, $rails)
    {
        $railsToLetters = array();
        foreach ($rails as $index => $element) {
            $railsToLetters[$index] = array($element, $textArray[$index]);
        }
        return $railsToLetters;
    }
}
