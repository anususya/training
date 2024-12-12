<?php
namespace Fakedata;

use Exception as Exception;

class IndexController
{
    private const TABLE = 'products';
    private const COLUMN_NAME = 'product_id';
    private const TO = 1000000;

    public function generate(): void
    {
        try {
            $db = DB::getConnection();
            $from = $db->getMaxValue(self::TABLE, self::COLUMN_NAME) + 1;

            $generator = new GenerateData();
            foreach ($generator->generateFakeData($from, self::TO) as $value) {
                if ($value != null) {
                    $db->insert(self::TABLE, $value);
                }
            }
            DB::closeConnection();

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
