<?php

namespace App\Http\Controllers\Backend\Company;

use App\Enums\Videos\VideoStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Company\StoreCompanyRequest;
use App\Repositories\Companies\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CompanyController extends BackendController
{

    private $companyRepository;
    protected $data = [];

    public function __construct(
        CompanyRepository $companyRepository
    )
    {
        parent::__construct();
        $this->companyRepository = $companyRepository;
        $this->data['status'] = [
            VideoStatusType::Approved => 'Xuất bản',
            VideoStatusType::Deactivated => 'Nháp',
        ];
    }

    public function index( Request $request )
    {
        $users = $this->companyRepository->getAll([]);
        $this->data['title'] = 'Company';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.company.index', $this->data);
    }

    public function edit( $id )
    {
        $post = $this->companyRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.company.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        return view('components.backend.company.create', $this->data);
    }

    public function update( StoreCompanyRequest $request, $id )
    {
        $params = $request->all();
        $post = $this->companyRepository->getByID($id);
        $users = $params['users'] ?? null;
        unset($params['users']);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.company.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.company.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->companyRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }
}
