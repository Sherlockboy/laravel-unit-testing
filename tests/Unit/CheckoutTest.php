<?php

namespace Tests\Unit;

use App\Services\CheckoutService;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    /**
     * Test case 1
     * FR1,SR1,FR1,FR1,CF1
     * @return void
     */
    public function test_checkout1()
    {
        $pricing_rules = [
            'FR1' => ['get_one_free', 1, 3.11],
            'SR1' => ['discount', 3, 4.5]
        ];
        $co = new CheckoutService($pricing_rules);
        $co->scan('FR1');
        $co->scan('SR1');
        $co->scan('FR1');
        $co->scan('FR1');
        $co->scan('CF1');
        $this->assertEquals(22.45, $co->calculateTotal());
    }
}
