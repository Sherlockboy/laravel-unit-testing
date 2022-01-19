<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    private CheckoutService $service;

    public function __construct()
    {
        $this->service = new CheckoutService([
            'FR1' => ['get_one_free', 1, 3.11],
            'SR1' => ['discount', 3, 4.5]
        ]);
    }

    public function index()
    {
        return view('products', [
            'products' => $this->service->get_products(),
            'total_price' => $this->service->calculateTotal()
        ]);
    }

    public function scan($product_code): RedirectResponse
    {
        $this->service->scan($product_code);

        return redirect()->route('products.index');
    }
}
