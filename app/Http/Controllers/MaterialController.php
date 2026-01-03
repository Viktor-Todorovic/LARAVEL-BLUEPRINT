<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialStoreRequest;
use App\Http\Requests\MaterialUpdateRequest;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(Request $request): Response
    {
        $materials = Material::all();

        return view('material.index', [
            'materials' => $materials,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('material.create');
    }

    public function store(MaterialStoreRequest $request): Response
    {
        $material = Material::create($request->validated());

        $request->session()->flash('material.id', $material->id);

        return redirect()->route('materials.index');
    }

    public function show(Request $request, Material $material): Response
    {
        return view('material.show', [
            'material' => $material,
        ]);
    }

    public function edit(Request $request, Material $material): Response
    {
        return view('material.edit', [
            'material' => $material,
        ]);
    }

    public function update(MaterialUpdateRequest $request, Material $material): Response
    {
        $material->update($request->validated());

        $request->session()->flash('material.id', $material->id);

        return redirect()->route('materials.index');
    }

    public function destroy(Request $request, Material $material): Response
    {
        $material->delete();

        return redirect()->route('materials.index');
    }
}
