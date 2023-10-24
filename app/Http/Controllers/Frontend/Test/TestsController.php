<?php

namespace App\Http\Controllers\Frontend\Test;

use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Quiz\AnswerRepository;
use App\Repositories\Quiz\TestRepository;
use App\Repositories\Quiz\TestUsersRepository;
use App\Repositories\Quiz\TestUsersTestsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;


class TestsController extends FrontendController
{


    private $data = [];
    protected $testRepository,
        $testUsersRepository,
        $postRepository,
        $answerRepository,
        $categoryRepository,
        $testUsersTestsRepository;

    public function __construct(
        TestRepository $testRepository,
        TestUsersTestsRepository $testUsersTestsRepository,
        TestUsersRepository $testUsersRepository,
        PostRepository $postRepository,
        AnswerRepository $answerRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->testRepository = $testRepository;
        $this->testUsersTestsRepository = $testUsersTestsRepository;
        $this->testUsersRepository = $testUsersRepository;
        $this->postRepository = $postRepository;
        $this->answerRepository = $answerRepository;
        $this->categoryRepository = $categoryRepository;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->only(['page']);
        $params['category_id'] = !empty($request->category_id) ? [$request->category_id] : [];
        $params['search'] = !empty($request->search) ?? null;
        $post = $this->testRepository->getAll(['status' => [1],'category_id'=>$params['category_id']],18);
        $this->data['tests'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 18;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.tests.index').'?'.Arr::query($params);
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);

        return view('components.frontend.tests.index', $this->data);
    }

    public function category(Request $request, $id = 0)
    {

        $params = $request->only(['page', 'category_id']);
        $category_id = $id ?? 0;
        $category = $this->categoryRepository->getByID($category_id);
        if(!$category) {
            return redirect()->route('frontend.home.index');
        }

        $p = [
            'status' => [1],
            'category_id' => [$category_id]
        ];
        $post = $this->testRepository->getAll($p,18);
        $this->data['tests'] = $post;
        $this->data['category'] = $category;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 20;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.tests.category',['id'=>$category->id,'name'=>Str::slug($category->name.'', '-').'.html']).'?'.Arr::query($params);;
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);

        View::share('title', $category->name ?? '');
        View::share('description', $category->name ?? '');
        View::share('keywords', $category->name ?? '');
        View::share('author', 'Kiwi');
        View::share('imageSeo', '');

