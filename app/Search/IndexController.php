<?php
namespace Search;

use Search\Model\LineSearch as LineSearch;
use Search\Model\BinarySearch as BinarySearch;
use Search\Model\Search as SearchModel;
use Fakedata\GenerateData;
use Sort\SortFactory;

class IndexController
{
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
        $searchItem= $_POST['search'] ?? '';
        $array = isset($_POST['array']) ? explode(' ', trim($_POST['array'])) : [];
        $search = new SearchModel();
        //$binary = BinarySearch::search($array, $searchItem);
        //$line = LineSearch::search($array, $searchItem);
        $binary = $search->search($searchItem, $array, [$search, 'binarySearch']);
        $line = $search->search($searchItem, $array, [$search, 'lineSearch']);
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
