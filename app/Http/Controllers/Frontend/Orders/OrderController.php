<?php

namespace App\Http\Controllers\Frontend\Orders;

use App\Enums\Orders\OrderMethodPaymentType;
use App\Enums\Orders\OrderSourceType;
use App\Enums\Orders\OrderStatusType;
use App\Enums\Products\DeliveryTimeType;
use App\Helpers\PaginationHelper;
use App\Helpers\StringHelper;
use App\Helpers\UserAgentHelper;
use App\Http\Controllers\FrontendController;
use App\Http\Requests\Frontend\Cart\StoreCartRequest;
use App\Mail\OrderMail;
use App\Repositories\Districts\DistrictRepository;
use App\Repositories\Orders\OrderRepository;
use App\Repositories\Orders\OrdersDetailRepository;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Provinces\ProvinceRepository;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends FrontendController
{

    protected $orderRepository, $ordersDetailRepository, $provinceRepository, $districtRepository,$productRepository;

    public function __construct(
        OrderRepository $orderRepository,
        OrdersDetailRepository $ordersDetailRepository,
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository,
        ProductRepository $productRepository
    ) {
        parent::__construct();
        $this->orderRepository = $orderRepository;
        $this->ordersDetailRepository = $ordersDetailRepository;
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->productRepository = $productRepository;
        $this->data['status'] = OrderStatusType::All;
        $this->data['paymentMethod'] = OrderMethodPaymentType::All;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        // $validated = $request->validated();
        $validated = $request->safe()->only([
            'full_name', 'phone', 'email', 'address', 'provinceid', 'districtid', 'paymentMethod'
        ]);

        $countCart = Cart::count();
        if ( $countCart > 0 ) {

            $province_id = $validated['provinceid'] ?? 0;
            $province = $this->provinceRepository->getById($province_id);
            if ( !$province ) {
                $province_id = 0;
            }

            $district_id = $validated['districtid'] ?? 0;
            $district = $this->districtRepository->getById($district_id);
            if ( !$district ) {
                $district_id = 0;
            }

            $user = Auth::guard('web')->user();

            $pOrder = [
                'total' => str_replace('.', '', Cart::total()),
                'coupon_code' => '',
                'coupon_amount' => '',
                'order_price' => str_replace('.', '', Cart::total()),
                'user_id' => $user ? $user->id : 0,
                'full_name' => $validated['full_name'] ?? '',
                'address' => $validated['address'] ?? '',
                'phone' => $validated['phone'] ?? '',
                'order_notes' => '',
                'province_id' => $province_id,
                'district_id' => $district_id,
                'hamlet_id' => '',
                'code' => StringHelper::generateRandomCode('DH_'),
                'status' => OrderStatusType::Pending,
                'email' => $validated['email'] ?? '',
                'paymentMethod' => $request->paymentMethod ?? '',
            ];

            $strSource = UserAgentHelper::userAgent();
            $pOrder['source'] = $strSource;
            if($strSource == 'Website') {
                if($user){
                    $google_id = $user->google_id ?? 0;
                    $facebook_id = $user->facebook_id ?? 0;
                    if(!empty($google_id)){
                        $pOrder['source'] = OrderSourceType::Google;
                    }elseif(!empty($facebook_id)){
                        $pOrder['source'] = OrderSourceType::Fb;
                    }
                }
            }

            $order = $this->orderRepository->create($pOrder);
            $cart = Cart::content();
            foreach ( $cart as $key => $value ) {
                $price = $value->price ?? 0;
                $qty = $value->qty ?? 0;
                $total = $price * $qty;
                $product = $this->productRepository->getById($value->id);
                if($product){
                    $pDetail = [
                        'order_id' => $order->id,
                        'product_id' => $value->id,
                        'price' => $price,
                        'tax' => 0,
                        'discount' => 0,
                        'total' => $total,
                        'qty' => $qty,
                        'warranty' => '',
                        'maintenance' => '',
                        'quantity_in_stock' => '',
                        'status_in_stock' => '',
                        'color' => '',
                        'product_name' => $product->name ?? '',
                        'delivery_time' => $value->options->has('delivery_time') ? DeliveryTimeType::DeliveryTimePage[$value->options->delivery_time] : '',
                        'request_description' => $value->options->has('request_description') ? DeliveryTimeType::DeliveryRequest[$value->options->request_description] : '',
                    ];
                    $this->ordersDetailRepository->create($pDetail);
                }
            }

            $details = [
                'title' =>'Khách hàng có số điện thoại '.$validated['phone'].' vừa đặt hàng tại kenjisport.com',
                'phone' =>$validated['phone'] ?? '',
                'order_id' =>$order->id,
            ];
            $email = env('MAIL_FROM_ADDRESS');
            Mail::to($email)->send(new OrderMail($details));

            Cart::destroy();
            return redirect()->route('frontend.orders.show',['id'=>$order->id]);
            //return redirect()->route('frontend.home.index')->with('success', 'Đơn hàng đặt hàng của bạn thành công');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id ?? 0;
        $params['ids'] = [$id];
        if(empty($id)) {
            return redirect()->route('frontend.home.index')->with('success', 'Đơn hàng không tồn tại');
        }

        $order = $this->orderRepository->getById($id);
        if(!$order) {
            return redirect()->route('frontend.home.index')->with('success', 'Đơn hàng không tồn tại');
        }

        $orders = $this->orderRepository->getAll($params);
        $total = !empty($orders->total()) ? $orders->total() : 0;
        $perPage = !empty($orders->perPage()) ? $orders->perPage() : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.users.orders').'?'.Arr::query($params);
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);
        $this->data['orders'] = $orders;

        return view('components.frontend.users.show', $this->data);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
