<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $materials = Material::all();

        return view('admin.products.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'material_id' => 'required|exists:materials,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_offer' => 'nullable|boolean', // Dodato za is_offer
        ]);

        // Kreiramo niz za bazu bez slike za početak
        $data = $request->except('image');
        $data['is_offer'] = $request->has('is_offer'); // Ako je checkbox štikliran biće true

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // BITNO: Upisujemo "images/ime.jpg" jer tvoj model tako traži
            $data['image_path'] = 'images/'.$imageName;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Proizvod dodat!');
    }

    public function edit(Product $product)
    {
        $materials = Material::all();

        return view('admin.products.edit', compact('product', 'materials'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'material_id' => 'required|exists:materials,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Brisanje stare slike iz public/images foldera
            if ($product->image && file_exists(public_path('images/'.$product->image))) {
                unlink(public_path('images/'.$product->image));
            }

            // Generisanje unikatnog imena i pomeranje u public/images
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // Čuvamo samo ime fajla u bazi
            $validated['image'] = $imageName;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Proizvod ažuriran!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Proizvod obrisan.');
    }
}
