<?php

namespace App\Http\Controllers\Frontend\Products;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\FrontendController;
use App\Http\Requests\Frontend\Cart\StoreCartRequest;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Provinces\ProvinceRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Repositories\ShowRooms\ShowRoomRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CartController extends FrontendController
{
    protected $provinceRepository, $productRepository, $showRoomRepository;
    protected $data = [];

    public function __construct(
        ProvinceRepository $provinceRepository,
        ProductRepository $productRepository,
        ShowRoomRepository $showRoomRepository
    ) {
        parent::__construct();
        $this->provinceRepository = $provinceRepository;
        $this->productRepository = $productRepository;
        $this->showRoomRepository = $showRoomRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//       $shopping =  Cart::instance('wishlist')->content();
//       print_r($shopping);
//       exit;
//       exit;

        // Cart::destroy();
        //Cart::destroy();
//        $cart = Cart::content();
//        foreach ( $cart as $key => $value ){
//
//        }

        // print_r($cart->toArray());

//        echo Cart::subtotal();
//        echo '<br>';
//        echo Cart::tax();
//        echo '<br>';
//        echo Cart::total();
//        Cart::destroy();
//        exit;
//        Cart::destroy();
        if ( Cart::count() <= 0 ) {
            return view('components.frontend.cart.empty', $this->data);
        }

        $this->data['provinces'] = $this->provinceRepository->getAll([], null);
        $this->data['numberShowRoom'] = $this->showRoomRepository->getTotal();
        $this->data['showroom'] = $this->showRoomRepository->getAll([], 3);
        $this->data['cartFreeShip'] = $this->checkFreeShipping();

        View::share('title', 'Giỏ hàng');
        View::share('description', 'Giỏ hàng');
        View::share('keywords', 'Giỏ hàng');
        View::share('author', 'KenJi');
        View::share('imageSeo', '');


        return view('components.frontend.cart.index', $this->data);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCart(Request $request)
    {

        $product_id = $request->product_id ?? 0;
        $qty = $request->qty ?? 1;
        $time = $request->time ?? 0;
        $customer_request = $request->customer_request ?? null;

        $product = $this->productRepository->getById($product_id);
        if ( $product ) {

            $options = [];
            if ( $product->default() && $product->default()['url'] ) {
                $image = str_replace(Str::of($product->default()['url'])->basename(),
                    Str::of($product->default()['url'])->basename(),
                    asset('storage/products/'.$product->default()['url']));
                $options['image'] = $image;
            }

            if ( !empty($time) ) {
                $options['time'] = $time;
            }

            if ( !empty($customer_request) ) {
                $options['return'] = $customer_request;
            }

            $options['slug'] = $product->slug;
            $options['cartFreeShip'] = $product->category_id;

            $params = [
                'id' => $product->id,
                'name' => $product->name ?? '',
                'qty' => $qty,
                'price' => !empty($product->discount) ? $product->discount : $product->price,
                'weight' => 0,
                'options' => $options
            ];
            Cart::add($params);

        } else {
            return ResponseHelper::error('Sản phẩm không tồn tại');
        }

        $data = [
            'total' => Cart::count()
        ];
        return ResponseHelper::success('Thành công', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = 0)
    {
        $rowId = $id;
        $qlt = $request->qty ?? 0;
        $cart = Cart::get($rowId);
        if ( $cart && $qlt > 0 ) {
            Cart::update($rowId, (int) $qlt);
        }
        $data = [
            'total' => Cart::count(),
            'totalMoney' => Cart::total().'đ'
        ];
        return ResponseHelper::success('Thành công', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rowId = $request->id ?? 0;
        $cart = Cart::get($rowId);
        if ( $cart ) {
            Cart::remove($rowId);
        }

        $data = [
            'total' => Cart::count()
        ];
        return ResponseHelper::success('Thành công', $data);
    }

    public function load(Request $request)
    {
        $html = view('components.frontend.cart.dropdownCart', $this->data)->render();
        $data = ['dataHtml' => $html];
        return ResponseHelper::success('Thành công', $data);
    }

    public function checkFreeShipping()
    {
        $flag = false;
        $cartFreeShip = [14, 36, 24, 25, 26];
        foreach ( Cart::content() as $row ) {
            if ( $row->options->has('cartFreeShip') ) {
                if ( in_array($row->options->cartFreeShip, $cartFreeShip) ) {
                    $flag = true;
                }
            }
        }

        return $flag;
    }
}