        return view('components.frontend.tests.category', $this->data);
    }

    public function show(Request $request, $id = 0)
    {
        $test = $this->testRepository->getById($id);
        if ( !$test ) {
            return redirect()->route('frontend.home.index')->with('error', 'Bài kiểm tra không tồn tại');
        }
        $this->data['AllTest'] = $test->testAllquestions()->get();
        $this->data['question'] = $test->testAllquestions()->first();
        $this->data['total'] = count($this->data['AllTest']);
        $this->data['answers'] = $this->data['question']->answers()->get();
        $this->data['test'] = $test;
        $user = Auth::guard('web')->user();
        $this->data['checkUserTest'] = [];
        if($user) {
            $this->data['checkTest']  = $this->testUsersRepository->getUserTest([
                'user_id' => $user->id, 'test_id' => $test->id, 'question_id' => $this->data['question']->id
            ]);

            $this->data['checkUserTest']  = $this->testUsersTestsRepository->checkUserTest([
                'test_id'=>$test->id,
                'user_id'=>$user->id
            ]);

        }

        return view('components.frontend.tests.show', $this->data);
    }

    public function next(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::guard('web')->user();
        $test_id = $request->test_id ?? 0;
        $question_id = $request->question_id ?? 0;
        $answer_id = $request->answer_id ?? 0;
        $test = $this->testRepository->getById($test_id);
        $question = $this->postRepository->getById($question_id);
        $answer = $this->answerRepository->getById($answer_id);
        if ( !$test ) {
            return ResponseHelper::error('Thất bại');
        }

        if ( !$question ) {
            return ResponseHelper::error('Câu hỏi không tồn tại');
        }

        if ( !$answer ) {
            return ResponseHelper::error('Câu trả lời không tồn tại');
        }

        if ( !$user ) {
            $strTestQuestion = $question_id.'-'.$test_id;
            $value = $request->session()->get('question_id');
            if ( !empty($value) ) {
                if ( $value == $strTestQuestion ) {
                    return ResponseHelper::error('Câu trả lời không tồn tại', null, 403);
                }
            } else {
                session(['question_id' => $strTestQuestion]);
            }
        }

        if($user) {
            $expiry_date = $user->expiry_date ?? null;
            if(empty($expiry_date)){
                return ResponseHelper::error('Bạn đã hết thời gian trải nghiệm. Vui lòng liên hệ với admin để gia hạn', null, 405);
            }else {
                $currentTime = date('Y-m-d H:i:s');
                if(strtotime($expiry_date) > strtotime($currentTime)) {
                    return ResponseHelper::error('Bạn đã hết thời gian trải nghiệm. Vui lòng liên hệ với admin để gia hạn', null, 405);
                }
            }
        }

        $pivot_id = $request->pivot_id ?? 0;
        $this->data['AllTest'] = $test->testAllquestions()->get();
        $this->data['question'] = $test->nextTestAllquestions($pivot_id);

        $html = 'xemketqua';

        $checkUserTest = 0;
        if(!empty($this->data['question'])) {
            $this->data['total'] = count($this->data['AllTest']);
            $this->data['answers'] = $this->data['question']->answers()->get();
            $this->data['test'] = $test;
            $this->data['checkTest']  = $this->testUsersRepository->getUserTest([
                'user_id' => $user->id, 'test_id' => $test->id, 'question_id' => $this->data['question']->id
            ]);
            $checkUserTest  = $this->testUsersTestsRepository->checkUserTest([
                'test_id'=>$test->id,
                'user_id'=>$user->id
            ]);
            $checkUserTest = $checkUserTest->id;
            $html = view('components.frontend.tests.next', $this->data)->render();
        }

        return ResponseHelper::success('Thành công', ['responseJson' => $html,'tesyusertest_id'=>$checkUserTest]);
    }

    public function previous(Request $request)
    {
        $user = Auth::guard('web')->user();
        $test_id = $request->test_id ?? 0;
        $question_id = $request->question_id ?? 0;
        $answer_id = $request->answer_id ?? 0;
        $test = $this->testRepository->getById($test_id);
        $question = $this->postRepository->getById($question_id);
        $answer = $this->answerRepository->getById($answer_id);
        if ( !$test ) {
            return ResponseHelper::error('Thất bại');
        }

        if ( !$question ) {
            return ResponseHelper::error('Câu hỏi không tồn tại');
        }

        if ( !$answer ) {
            return ResponseHelper::error('Câu trả lời không tồn tại');
        }

        if ( !$user ) {
            $strTestQuestion = $question_id.'-'.$test_id;
            $value = $request->session()->get('question_id');
            if ( !empty($value) ) {
                if ( $value == $strTestQuestion ) {
                    return ResponseHelper::error('Câu trả lời không tồn tại', null, 403);
                }
            } else {
                session(['question_id' => $strTestQuestion]);
            }
        }

        if($user) {
            $expiry_date = $user->expiry_date ?? null;
            if(empty($expiry_date)){
                return ResponseHelper::error('Bạn đã hết thời gian trải nghiệm. Vui lòng liên hệ với admin để gia hạn', null, 405);
            }else {
                $currentTime = date('Y-m-d H:i:s');
                if(strtotime($expiry_date) > strtotime($currentTime)) {
                    return ResponseHelper::error('Bạn đã hết thời gian trải nghiệm. Vui lòng liên hệ với admin để gia hạn', null, 405);
                }
            }
        }

        $pivot_id = $request->pivot_id ?? 0;
        $this->data['AllTest'] = $test->testAllquestions()->get();
        $this->data['question'] = $test->PreviousTestAllquestions($pivot_id);
        $html = 'notPreview';


        $checkUserTest = 0;
        if(!empty($this->data['question'])) {
            $this->data['total'] = count($this->data['AllTest']);
            $this->data['answers'] = $this->data['question']->answers()->get();
            $this->data['test'] = $test;
            $this->data['checkTest']  = $this->testUsersRepository->getUserTest([
                'user_id' => $user->id, 'test_id' => $test->id, 'question_id' => $this->data['question']->id
            ]);
            $checkUserTest  = $this->testUsersTestsRepository->checkUserTest([
                'test_id'=>$test->id,
                'user_id'=>$user->id
            ]);
            $checkUserTest = $checkUserTest->id;
            $html = view('components.frontend.tests.next', $this->data)->render();
        }
        return ResponseHelper::success('Thành công', ['responseJson' => $html,'tesyusertest_id'=>$checkUserTest]);
    }

    public function store(Request $request)
    {

        $user = Auth::guard('web')->user();
        $test_id = $request->test_id ?? 0;
        $question_id = $request->question_id ?? 0;
        $answer_id = $request->answer_id ?? 0;
        $test = $this->testRepository->getById($test_id);
        $question = $this->postRepository->getById($question_id);
        $answer = $this->answerRepository->getById($answer_id);
        if ( !$test ) {
            return ResponseHelper::error('Thất bại');
        }

        if ( !$question ) {
            return ResponseHelper::error('Câu hỏi không tồn tại');
        }

        if ( !$answer ) {
            return ResponseHelper::error('Câu trả lời không tồn tại');
        }

        if ( $user ) {

            $checkUserTest  = $this->testUsersTestsRepository->checkUserTest([
                'test_id'=>$test->id,
                'user_id'=>$user->id
            ]);


            if(!$checkUserTest) {
                $start_time = date('Y-m-d H:i:s');
                $score_time = $test->score_time ?? '';
                $end_time = null;
                if(!empty($score_time)) {
                    $end_time = date("Y-m-d H:i:s",strtotime("+".$score_time." minutes", strtotime($start_time)));
                }

                $checkUserTest = $this->testUsersTestsRepository->create([
                    'title'=>$test->title ?? '',
                    'description'=>$test->description ?? '',
                    'category_id'=>$test->category_id ?? '',
                    'subject_id'=>$test->subject_id ?? '',
                    'status'=>$test->status ?? '',
                    'score_time'=>$score_time,
                    'start_date'=>$test->start_date ?? '',
                    'end_date'=>$test->end_date ?? '',
                    'times'=>$test->times ?? '',
                    'position'=>$test->position ?? '',
                    'views'=>$test->views ?? '',
                    'test_id'=>$test->id ?? '',
                    'start_time'=>$start_time,
                    'end_time'=>$end_time,
                    'user_id'=>$user->id,
                ]);
            }

            $test_id_test = $checkUserTest->id ?? 0;

            $checkTest = $this->testUsersRepository->getUserTest([
                'user_id' => $user->id, 'test_id' => $test->id, 'question_id' => $question_id
            ]);

            if ( !$checkTest ) {
               // $test->testAllquestions()->get();
                $aInsert = [
                    'user_id' => $user->id,
                    'test_id' => $test->id,
                    'question_id' => $question_id,
                    'is_correct' => $answer_id,
                    'is_correct_temp' => 0,
                    'test_id_test' => $test_id_test,
                ];
                $this->testUsersRepository->create($aInsert);
            } else {
                $checkTest->update([
                    'is_correct' => $answer_id,
                    'is_correct_temp' => 0,
                    'test_id' => $test->id,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'test_id_test' => $test_id_test
                ]);
            }

        } else {
            return ResponseHelper::success('Thành công');
        }
    }

    public function result(Request $request,$id) {
        $testUserTest = $this->testUsersTestsRepository->getById($id);
        if(!$testUserTest) {
            return redirect()->route('frontend.home.index')->with('error', 'Bài kiểm tra không tồn tại');
        }
        $test_id = $testUserTest->test_id ?? 0;
        $test = $this->testRepository->getById($test_id);
        if ( !$test ) {
            return redirect()->route('frontend.home.index')->with('error', 'Bài kiểm tra không tồn tại');
        }

        $questions = $testUserTest->questions()->get();
        $this->data['questions'] = $questions ;//$test->testAllquestions()->get();
        $this->data['test'] =$test;
        return view('components.frontend.tests.result', $this->data);
    }
    public function storex(Request $request)
    {
        $user = Auth::guard('web')->user();
        $test_id = $request->test_id ?? 0;
        $test_id_test = $request->test_id_test ?? 0;
        $test = $this->testRepository->getById($test_id);
        if ( !$test ) {
            return ResponseHelper::error('Thất bại');
        }

        $score_time = $test->score_time ?? 0;
        $start_time = date('Y-m-d H:i:s');
        $end_time = date("Y-m-d H:i:s", strtotime("+15 minutes", strtotime($start_time)));
        if ( !empty($score_time) ) {
            $minutes = "+".$score_time." minutes";
            $end_time = date("Y-m-d H:i:s", strtotime($minutes, strtotime($start_time)));
        }

        $value = $request->session()->get('test_id_test');
        if ( !empty($value) ) {

        } else {

            $aInsert = [
                'title' => $test->title ?? '',
                'description' => $test->description ?? '',
                'category_id' => $test->category_id ?? '',
                'subject_id' => $test->subject_id ?? '',
                'status' => $test->status ?? '',
                'score_time' => $test->score_time ?? '',
                'start_date' => $test->start_date ?? null,
                'end_date' => $test->end_date ?? null,
                'times' => $test->times ?? 0,
                'position' => $test->position ?? 0,
                'views' => $test->position ?? 1,
                'test_id' => $test->id ?? 0,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'user_id' => $user->id ?? 0,
            ];
            $test_id_test_info = $this->testUsersTestsRepository->create($aInsert);

            session(['test_id_test' => $test_id_test_info->id]);
        }


        return ResponseHelper::success('Thành công');
    }

}
