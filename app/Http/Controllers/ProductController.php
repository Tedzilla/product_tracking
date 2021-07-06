<?php

namespace App\Http\Controllers;

use DB;
use App\Models\History;
use App\Models\Product;
use App\Models\Event;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cookie;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['verified']);
    }

    public function index(Request $request)
    {
        $per_page = $request->get('page_size') ? $request->get('page_size') : '20';
        if ($request->get('page_size')) {
            Cookie::queue('page_size', $request->get('page_size'), 60);
        }
        $products = Product::sortable()->paginate($per_page);

        foreach ($products as $product) {
            $history = Product::find($product['id'])->history;

            if ($history) {
                $product->history = $history;
            }
        }

        return view('/products/products')->with('products', $products);
    }

    public function add()
    {
        return view('/products/add');
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $last_product = DB::table('products')->latest('id')->first();

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'artikul_number' => 'required|unique:products|integer',
            'price_per_piece' => 'required|numeric|min:0.01|max:99999999.99',
            'pieces' => 'required|numeric',
            'package_price' => 'required|numeric|min:0.01|max:99999999.99',
            'status' => 'required',
            'state' => 'required'
        ], [
            'price_per_piece.numeric' => 'Price per pice must be between: 0 and 99999999.99',
            'package_price.numeric' => 'Package price must be between: 0 and 99999999.99',
            'pieces.numeric' => 'Content (pieces) must be a digit'
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('create', '1');
            return redirect(route('products'))
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::create([
            'current_number' => $last_product->current_number + 1,
            'name' => $data['name'],
            'artikul_number' => $data['artikul_number'],
            'price_per_piece' => $data['price_per_piece'],
            'pieces' => $data['pieces'],
            'package_price' => $data['package_price'],
            'status' => $data['status'],
            'state' => $data['state'],
        ]);

        $product->save();

        # this is so that a new event can also be created when a product is created!
        $request->request->add(['serial_number' => $last_product->current_number + 1]);
        $request->request->add(['product_id' => $last_product->current_number + 1]);
        $request->request->add(['created_at' => date('Y-m-d')]);
        app('App\Http\Controllers\EventController')->add_event($request);

        return redirect('/products')->with('success', 'Product Created');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'artikul_number' => 'required|integer'
        ]);

        Product::whereId($request->product_id)->update($request->except('_token', 'product_id'));

        return  redirect()->back()->with('success', 'Product Updated');
    }

    public function search_products(Request $request)
    {
        \Cookie::queue(\Cookie::forget('name_search'));

        if (!$request->cookie('status_search')) {
            Cookie::queue('status_search', $request->get('status_search'), 60);
        }

        if (!$request->cookie('state_search')) {
            Cookie::queue('state_search', $request->get('state_search'), 60);
        }

        if (!$request->cookie('name_search')) {
            Cookie::queue('name_search', $request->get('name_search'), 60);
        }

        $statuses = explode(',', $request->status_search ? $request->status_search : $request->cookie('status_search'));
        $states = explode(',', $request->state_search ? $request->state_search : $request->cookie('state_search'));
        $name = $request->get('name_search') ? $request->get('name_search') : $request->cookie('name_search');

        $per_page_from_cookie = $request->cookie('page_size');

        $products = Product::name($name)->status($statuses)->state($states)->sortable()->paginate($per_page_from_cookie)->setpath('');

        return view('/products/products')->with('products', $products);
    }

}
