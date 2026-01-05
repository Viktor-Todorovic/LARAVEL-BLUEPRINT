<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $materials = \App\Models\Material::all();


    $query = Product::query();


    if ($request->has('material_id') && $request->material_id != '') {
        $query->where('material_id', $request->material_id);
    }


    $products = $query->get();

    return view('product.index', [
        'products' => $products,
        'materials' => $materials, 
    ]);
    }

    public function create(Request $request)
    {
        return view('product.create');
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('products.index');
    }

    public function show(Request $request, Product $product)
    {
        return view('product.show', [
            'product' => $product,
        ]);
    }

    public function edit(Request $request, Product $product)
    {
        return view('product.edit', [
            'product' => $product,
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('products.index');
    }

    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }

    public function ponudaDana()
{
    $offers = Product::where('is_offer', true)->get();

    return view('ponuda-dana', compact('offers'));
}




}
