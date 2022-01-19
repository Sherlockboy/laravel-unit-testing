<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class CheckoutService
{
    private array $pricing_rules;
    private object $products;
    private object $cart;
    private float $total;

    public function __construct(array $pricing_rules)
    {
        $this->pricing_rules = $pricing_rules;
        $this->total = 0;
        $this->products = collect([
            [
                'code' => 'CF1',
                'name' => 'Coffee',
                'price' => 11.23
            ],
            [
                'code' => 'FR1',
                'name' => 'Fruit Tea',
                'price' => 3.11
            ],
            [
                'code' => 'SR1',
                'name' => 'Strawberry',
                'price' => 5.00
            ]
        ]);
        $this->cart = collect();
    }

    public function get_products(): object
    {
        return $this->products;
    }

    public function scan(string $item): void
    {
        $product = $this->find($item);

        $this->addToCart($product);
    }

    private function find(string $code): object
    {
        $product = $this->products->filter(function ($product) use ($code) {
            return collect($product)->get('code') == $code;
        });

        if (!$product) {
            throw new ModelNotFoundException('Product is not found!');
        }

        return $product;
    }

    private function addToCart(object $product)
    {
        $this->cart->push($product);
    }

    public function calculateTotal(): float
    {
        $groups = $this->cart->flatten(1)->groupBy('code')->all();

        foreach ($groups as $code => $group) {
            $rule = $this->pricing_rules[$code] ?? NULL;
            if (!is_null($rule)) {
                $this->total += $this->{$rule[0]}(count($group), $rule[1], $rule[2]);
            } else {
                $this->total += count($group) * $group[0]['price'];
            }
        }

        return $this->total;
    }

    private function get_one_free($count, $rule1, $rule2)
    {
        return ($count - 1) > 0
            ? ($count - 1) * $rule2
            : $rule2;
    }

    private function discount($count, $rule1, $rule2)
    {
        return $count >= 3
            ? $count * $rule2
            : $count * 5.0;
    }
}
