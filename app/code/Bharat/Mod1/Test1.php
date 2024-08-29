<?php
namespace Bharat\Mod1;

class Test1
{
    protected $dataArray;
    protected $textString;

    public function __construct(
        array $dataArray,
        string $textString
    ) {
        $this->dataArray = $dataArray;
        $this->textString = $textString;
    }

    public function displayParams()
    {
        print_r("Array: ");
        print_r($this->dataArray);
        print_r("String: " . $this->textString);
    }
}
