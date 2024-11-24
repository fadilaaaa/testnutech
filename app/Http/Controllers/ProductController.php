<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');
        $category = request('category') ?? '';

        $products = Product::where('name', 'like', "%$search%");
        if ($category != '') {
            $products = $products->where('category_id', $category);
        }
        $products = $products->orderBy('updated_at', 'desc')->paginate(10);

        $query = [
            'search' => $search,
            'category' => $category
        ];
        $categories = Category::all();
        return response(view(
            'products.index',
            compact('products', 'categories', 'query')
        ));
    }
    public function export()
    {
        $search = request('search');
        $category = request('category') ?? '';

        $products = Product::where('name', 'like', "%$search%");
        if ($category != '') {
            $products = $products->where('category_id', $category);
        }
        $products = $products->orderBy('updated_at', 'desc')->get();
        return Excel::download(new ProductExport($products), 'products.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return response(view('products.create', compact('categories')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'selling_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'stock' => 'required|integer',
            'foto' => 'required|image|mimes:png,jpg|max:100',
        ]);

        $fotoPath = $request->file('foto')->store('product_images', 'public');

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'selling_price' => $request->selling_price,
            'purchase_price' => $request->purchase_price,
            'stock' => $request->stock,
            'foto' => "storage/" . $fotoPath,
        ]);

        return response(
            redirect()
                ->route('products.index')
                ->with('success', 'Product created successfully.')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        $categories = Category::all();
        return response(
            view(
                'products.edit',
                compact(
                    'product',
                    'categories'
                )
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'selling_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'stock' => 'required|integer',
            'foto' => 'nullable|image|mimes:png,jpg|max:100',
        ]);

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->selling_price = $request->selling_price;
        $product->purchase_price = $request->purchase_price;
        $product->stock = $request->stock;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('product_images', 'public');
            $product->foto = "storage/" . $fotoPath;
        }

        $product->save();

        return response(
            redirect()
                ->route('products.index')
                ->with('success', 'Product updated successfully.')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        // if ($product->foto != null) {
        //     unlink(public_path($product->foto));
        // }
        $product->delete();
        return response(
            redirect()
                ->route('products.index')
                ->with('success', 'Product deleted successfully.')
        );
    }
}
