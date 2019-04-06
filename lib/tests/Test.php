<?php

use WannaCycle\API\Stadtrad\StadtradController;

/**
 * Created by PhpStorm.
 * User: korbinian
 * Date: 4/6/19
 * Time: 8:07 AM
 */


class Test extends PHPUnit_Framework_TestCase
{
    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            '32810766',
            StadtradController::findStadtradForHvv(new \WannaCycle\API\HVV\HvvLocation('S Othmarschen', 'Hamburg', '12345', 'station',new Coordinate(123,456)))
        );
    }
}
