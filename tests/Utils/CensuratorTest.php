<?php

namespace App\Tests\Utils;

use App\Utils\Censurator;
use PHPUnit\Framework\TestCase;

class CensuratorTest extends TestCase
{
    public function testStringWithBadsWordsIsPurified(): void
    {
        $censurator = new Censurator();
        $purified = $censurator->purify("pif paf pouf pouet");
        $this->assertEquals( "pif paf p*** pouet",$purified);

    }
}
