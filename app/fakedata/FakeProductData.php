<?php
require_once 'GenerateData.php';
require_once 'DB.php';

class FakeProductData
{
    private const TABLE = 'products';
    private const COLUMN_NAME = 'product_id';
    private const TO = 1000000;

    public function generate()
    {
        $db = DB::getConnection();
        $from = $db->getMaxValue(self::TABLE, self::COLUMN_NAME) + 1;

        $generator = new GenerateData();
        foreach ($generator->generateFakeData($from, self::TO) as $value) {
            if ($value != null) {
                $db->insert(self::TABLE, $value);
            }
        }
        DB::closeConnection();
    }

}
