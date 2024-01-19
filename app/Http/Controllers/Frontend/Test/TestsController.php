<?php

namespace App\Http\Controllers\Frontend\Test;

use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Quiz\AnswerRepository;
use App\Repositories\Quiz\QuestionsPartRepository;
use App\Repositories\Quiz\SubjectRepository;
use App\Repositories\Quiz\TestPartUserRepository;
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
        $subjectRepository,
        $testPartUserRepository,
        $questionsPartRepository,
        $testUsersTestsRepository;

    public function __construct(
        TestRepository           $testRepository,
        TestUsersTestsRepository $testUsersTestsRepository,
        TestUsersRepository      $testUsersRepository,
        PostRepository           $postRepository,
        AnswerRepository         $answerRepository,
        CategoryRepository       $categoryRepository,
        SubjectRepository        $subjectRepository,
        TestPartUserRepository   $testPartUserRepository,
        QuestionsPartRepository  $questionsPartRepository
    ) {
        $this->testRepository = $testRepository;
        $this->testUsersTestsRepository = $testUsersTestsRepository;
        $this->testUsersRepository = $testUsersRepository;
        $this->postRepository = $postRepository;
        $this->answerRepository = $answerRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subjectRepository = $subjectRepository;
        $this->testPartUserRepository = $testPartUserRepository;
        $this->questionsPartRepository = $questionsPartRepository;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->only(['page']);
        $params['category_id'] = !empty($request->category_id) ? [$request->category_id] : [];
        $params['search'] = !empty($request->search) ?? null;
        $post = $this->testRepository->getAll(['status' => [1], 'category_id' => $params['category_id']], 18);
        $this->data['tests'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 18;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.tests.index') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);


        return view('components.frontend.tests.index', $this->data);
    }

    public function category(Request $request, $id = 0)
    {
        $user = Auth::guard('web')->user();
        $params = $request->only(['page', 'category_id']);
        $category_id = $id ?? 0;
        $category = $this->categoryRepository->getByID($category_id);
        if (!$category) {
            return redirect()->route('frontend.home.index');
        }
        $p = [
            'status' => [1],
            'category_id' => [$category_id]
        ];

        $post = $this->testRepository->getAll($p, 18);
        $this->data['tests'] = $post;
        $this->data['category'] = $category;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 20;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.tests.category', ['id' => $category->id, 'name' => Str::slug($category->name . '', '-') . '.html']) . '?' . Arr::query($params);;
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);

        View::share('title', $category->name ?? '');
        View::share('description', $category->name ?? '');
        View::share('keywords', $category->name ?? '');
        View::share('author', 'Kiwi');
        View::share('imageSeo', '');

        if ($user) {
            $permission = !empty($user->permission_category) ? explode(',', $user->permission_category) : [];
            if (empty($permission)) {
                return view('components.frontend.tests.permissioncategory', $this->data);
            } else {
                if (!in_array($category_id, $permission)) {
                    return view('components.frontend.tests.permissioncategory', $this->data);
                }
            }
        }
        return view('components.frontend.tests.category', $this->data);
    }

    public function subject(Request $request, $id = 0)
    {
        $user = Auth::guard('web')->user();
        $params = $request->only(['page', 'subject_id']);
        $subject_id = $id ?? 0;
        $subject = $this->subjectRepository->getByID($subject_id);
        if (!$subject) {
            return redirect()->route('frontend.home.index');
        }
        $p = [
            'status' => [1],
            'subject_id' => [$subject->id]
        ];

        if ($user) {
            $permission = !empty($user->permission_category) ? explode(',', $user->permission_category) : [];
            $category_id = [9999999999999999];
            if (!empty($permission)) {
                $category_id = $permission;
            }

            $p = [
                'status' => [1],
                'subject_id' => [$subject->id],
                'category_id' => $category_id
            ];
        }

        $post = $this->testRepository->getAll($p, 18);
        $this->data['tests'] = $post;
        $this->data['subject'] = $subject;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 20;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.tests.chuyende', ['id' => $subject->id, 'name' => Str::slug($subject->title . '', '-') . '.html']) . '?' . Arr::query($params);;
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);

        View::share('title', $subject->title ?? '');
        View::share('description', $subject->title ?? '');
        View::share('keywords', $subject->title ?? '');
        View::share('author', 'Kiwi');
        View::share('imageSeo', '');

        return view('components.frontend.tests.subject', $this->data);
    }

    public function show(Request $request, $id = 0)
    {
        $test = $this->testRepository->getById($id);
        if (!$test) {
            return redirect()->route('frontend.home.index')->with('error', 'Bài kiểm tra không tồn tại');
        }

        View::share('title', $test->title ?? '');
        View::share('description', $test->title ?? '');
        View::share('keywords', $test->title ?? '');
        View::share('author', 'Kiwi');
        View::share('imageSeo', '');

        $this->data['AllTest'] = $test->testAllquestions()->get();
        $this->data['question'] = $test->testAllquestions()->first();
        $this->data['total'] = count($this->data['AllTest']);
        $this->data['answers'] = $this->data['question']->answers()->get();
        $this->data['test'] = $test;
        $user = Auth::guard('web')->user();
        $this->data['checkUserTest'] = [];
        if ($user) {
            $permission = !empty($user->permission_category) ? explode(',', $user->permission_category) : [];
            if (empty($permission)) {
                return view('components.frontend.tests.phanquyen', $this->data);
            } else {
                if (!in_array($test->category_id, $permission)) {
                    return view('components.frontend.tests.phanquyen', $this->data);
                }
            }

            $this->data['checkTest'] = $this->testUsersRepository->getUserTest([
                'user_id' => $user->id,
                'test_id' => $test->id,
                'question_id' => $this->data['question']->id
            ]);

            $this->data['checkUserTest'] = $this->testUsersTestsRepository->checkUserTest([
                'test_id' => $test->id,
                'user_id' => $user->id
            ]);

        }

        return view('components.frontend.tests.show', $this->data);
    }

    public function resultEnglish(Request $request, $id = 0)
    {
        $user = Auth::guard('web')->user();
        $test = $this->testRepository->getById($id);
        if (!$test) {
            return redirect()->route('frontend.home.index')->with('error', 'Bài kiểm tra không tồn tại');
        }
        $this->data['parts'] = $test->testpart()->get();
        $this->data['test'] = $test;
        $this->data['user'] = $user;
        $this->data['so_cau_dung'] = $this->testPartUserRepository->totalTestPart($id);

        View::share('title', $test->title ?? '');
        View::share('description', $test->title ?? '');
        View::share('keywords', $test->title ?? '');
        View::share('author', 'Kiwi');
        View::share('imageSeo', '');

        if ($user) {
            $permission = !empty($user->permission_category) ? explode(',', $user->permission_category) : [];
            if (empty($permission)) {
                return view('components.frontend.tests.phanquyen', $this->data);
            } else {
                if (!in_array($test->category_id, $permission)) {
                    return view('components.frontend.tests.phanquyen', $this->data);
                }
            }

            return view('components.frontend.tests.resultEnglish', $this->data);
        }
        return redirect()->route('frontend.auth.login')->with('error', 'Bài kiểm tra không tồn tại');
    }

    public function updateEnglish(Request $request, $id = 0)
    {
        $params = $request->all();
        $user = Auth::guard('web')->user();
        $params['user_id'] = $user->id;
        if (!$user) {
            return ResponseHelper::error('Vui lòng đăng nhập', null, 402);
        }
        $test_id = $params['test_id'] ?? 0;
        $part_id = $params['part_id'] ?? 0;
        $question_id = $params['question_id'] ?? 0;
        $answer_id = $params['answer_id'] ?? 0;
        $part = $this->questionsPartRepository->getById($part_id);
        $test = $this->testRepository->getById($test_id);
        $total = self::totalQuestion($test->id);
        $total_user =  $this->testPartUserRepository->totalAllTestPart($test->id);
        if ($part) {

            $checkUserTest = $this->testUsersTestsRepository->checkUserTest([
                'test_id' => $test->id,
                'user_id' => $user->id
            ]);

            if (!$checkUserTest) {
                $start_time = date('Y-m-d H:i:s');
                $score_time = $test->score_time ?? '';
                $end_time = null;
                if (!empty($score_time)) {
                    $end_time = date("Y-m-d H:i:s", strtotime("+" . $score_time . " minutes", strtotime($start_time)));
                }

                $this->testUsersTestsRepository->create([
                    'title' => $test->title ?? '',
                    'description' => $test->description ?? '',
                    'category_id' => $test->category_id ?? '',
                    'subject_id' => $test->subject_id ?? '',
                    'status' => $test->status ?? '',
                    'score_time' => $score_time,
                    'start_date' => $test->start_date ?? '',
                    'end_date' => $test->end_date ?? '',
                    'times' => $test->times ?? '',
                    'position' => $test->position ?? '',
                    'views' => $test->views ?? '',
                    'test_id' => $test->id ?? '',
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'user_id' => $user->id,
                ]);
            }

            if ($part->type == 1) {
                $is_correct = $params['is_correct'] ?? 'a';
                $chosen = $params['chosen'] ?? 'b';
                $checkUser = $this->testPartUserRepository->checkUserTestEnglishPart($params);
                if ($checkUser) {
                    $checkUser->update([
                        'is_correct' => $is_correct,
                        'user_chosen' => $chosen,
                    ]);
                } else {
                    $this->testPartUserRepository->create([
                        'test_id' => $test_id,
                        'part_id' => $part_id,
                        'question_id' => $question_id,
                        'user_id' => $params['user_id'],
                        'answer_id' => $answer_id,
                        'is_correct' => $is_correct,
                        'user_chosen' => $chosen,
                    ]);
                }
            } else {
                $question = $this->postRepository->getByID($question_id);
                $answerCorrect = $question->answerCorrect()->first();
                $checkUser = $this->testPartUserRepository->checkUserTestPart($params);
                if ($checkUser) {
                    $checkUser->update([
                        'answer_id' => $answer_id,
                        'is_correct' => $answerCorrect->id,
                        'user_chosen' => $answer_id,
                    ]);
                } else {
                    $this->testPartUserRepository->create([
                        'test_id' => $test_id,
                        'part_id' => $part_id,
                        'question_id' => $question_id,
                        'user_id' => $params['user_id'],
                        'answer_id' => $answer_id,
                        'is_correct' => $answerCorrect->id,
                        'user_chosen' => $answer_id,
                    ]);
                }
            }
        }

        $data = [
            'total'=>$total,
            'total_user'=>$total_user
        ];
        return ResponseHelper::success('Thành công', $data, 402);
    }

    public function showEnglish(Request $request, $id = 0)
    {

        $user = Auth::guard('web')->user();
        $test = $this->testRepository->getById($id);
        if (!$test) {
            return redirect()->route('frontend.home.index')->with('error', 'Bài kiểm tra không tồn tại');
        }
        $this->data['parts'] = $test->testpart()->get();
        $this->data['test'] = $test;

        View::share('title', $test->title ?? '');
        View::share('description', $test->title ?? '');
        View::share('keywords', $test->title ?? '');
        View::share('author', 'Kiwi');
        View::share('imageSeo', '');

        if ($user) {
            $permission = !empty($user->permission_category) ? explode(',', $user->permission_category) : [];
            if (empty($permission)) {
                return view('components.frontend.tests.phanquyen', $this->data);
            } else {
                if (!in_array($test->category_id, $permission)) {
                    return view('components.frontend.tests.phanquyen', $this->data);
                }
            }

            return view('components.frontend.tests.showEnglish', $this->data);
        }
        return redirect()->route('frontend.auth.login')->with('error', 'Bài kiểm tra không tồn tại');
    }

    public function next(Request $request)
    {
        $user = Auth::guard('web')->user();

        $test_id = $request->test_id ?? 0;
        $question_id = $request->question_id ?? 0;
        $answer_id = $request->answer_id ?? 0;
        $test = $this->testRepository->getById($test_id);
        $question = $this->postRepository->getById($question_id);
        $answer = $this->answerRepository->getById($answer_id);
        if (!$test) {
            return ResponseHelper::error('Thất bại');
        }

        if (!$question) {
            return ResponseHelper::error('Câu hỏi không tồn tại');
        }

        if (!$answer) {
            return ResponseHelper::error('Câu trả lời không tồn tại');
        }

        if (!$user) {
            $strTestQuestion = $question_id . '-' . $test_id;
            $value = $request->session()->get('question_id');
            if (!empty($value)) {
                if ($value == $strTestQuestion) {
                    return ResponseHelper::error('Câu trả lời không tồn tại', null, 403);
                }
            } else {
                session(['question_id' => $strTestQuestion]);
            }
        }

        if ($user) {
            $expiry_date = $user->expiry_date ?? null;
            if (empty($expiry_date)) {
                return ResponseHelper::error('Bạn đã hết thời gian trải nghiệm. Vui lòng liên hệ với admin để gia hạn', null, 405);
            } else {
                $currentTime = date('Y-m-d H:i:s');
                if (strtotime($expiry_date) < strtotime($currentTime)) {
                    return ResponseHelper::error('Bạn đã hết thời gian trải nghiệm. Vui lòng liên hệ với admin để gia hạn', null, 405);
                }
            }
        }

        $pivot_id = $request->pivot_id ?? 0;
        $order_by = $request->order_by ?? 0;
        $this->data['AllTest'] = $test->testAllquestions()->get();
        $this->data['question'] = $test->nextTestAllquestions($order_by);


        $html = 'xemketqua';

        $checkUserTestId = 0;
        if (!empty($this->data['question'])) {
            $this->data['total'] = count($this->data['AllTest']);
            $this->data['answers'] = $this->data['question']->answers()->get();
            $this->data['test'] = $test;
            $this->data['checkTest'] = $this->testUsersRepository->getUserTest([
                'user_id' => $user->id, 'test_id' => $test->id, 'question_id' => $this->data['question']->id
            ]);

            // print_r($this->data);
            // dd($checkUserTestId);
            $html = view('components.frontend.tests.next', $this->data)->render();
        }

        if ($user) {
            $p = [
                'test_id' => $test->id,
                'user_id' => $user->id
            ];
            $checkUserTest = $this->testUsersTestsRepository->checkUserTest($p);
            $checkUserTestId = $checkUserTest->id;
        }

        return ResponseHelper::success('Thành công', ['responseJson' => $html, 'tesyusertest_id' => $checkUserTestId]);
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
        if (!$test) {
            return ResponseHelper::error('Thất bại');
        }

        if (!$question) {
            return ResponseHelper::error('Câu hỏi không tồn tại');
        }

        if (!$answer) {
            return ResponseHelper::error('Câu trả lời không tồn tại');
        }

        if (!$user) {
            $strTestQuestion = $question_id . '-' . $test_id;
            $value = $request->session()->get('question_id');
            if (!empty($value)) {
                if ($value == $strTestQuestion) {
                    return ResponseHelper::error('Câu trả lời không tồn tại', null, 403);
                }
            } else {
                session(['question_id' => $strTestQuestion]);
            }
        }

        if ($user) {
            $expiry_date = $user->expiry_date ?? null;
            if (empty($expiry_date)) {
                return ResponseHelper::error('Bạn đã hết thời gian trải nghiệm. Vui lòng liên hệ với admin để gia hạn', null, 405);
            } else {
                $currentTime = date('Y-m-d H:i:s');
                if (strtotime($expiry_date) < strtotime($currentTime)) {
                    return ResponseHelper::error('Bạn đã hết thời gian trải nghiệm. Vui lòng liên hệ với admin để gia hạn', null, 405);
                }
            }
        }

        $pivot_id = $request->pivot_id ?? 0;
        $order_by = $request->order_by ?? 0;
        $this->data['AllTest'] = $test->testAllquestions()->get();
        $this->data['question'] = $test->PreviousTestAllquestions($order_by);
        $html = 'notPreview';


        $checkUserTest = 0;
        if (!empty($this->data['question'])) {
            $this->data['total'] = count($this->data['AllTest']);
            $this->data['answers'] = $this->data['question']->answers()->get();
            $this->data['test'] = $test;
            $this->data['checkTest'] = $this->testUsersRepository->getUserTest([
                'user_id' => $user->id, 'test_id' => $test->id, 'question_id' => $this->data['question']->id
            ]);
            $checkUserTest = $this->testUsersTestsRepository->checkUserTest([
                'test_id' => $test->id,
                'user_id' => $user->id
            ]);
            $checkUserTest = $checkUserTest->id;
            $html = view('components.frontend.tests.next', $this->data)->render();
        }
        return ResponseHelper::success('Thành công', ['responseJson' => $html, 'tesyusertest_id' => $checkUserTest]);
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
        $sort = $test->testquestionSort($question_id)->get()->first();
        $correct_answer = $question->answerCorrect()->get()->first();


        if (!$test) {
            return ResponseHelper::error('Thất bại');
        }

        if (!$question) {
            return ResponseHelper::error('Câu hỏi không tồn tại');
        }

        if (!$answer) {
            return ResponseHelper::error('Câu trả lời không tồn tại');
        }

        if ($user) {

            $permission = !empty($user->permission_category) ? explode(',', $user->permission_category) : [];
            if (empty($permission)) {
                return ResponseHelper::error('Bạn không được phép');
            } else {
                if (!in_array($test->category_id, $permission)) {
                    return ResponseHelper::error('Bạn không được phép');
                }
            }


            $checkUserTest = $this->testUsersTestsRepository->checkUserTest([
                'test_id' => $test->id,
                'user_id' => $user->id
            ]);


            if (!$checkUserTest) {
                $start_time = date('Y-m-d H:i:s');
                $score_time = $test->score_time ?? '';
                $end_time = null;
                if (!empty($score_time)) {
                    $end_time = date("Y-m-d H:i:s", strtotime("+" . $score_time . " minutes", strtotime($start_time)));
                }

                $checkUserTest = $this->testUsersTestsRepository->create([
                    'title' => $test->title ?? '',
                    'description' => $test->description ?? '',
                    'category_id' => $test->category_id ?? '',
                    'subject_id' => $test->subject_id ?? '',
                    'status' => $test->status ?? '',
                    'score_time' => $score_time,
                    'start_date' => $test->start_date ?? '',
                    'end_date' => $test->end_date ?? '',
                    'times' => $test->times ?? '',
                    'position' => $test->position ?? '',
                    'views' => $test->views ?? '',
                    'test_id' => $test->id ?? '',
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'user_id' => $user->id,
                ]);
            }

            $test_id_test = $checkUserTest->id ?? 0;

            $checkTest = $this->testUsersRepository->getUserTest([
                'user_id' => $user->id,
                'test_id' => $test->id,
                'question_id' => $question_id
            ]);

            if (!$checkTest) {
                // $test->testAllquestions()->get();
                $aInsert = [
                    'user_id' => $user->id,
                    'test_id' => $test->id,
                    'question_id' => $question_id,
                    'is_correct' => $answer_id,
                    'is_correct_temp' => $correct_answer->id == $answer->id ? 1 : 0,
                    'test_id_test' => $test_id_test,
                    'order_by' => $sort->order_by,
                ];
                $this->testUsersRepository->create($aInsert);
            } else {
                $checkTest->update([
                    'is_correct' => $answer_id,
                    'is_correct_temp' => $correct_answer->id == $answer->id ? 1 : 0,
                    'test_id' => $test->id,
                    'user_id' => $user->id,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'test_id_test' => $test_id_test,
                    'order_by' => $sort->order_by
                ]);
            }

        } else {
            return ResponseHelper::success('Thành công');
        }
    }

    public function result(Request $request, $id)
    {
        $testUserTest = $this->testUsersTestsRepository->getById($id);
        if (!$testUserTest) {
            return redirect()->route('frontend.home.index')->with('error', 'Bài kiểm tra không tồn tại');
        }
        $test_id = $testUserTest->test_id ?? 0;
        $test = $this->testRepository->getById($test_id);
        if (!$test) {
            return redirect()->route('frontend.home.index')->with('error', 'Bài kiểm tra không tồn tại');
        }

        View::share('title', $test->title ?? '');
        View::share('description', $test->title ?? '');
        View::share('keywords', $test->title ?? '');
        View::share('author', 'Kiwi');
        View::share('imageSeo', '');

        $questions = $testUserTest->questions()->get();
        $this->data['questions'] = $questions;//$test->testAllquestions()->get();
        $this->data['questionsCorrect'] = $testUserTest->questionsCorrect()->count();//$test->testAllquestions()->get();

        $this->data['test'] = $test;
        return view('components.frontend.tests.result', $this->data);
    }

    public function storex(Request $request)
    {
        $user = Auth::guard('web')->user();
        $test_id = $request->test_id ?? 0;
        $test_id_test = $request->test_id_test ?? 0;
        $test = $this->testRepository->getById($test_id);
        if (!$test) {
            return ResponseHelper::error('Thất bại');
        }

        $score_time = $test->score_time ?? 0;
        $start_time = date('Y-m-d H:i:s');
        $end_time = date("Y-m-d H:i:s", strtotime("+15 minutes", strtotime($start_time)));
        if (!empty($score_time)) {
            $minutes = "+" . $score_time . " minutes";
            $end_time = date("Y-m-d H:i:s", strtotime($minutes, strtotime($start_time)));
        }

        $value = $request->session()->get('test_id_test');
        if (!empty($value)) {

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

    public function totalQuestion($test_id = 0)
    {
        $test = $this->testRepository->getById($test_id);
        $total = 0;
        if ($test) {
            $parts = $test->testpart()->get();
            foreach ($parts as $key => $part) {
                if ($part->type == 1) {
                    $posts = $part->posts()->get();
                    if($posts->count() > 0){
                        foreach ($posts as $post) {
                            $total += $post->questionMultiples()->count();
                        }
                    }
                } else {
                    $total += $part->posts()->count();
                }
            }
        }
        return $total;
    }

}
