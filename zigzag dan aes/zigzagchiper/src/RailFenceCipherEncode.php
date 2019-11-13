<?php

include_once 'EncodeMatrix.php';

class RailFenceCipherEncode
{
    public function __construct() {
        $this->matrix = new EncodeMatrix;
    }

    public function encode($plainText, $numberOfRails)
    {
        if (empty($plainText)) {
            throw new InvalidArgumentException('Empty input.\n');
        }
        if ($numberOfRails <=1) {
            throw new InvalidArgumentException('The number of rails must be greater than one.\n');
        }

        $textArray = str_split($plainText);
        $matrix = $this->matrix->getEncodeMatrix($textArray, $numberOfRails);
        $outputString = $this->generateOutput($matrix);
        return $outputString;
    }

    private function generateOutput($matrix)
    {
        $outputString = "";
        foreach ($matrix as $k => $rail) {
            $outputString .= implode("", $rail);
        }
        return str_replace(".", "", $outputString);
    }
}
