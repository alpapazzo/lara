<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $categories = Category::all();

        return view('search.form', 
            ['brands' => $brands, 
            'categories' => $categories,
            'brand_id' => '',
            'arrCategory_id' => array()
            ]);
    }

    public function search(Request $request)
    {
        $titolo = $request->input('titolo');
        $brand_id = $request->input('brand_id');
        $arrCategory_id = $request->input('category_id');

        /* Validazione */
        $request->validate([
            'category_id' => 'required',
            ]);
           
            
        /* Si può usare indifferentemente Eloquent o Query Builder:
            $qbProduct = Product::select oppure
            DB::table('products')->select
             */
        $qbProduct = Product::select('products.id as id', 
                                                    'products.nome as nomeprodotto',
                                                    'products.quantita as quantita',
                                                    'products.prezzo as prezzo',
                                                    'products.immagine as immagine',
                                                    'products.descrizione as descrizione',
                                                    'products.brand_id as brand_id',
                                                    'products.created_at as created_at',
                                                    'products.updated_at as updated_at',
                                                    'c.nome as nomecategoria',
                                                    'b.nome as nomebrand'
                                                    );

        /* Per recuperare i nomi delle catgorie e brand faccio le join, uso le left perchè prendo anche i prodotti
        che non hanno categoria o brand impostati */
        $qbProduct = $qbProduct->leftJoin('product_to_category as pc', 'pc.product_id', '=', 'products.id');
        $qbProduct = $qbProduct->leftJoin('categories as c', 'c.id', '=', 'pc.category_id');
        $qbProduct = $qbProduct->leftJoin('brands as b', 'b.id', '=', 'products.brand_id');

        if ($brand_id && $brand_id != '---' ) {
            $qbProduct = $qbProduct->where('brand_id', $brand_id);
        }
        
        if ($titolo) {
            $qbProduct = $qbProduct->where('products.nome', 'like', "%$titolo%");
        }

        /* Uso un whereIn */
        if ($arrCategory_id && $arrCategory_id[0] != '---') {
            $qbProduct = $qbProduct->whereIn('pc.category_id', $arrCategory_id);

        /* E' una sottoquery collegata alla query principale ( tramite products.id ), 
        e la utilizzo con un NotExists */
        } elseif (isset($arrCategory_id[0]) && $arrCategory_id[0] == '---') {
            $productCat = DB::table('product_to_category')
                ->select(DB::raw(1))
                ->whereColumn('product_to_category.product_id', 'products.id');
 
            $qbProduct = $qbProduct->whereNotExists($productCat);
        }

        if ($brand_id == '---') {
            $productBrands = DB::table('brands')
                ->select(DB::raw(1))
                ->whereColumn('brands.id', 'products.brand_id');
 
            $qbProduct = $qbProduct->whereNotExists($productBrands);

        }
        //$qbProduct->dd();
        $products = $qbProduct->get();

        $count = $qbProduct->count();
        $prezzoMax = $qbProduct->max('prezzo');

        return view('search.list', 
            ['products' => $products,
             'count' => $count,
             'maxPrezzo' => $prezzoMax
            ]);
    }
}
