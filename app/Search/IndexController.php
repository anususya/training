<?php
namespace Search;

use Search\Model\LineSearch as LineSearch;
use Search\Model\BinarySearch as BinarySearch;
use Fakedata\GenerateData;
use Sort\SortFactory;

class IndexController
{
    private array $randomArray = array();
    public array $blockVariables = array();
    public function index(): void
    {
        $generateData = new GenerateData();
        $this->blockVariables['random_array'] = $generateData->generateArray(30);
        $sort = SortFactory::create('bubble');
        $this->blockVariables['sorted_array'] = $sort->sort($this->blockVariables['random_array']);

        include('views/index.phtml');
    }

    public function search(): void
    {
        $search = $_POST['search'] ?? '';
        $array = isset($_POST['array']) ? explode(' ', trim($_POST['array'])) : [];

        $binary = BinarySearch::search($array, $search);
        $line = LineSearch::search($array, $search);

        if ($line[0] == -1) {
            $result = 'Element not found';
        } else {
            $result = [
                'result ' => 'Element found',
                'binary step count' => $binary[1],
                'line step count' => $line[1]
            ];
        }

        echo json_encode($result);
    }
    public function getBlock(): void
    {
        include('views/form.phtml');
    }
}
