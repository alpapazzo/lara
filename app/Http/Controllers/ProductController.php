<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductToCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all(); //fetch all blog posts from DB
        
	    return view('product.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $product = new Product();

        $categories = Category::all();

        return view('product.create', ['action' => '/product', 
        'method' => 'post', 
        'brands' => $brands, 
        'brand_id' => '', 
        'arrCategory_id' => array(),
        'categories' => $categories, 
        'product' => $product]);
    }  

    public function edit(string $id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        
        $objProduct = Product::findOrFail($id);        

        $brand_id = $objProduct->brand_id;        

        $productCategories = $objProduct->categories;

        $arrCategory_id = array();

        foreach ($productCategories as $objCategory) {
            $arrCategory_id[] = $objCategory->id;
        }
    
        return view('product.create', 
            ['action' => "/product/$id", 
            'method' => 'put', 
            'brands' => $brands, 
            'categories' => $categories, 
            'arrCategory_id' => $arrCategory_id,
            'brand_id' => $brand_id, 
            'product' => $objProduct]);
    }  

    public function update(Request $request, string $id)
    {
        $objProduct = Product::findOrFail($id);

        $objProduct->nome = $request->input('nome_prodotto');
        $objProduct->quantita = $request->input('quantita_prodotto');
        $objProduct->prezzo = $request->input('prezzo_prodotto');
        $objProduct->immagine = $request->input('immagine_prodotto');
        $objProduct->descrizione = $request->input('descrizione_prodotto');
        $objProduct->brand_id = $request->input('brand_id');
        $arrCategory_id = $request->input('category_id');

        $objProduct->categories()->sync($arrCategory_id);

        $objProduct->save();
 
        return redirect('/product');
    }

    public function store(Request $request)
    {
        $nome_prodotto = $request->input('nome_prodotto');
        $quantita_prodotto = $request->input('quantita_prodotto');
        $prezzo_prodotto = $request->input('prezzo_prodotto');
        $immagine_prodotto = $request->input('immagine_prodotto');
        $descrizione_prodotto = $request->input('descrizione_prodotto');
        $brand_id = $request->input('brand_id');
        $arrCategory_id = $request->input('category_id');
        
        $product = new Product();
 
        $product->nome = $nome_prodotto;
        $product->quantita = $quantita_prodotto;
        $product->prezzo = $prezzo_prodotto;
        $product->immagine = $immagine_prodotto;
        $product->descrizione = $descrizione_prodotto;
        $product->brand_id = $brand_id;

        $product->save();

        $product->categories()->attach($arrCategory_id);
 
        return redirect('/product');
    }

    public function getcategories()
    {
        $product = Product::find(1);
        
        $categories = $product->categories;

        foreach ($categories as $objCategory) {
            echo $objCategory->id." - ".$objCategory->nome."<br>";
        }
    }

    
}
