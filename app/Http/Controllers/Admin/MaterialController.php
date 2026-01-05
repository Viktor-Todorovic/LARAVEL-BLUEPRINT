<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();

        return view('admin.materials.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.materials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:materials',
            'stock_quantity' => 'required|numeric|min:0',
            'price_per_meter' => 'required|numeric|min:0',
        ]);

        Material::create($validated);

        return redirect()->route('admin.materials.index')->with('success', 'Materijal uspješno dodat.');
    }

    public function edit(Material $material)
    {
        return view('admin.materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:materials,name,'.$material->id,
            'stock_quantity' => 'required|numeric|min:0',
            'price_per_meter' => 'required|numeric|min:0',
        ]);

        $material->update($validated);

        return redirect()->route('admin.materials.index')->with('success', 'Materijal ažuriran.');
    }

    public function destroy(Material $material)
    {
        if ($material->products()->count() > 0) {
            return back()->with('error', 'Ne možete obrisati materijal koji je dodeljen proizvodima!');
        }

        $material->delete();

        return redirect()->route('admin.materials.index')->with('success', 'Materijal obrisan.');
    }
}
