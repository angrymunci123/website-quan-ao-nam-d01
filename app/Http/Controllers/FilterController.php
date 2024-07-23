<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Product_Detail;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function ao_thun() 
    {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join("category", "products.category_id", "=", "category.category_id")
        ->where('product_detail.size', '=', 'S')
        ->where('category.category_name', '=', 'Áo Thun')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function ao_so_mi() 
    {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join("category", "products.category_id", "=", "category.category_id")
        ->where('product_detail.size', '=', 'S')
        ->where('category.category_name', '=', 'Áo Sơmi')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function ao_ni() 
    {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join("category", "products.category_id", "=", "category.category_id")
        ->where('product_detail.size', '=', 'S')
        ->where('category.category_name', '=', 'Áo Nỉ')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function ao_khoac() 
    {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join("category", "products.category_id", "=", "category.category_id")
        ->where('product_detail.size', '=', 'S')
        ->where('category.category_name', '=', 'Áo Khoác')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function quan_au() 
    {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join("category", "products.category_id", "=", "category.category_id")
        ->where('product_detail.size', '=', 'S')
        ->where('category.category_name', '=', 'Quần Âu')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function quan_jogger() 
    {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join("category", "products.category_id", "=", "category.category_id")
        ->where('product_detail.size', '=', 'S')
        ->where('category.category_name', '=', 'Quần Jogger')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function quan_jean() 
    {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join("category", "products.category_id", "=", "category.category_id")
        ->where('product_detail.size', '=', 'S')
        ->where('category.category_name', '=', 'Quần Jeans')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function quan_short() 
    {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join("category", "products.category_id", "=", "category.category_id")
        ->where('product_detail.size', '=', 'S')
        ->where('category.category_name', '=', 'Quần Shorts')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function below_200() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->where('product_detail.size', '=', 'S')
        ->where('product_detail.price', '<', 200000)
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function from_200_to_500() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->where('product_detail.size', '=', 'S')
        ->where('product_detail.price', '>=', 200000)
        ->where('product_detail.price', '<=', 500000)
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function from_500_to_800() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->where('product_detail.size', '=', 'S')
        ->where('product_detail.price', '>=', 500000)
        ->where('product_detail.price', '<=', 800000)
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function from_800_to_1000() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->where('product_detail.size', '=', 'S')
        ->where('product_detail.price', '>=', 800000)
        ->where('product_detail.price', '<=', 1000000)
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function from_1000_to_1500() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->where('product_detail.size', '=', 'S')
        ->where('product_detail.price', '>=', 1000000)
        ->where('product_detail.price', '<=', 1500000)
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function from_1500_to_2000() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->where('product_detail.size', '=', 'S')
        ->where('product_detail.price', '>=', 1500000)
        ->where('product_detail.price', '<=', 2000000)
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function above_2000() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->where('product_detail.size', '=', 'S')
        ->where('product_detail.price', '>', 2000000)
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function Adam() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
        ->where('product_detail.size', '=', 'S')
        ->where('brands.brand_name', '=', 'Adam')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function Atino() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
        ->where('product_detail.size', '=', 'S')
        ->where('brands.brand_name', '=', 'Atino')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function Adidas() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
        ->where('product_detail.size', '=', 'S')
        ->where('brands.brand_name', '=', 'Adidas')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function Nike() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
        ->where('product_detail.size', '=', 'S')
        ->where('brands.brand_name', '=', 'Nike')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function Puma() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
        ->where('product_detail.size', '=', 'S')
        ->where('brands.brand_name', '=', 'Puma')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function H_and_M() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
        ->where('product_detail.size', '=', 'S')
        ->where('brands.brand_name', '=', 'H&M')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function MLB() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
        ->where('product_detail.size', '=', 'S')
        ->where('brands.brand_name', '=', 'MLB')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function Calvin_Klein() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
        ->where('product_detail.size', '=', 'S')
        ->where('brands.brand_name', '=', 'Calvin Klein')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function Valentino() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
        ->where('product_detail.size', '=', 'S')
        ->where('brands.brand_name', '=', 'Valentino')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function Levis() {
        $products = Product::join("product_detail", "products.product_id", "=", "product_detail.product_id")
        ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
        ->where('product_detail.size', '=', 'S')
        ->where('brands.brand_name', '=', 'Levis')
        ->select('products.product_id', 'products.product_name',
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
        ->groupBy('products.product_id', 'products.product_name')
        ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
    }
}
