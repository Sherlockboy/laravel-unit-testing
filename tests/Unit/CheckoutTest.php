<?php

namespace Tests\Unit;

use App\Services\CheckoutService;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    private array $pricing_rules = [
        'FR1' => ['get_one_free', 1, 3.11],
        'SR1' => ['discount', 3, 4.5]
    ];

    /**
     * Test case 1
     * FR1,SR1,FR1,FR1,CF1
     * @return void
     */
    public function test_checkout1()
    {
        $ch = new CheckoutService($this->pricing_rules);
        $ch->scan('FR1');
        $ch->scan('SR1');
        $ch->scan('FR1');
        $ch->scan('FR1');
        $ch->scan('CF1');
        $this->assertEquals(22.45, $ch->calculateTotal());
    }

    /**
     * Test case 2
     * FR1,FR1
     * @return void
     */
    public function test_checkout2()
    {
        $ch = new CheckoutService($this->pricing_rules);
        $ch->scan('FR1');
        $ch->scan('FR1');
        $this->assertEquals(3.11, $ch->calculateTotal());
    }

    /**
     * Test case 3
     * SR1,SR1,FR1,SR1
     * @return void
     */
    public function test_checkout3()
    {
        $ch = new CheckoutService($this->pricing_rules);
        $ch->scan('SR1');
        $ch->scan('SR1');
        $ch->scan('FR1');
        $ch->scan('SR1');
        $this->assertEquals(16.61, $ch->calculateTotal());
    }
}
