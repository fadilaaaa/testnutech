<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements FromView
{
    private $products;

    public function __construct($products)
    {
        $this->products = $products;
    }
    public function view(): View
    {
        return view('products.export', [
            'products' => $this->products
        ]);
    }
}
