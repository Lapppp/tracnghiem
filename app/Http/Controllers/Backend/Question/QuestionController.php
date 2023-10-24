<?php

namespace App\Http\Controllers\Backend\Question;

use App\Enums\Questions\QuestionStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Question\StoreQuestionRequest;
use App\Repositories\Questions\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class QuestionController extends BackendController
{

    private $questionRepository, $categoryRepository;
    protected $data = [];

    public function __construct(
        QuestionRepository $questionRepository
    ) {
        parent::__construct();
        $this->questionRepository = $questionRepository;
        $this->data['status'] = [
            QuestionStatusType::Approved => 'Xuất bản',
            QuestionStatusType::Deactivated => 'Nháp',
        ];
    }

    public function index(Request $request)
    {
        $users = $this->questionRepository->getAll([]);
        $this->data['title'] = 'Question';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.question.index', $this->data);
    }

    public function create()
    {
        $this->data['isEdit'] = 0;
        return view('components.backend.question.create', $this->data);
    }


    public function store(StoreQuestionRequest $request)
    {
        $params = $request->all();
        $post = $this->questionRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.question.index')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.question.index')->with('success', 'Đã tạo tài thành công');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $post = $this->questionRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.question.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        return view('components.backend.question.create', $this->data);
    }

    public function update(StoreQuestionRequest $request, $id)
    {
        $params = $request->all();
        $post = $this->questionRepository->getByID($id);
        $users = $params['users'] ?? null;
        unset($params['users']);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.question.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.question.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy($id)
    {
        $post = $this->questionRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }


}
