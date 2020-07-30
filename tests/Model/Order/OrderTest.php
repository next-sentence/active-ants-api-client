<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\tests\Model\Order;

use LWC\ActiveAnts\Model\Order\Order;
use LWC\ActiveAnts\tests\Model\BaseModelTest;

class VariantTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "externalOrderNumber": 123
}
JSON;
        $model = Order::createFromArray(json_decode($json, true));
        $this->assertEquals('123', $model->getExternalOrderNumber());
    }
}
