<?php

namespace App\Http\Controllers\Backend\Order;

use App\Enums\Departments\DepartmentStatusType;
use App\Enums\Orders\OrderMethodPaymentType;
use App\Enums\Orders\OrderSourceType;
use App\Enums\Orders\OrderStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Order\UpdateOrderRequest;
use App\Http\Requests\Backend\Unit\StoreUnitRequest;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Orders\OrderRepository;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Units\UnitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;

class OrderController extends BackendController
{

    private $orderRepository;
    protected $data = [];

    public function __construct(
        OrderRepository $orderRepository
    )
    {
        parent::__construct();
        $this->orderRepository = $orderRepository;
        $this->data['status'] = OrderStatusType::All;
        $this->data['paymentMethod'] = OrderMethodPaymentType::All;
        $this->data['source'] = OrderSourceType::All;
    }

    public function index( Request $request )
    {
        $params = $request->only(['search', 'status']);
        $users = $this->orderRepository->getAll($params);
        $this->data['title'] = 'Hóa đơn';
        $this->data['items'] = $users;
        $total = !empty($users->total()) ? $users->total() : 0;
        $perPage = !empty($users->perPage()) ? $users->perPage() : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.order.index') . '?' . Arr::query($params).'&';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.order.index', $this->data);
    }

    public function create()
    {
        $this->data['isEdit'] = 0;
        return view('components.backend.order.create', $this->data);
    }


    public function store( StoreUnitRequest $request )
    {
        $params = $request->all();
        $post = $this->orderRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.order.index')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.order.index')->with('success', 'Đã tạo tài thành công');
    }


    public function show( $id )
    {
        $post = $this->orderRepository->getByID($id);
        $this->data['post'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.order.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        return view('components.backend.order.show', $this->data);
    }


    public function edit( $id )
    {
    }

    public function update( UpdateOrderRequest $request, $id )
    {
        $params = $request->all();
        $post = $this->orderRepository->getByID($id);
        unset($params['users']);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return ResponseHelper::success('Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->orderRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        $post->ordersDetail()->delete();
        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }
}
