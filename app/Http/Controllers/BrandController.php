<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return view('greetings', ['name' => 'Victoria']);
        $brands = Brand::all(); //fetch all blog posts from DB
        
	    return view('brand.list', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brand.create', ['action' => '/brand', 'method' => 'post', 'brandName' => '']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nome_brand = $request->input('brandName');

        $brand = new Brand;
 
        $brand->nome = $nome_brand;
 
        $brand->save();
 
        return redirect('/brand');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('brand.list', ['brands' => array($brand)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brandName = $brand->nome;
    
        return view('brand.create', ['action' => "/brand/$id", 'method' => 'put', 'brandName' => $brandName]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);

        $nome_brand = $request->input('brandName');

        $brand->nome = $nome_brand;

        $brand->save();
 
        return redirect('/brand');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getProducts()
    {
        $id = 2;
        $brand = Brand::findOrFail($id);
        $products = $brand->products;

        return view('product.list', ['products' => $products]);
    }
}
