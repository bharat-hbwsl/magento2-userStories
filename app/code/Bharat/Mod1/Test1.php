<?php
namespace Bharat\Mod1;

// use Bharat\Mod1\Api\Data\CustomCategoryInterface;

class Test1
{
    // protected $category;
    protected $dataArray;
    protected $textString;

    public function __construct(
        // CustomCategoryInterface $category,
        array $dataArray,
        string $textString
    ) {
        // $this->category = $category;
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
