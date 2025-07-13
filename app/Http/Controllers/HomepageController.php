<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Theme;
use Illuminate\Http\Request;
use \Binafy\LaravelCart\Models\Cart;

class HomepageController extends Controller
{
    private $themeFolder;

    public function __construct()
    {
        $theme = Theme::where('status', 'active')->first();
        if ($theme) {
            $this->themeFolder = $theme->folder;
        } else {
            $this->themeFolder = 'web';
        }
    }

    public function index()
    {
        $categories = Categories::latest()->take(4)->get();
        $products = Product::where('is_active', true)->paginate(20);

        return view($this->themeFolder . '.homepage', [
            'categories' => $categories,
            'products' => $products,
            'title' => 'Homepage'
        ]);
    }

    public function products(Request $request)
    {
        $title = 'Products';

        $query = Product::where('is_active', true);

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(20);

        $categories = Categories::latest()->paginate(20);

        return view($this->themeFolder . '.products', [
            'title' => $title,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function product($slug)
    {
        $product = Product::whereSlug($slug)->where('is_active', true)->first();

        if (!$product) {
            return abort(404);
        }

        $relatedProducts = Product::where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view($this->themeFolder . '.product', [
            'slug' => $slug,
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function categories()
    {
        $categories = Categories::latest()->paginate(20);

        return view($this->themeFolder . '.categories', [
            'title' => 'Categories',
            'categories' => $categories,
        ]);
    }

    public function category($slug)
    {
        $category = Categories::where('slug', $slug)->first();

        if ($category) {
            $products = Product::where('product_category_id', $category->id)->where('is_active', true)->paginate(20);

            return view($this->themeFolder . '.category_by_slug', [
                'slug' => $slug,
                'category' => $category,
                'products' => $products,
            ]);
        } else {
            return abort(404);
        }
    }

    public function cart()
    {
        $customer = auth()->guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.login');
        }

        $cart = Cart::query()
            ->with(
                [
                    'items',
                    'items.itemable'
                ]
            )
            ->where('user_id', $customer->id)
            ->first();

        return view($this->themeFolder . '.cart', [
            'title' => 'Cart',
            'cart' => $cart,
        ]);
    }

    public function checkout()
    {
        $customer = auth()->guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.login');
        }

        $cart = Cart::query()
            ->with(['items', 'items.itemable'])
            ->where('user_id', $customer->id)
            ->first();

        \Log::info('Checkout cart loaded', [
            'cart_id' => $cart ? $cart->id : null,
            'items' => $cart ? $cart->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'itemable_id' => $item->itemable_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'options' => $item->options,
                ];
            }) : []
        ]);

        $cartItems = $cart ? $cart->items : collect();

        $subtotal = $cartItems->sum(function($item) {
            $price = $item->itemable->price ?? 0;
            return $price * $item->quantity;
        });

        // Shipping cost logic: free shipping for orders above 50000
        $shippingCost = $subtotal >= 50000 ? 0 : 10000;

        $total = $subtotal + $shippingCost;

        return view($this->themeFolder . '.checkout', [
            'title' => 'Checkout',
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shippingCost' => $shippingCost,
            'total' => $total,
        ]);
    }
}
