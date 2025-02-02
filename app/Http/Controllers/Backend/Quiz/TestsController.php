<?php

namespace App\Http\Controllers\Backend\Quiz;

use App\Enums\Modules\ModuleType;
use App\Enums\Posts\PostStatusType;
use App\Enums\Tests\TestsPosition;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Quiz\TestsCreateRequest;
use App\Models\Post\QuestionsPartQuestion;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Quiz\QuestionsPartRepository;
use App\Repositories\Quiz\SubjectRepository;
use App\Repositories\Quiz\TestRepository;
use App\Models\Images\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageIntervention;

class TestsController extends BackendController
{
    protected $data = [];
    protected $testRepository, $categoryRepository, $subjectRepository, $postRepository, $questionsPartRepository;

    public function __construct(
        TestRepository $testRepository,
        CategoryRepository $categoryRepository,
        SubjectRepository $subjectRepository,
        PostRepository $postRepository,
        QuestionsPartRepository $questionsPartRepository
    ) {
        parent::__construct();

        $this->data['status'] = [
            PostStatusType::Approved => 'Xuất bản',
            PostStatusType::Deactivated => 'Nháp',
        ];

        $this->data['options'] = [
            PostStatusType::New => 'Mới',
            PostStatusType::Home => 'Xuất hiện trang chủ vị trí 1',
            PostStatusType::HomeTwo => 'Xuất hiện trang chủ vị trí 2',
            PostStatusType::HomeThree => 'Xuất hiện trang chủ vị trí 3',
        ];

        $this->data['show_question_correct'] = [
            PostStatusType::Approved => 'Hiện',
            PostStatusType::Deactivated => 'Ẩn',
        ];

        $this->data['show_bai_giai'] = [
            PostStatusType::Approved => 'Hiện',
            PostStatusType::Deactivated => 'Ẩn',
        ];

        $this->data['type'] = [
            0 => 'Mặc định',
            1 => 'Câu hỏi nhiều câu trả lời',
        ];
        $this->data['trends'] = TestsPosition::getPosition();
        $this->testRepository = $testRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subjectRepository = $subjectRepository;
        $this->postRepository = $postRepository;
        $this->questionsPartRepository = $questionsPartRepository;
    }

    public function index(Request $request)
    {
        $params = $request->only(['search']);
        $p = $request->all();
        $status = !empty($request->status) ? explode(',', $request->status) : [];

        $post = $this->testRepository->getAll($params);
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;
        $page = !empty($request->page) ? $request->page : 1;
        unset($p['page']);
        $url = route('backend.test.index') . '?' . Arr::query($p) . '&';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);

        return view('components.backend.quiz.test.index', $this->data);
    }

    public function create()
    {
        $this->data['isEdit'] = 0;
        $this->data['posts'] = [];
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        $this->data['subjects'] = $this->subjectRepository->getAll([], null);
        $this->data['questions'] = $this->postRepository->getAll(
            ['module_id' => [ModuleType::Quiz], 'status' => [1]],
            null
        );
        $this->data['questions_select'] = '';
        return view('components.backend.quiz.test.create', $this->data);
    }

    public function createEnglish()
    {
        $this->data['isEdit'] = 0;
        $this->data['posts'] = [];
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        $this->data['subjects'] = $this->subjectRepository->getAll([], null);
        $this->data['questions'] = $this->postRepository->getAll(
            ['module_id' => [ModuleType::Quiz], 'status' => [1]],
            null
        );
        $this->data['questions_select'] = '';
        return view('components.backend.quiz.test.createEnglish', $this->data);
    }

    public function store(TestsCreateRequest $request)
    {
        $params = $request->all();
        $questions = $params['questions'] ?? null;
        $is_english = $params['is_english'] ?? 0;
        $params['type'] = $is_english;
        $params['questions'] = !empty($params['questions']) ? $params['questions'] : '';
        $post =  $this->testRepository->create($params);
        if (!$post) {
            return redirect()->route('backend.test.index')->with('error', 'Server đang bận không thể tạo');
        }

        if (!empty($questions)) {
            $questions = explode(',', $params['questions']);
            foreach ($questions as  $question) {
                $insert = [
                    'post_id' => $question
                ];
                $post->testquestions()->createMany([$insert]);
            }
        }

        if ($request->hasfile('files')) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ($request->file('files') as $key => $file) {
                $file->store('products/' . $date);
                $aImage = $file->hashName();
                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->is_default = ($key == $n - 1) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $post->image()->save($photo);
                $pathOld = public_path('storage/products/' . $date . '/' . $aImage);
                $fileNew = public_path('storage/products/' . $date . '/thumb_' . $aImage);
                $fileNewSize = public_path('storage/products/' . $date . '/thumb_50x50_' . $aImage);

                // size height 165
                $img = ImageIntervention::make($pathOld);
                $img->fit(282, 310, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50
                $img->fit(50, 50, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);
            }
        }

        if ($is_english == 1) {
            return redirect()->route('backend.test.next', ['id' => $post->id])->with('success', 'Đã tạo tài thành công');
        }

        return redirect()->route('backend.test.index')->with('success', 'Đã tạo tài thành công');
    }

    public function edit($id)
    {
        $post = $this->testRepository->getByID($id);
        $this->data['posts'] = $post;
        if (!$post) {
            return redirect()->route('backend.test.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        $this->data['isEdit'] = 1;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        $this->data['subjects'] = $this->subjectRepository->getAll([], null);
        $this->data['questions'] = $this->postRepository->getAll(
            ['module_id' => [ModuleType::Quiz], 'status' => [1]],
            null
        );
        $this->data['questions_select'] = !empty($post->questions) ? $post->questions : '';
        return view('components.backend.quiz.test.create', $this->data);
    }

    public function editEnglish($id)
    {
        $post = $this->testRepository->getByID($id);
        $this->data['posts'] = $post;
        if (!$post) {
            return redirect()->route('backend.test.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        $this->data['isEdit'] = 1;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        $this->data['subjects'] = $this->subjectRepository->getAll([], null);
        $this->data['questions'] = $this->postRepository->getAll(
            ['module_id' => [ModuleType::Quiz], 'status' => [1]],
            null
        );
        $this->data['questions_select'] = !empty($post->questions) ? $post->questions : '';
        return view('components.backend.quiz.test.createEnglish', $this->data);
    }
    public function next($id)
    {
        $post = $this->testRepository->getByID($id);
        $this->data['posts'] = $post;
        if (!$post) {
            return redirect()->route('backend.test.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        $this->data['isEdit'] = 1;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        $this->data['subjects'] = $this->subjectRepository->getAll([], null);
        $this->data['questions'] = $this->postRepository->getAll(
            ['module_id' => [ModuleType::Quiz], 'status' => [1]],
            null
        );
        $this->data['questions_select'] = !empty($post->questions) ? $post->questions : '';

        $this->data['parts'] = $post->testpart()->get();
        return view('components.backend.quiz.test.next', $this->data);
    }



    public function question($id)
    {
        $post = $this->testRepository->getByID($id);
        $this->data['posts'] = $post;
        if (!$post) {
            return redirect()->route('backend.test.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        $this->data['questions'] = $post->testAllquestions()->get();
        $html = view('components.backend.quiz.test.sortQuestions', $this->data)->render();
        return ResponseHelper::success('thành công', ['jsonResult' => $html]);
    }

    public function updateSortQuestion(Request $request, $id)
    {
        $post = $this->testRepository->getByID($id);
        $this->data['posts'] = $post;
        if (!$post) {
            return ResponseHelper::error('thất bại', null, 404);
        }


        $aQuestions = $request->questions ?? [];

        $sort = $request->sortQuestions ?? [];
        $aQuestionsId = [];
        if (!empty($aQuestions)) {
            foreach ($aQuestions as $key => $question_id) {
                $aQuestionsId[$question_id] = [
                    'order_by' => $sort[$key],
                    'post_id' => $question_id
                ];
            }
        }
        if (!empty($aQuestionsId)) {
            $post->testAllquestions()->sync($aQuestionsId, false);
        }

        return ResponseHelper::success('thành công');
    }

    public function update(TestsCreateRequest $request, $id)
    {
        $params = $request->all();
        $questions = $params['questions'] ?? null;
        $params['questions'] = !empty($params['questions']) ? $params['questions'] : '';
        $post = $this->testRepository->getByID($id);
        if (!$post) {
            return redirect()->route('backend.test.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);
        // $post->testquestions()->delete();

        if (!empty($questions)) {
            $questions = explode(',', $params['questions']);
            foreach ($questions as  $question) {
                $insert = [
                    'post_id' => $question
                ];

                if (!$post->testquestions()->where('post_id', $question)->exists()) {
                    $post->testquestions()->createMany([$insert]);
                }
                //$post->testquestions()->syncWithoutDetaching([$question]);
                //$post->testquestions()->updateExistingPivot($question, $insert);
                // $post->testquestions()->createMany([$insert]);
            }
        }

        if ($request->hasfile('files')) {

            $images = $post->image()->get();
            if (count($images) > 0) {
                foreach ($images as $item) {
                    $deleteFile = $item->url ?? null;
                    if (!empty($deleteFile)) {
                        $fileUnlink = Str::of('/' . $deleteFile)->basename();
                        @unlink(public_path('storage/products/' . $deleteFile));
                        @unlink(public_path('storage/products/' . str_replace(
                            $fileUnlink,
                            'thumb_' . $fileUnlink,
                            $deleteFile
                        )));
                        @unlink(public_path('storage/products/' . str_replace(
                            $fileUnlink,
                            'thumb_50x50_' . $fileUnlink,
                            $deleteFile
                        )));
                    }
                    $item->delete();
                }
            }

            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ($request->file('files') as $key => $file) {
                $file->store('products/' . $date);
                $aImage = $file->hashName();

                $pathOld = public_path('storage/products/' . $date . '/' . $aImage);
                $fileNew = public_path('storage/products/' . $date . '/thumb_' . $aImage);
                $fileNewSize = public_path('storage/products/' . $date . '/thumb_50x50_' . $aImage);

                // size height 165
                $img = ImageIntervention::make($pathOld);
                $img->fit(282, 310, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50

                $img->fit(50, 50, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->is_default = ($key == $n - 1) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $post->image()->save($photo);
            }
        }

        return redirect()->route('backend.test.index')->with('success', 'Đã cập nhật thành công');
    }

    public function updateEnglish(TestsCreateRequest $request, $id)
    {
        $params = $request->all();
        unset($params['questions']);
        $is_english = $params['is_english'] ?? 0;
        $params['type'] = $is_english;
        $post = $this->testRepository->getByID($id);
        if (!$post) {
            return redirect()->route('backend.test.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        if ($request->hasfile('files')) {

            $images = $post->image()->get();
            if (count($images) > 0) {
                foreach ($images as $item) {
                    $deleteFile = $item->url ?? null;
                    if (!empty($deleteFile)) {
                        $fileUnlink = Str::of('/' . $deleteFile)->basename();
                        @unlink(public_path('storage/products/' . $deleteFile));
                        @unlink(public_path('storage/products/' . str_replace(
                            $fileUnlink,
                            'thumb_' . $fileUnlink,
                            $deleteFile
                        )));
                        @unlink(public_path('storage/products/' . str_replace(
                            $fileUnlink,
                            'thumb_50x50_' . $fileUnlink,
                            $deleteFile
                        )));
                    }
                    $item->delete();
                }
            }

            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ($request->file('files') as $key => $file) {
                $file->store('products/' . $date);
                $aImage = $file->hashName();

                $pathOld = public_path('storage/products/' . $date . '/' . $aImage);
                $fileNew = public_path('storage/products/' . $date . '/thumb_' . $aImage);
                $fileNewSize = public_path('storage/products/' . $date . '/thumb_50x50_' . $aImage);

                // size height 165
                $img = ImageIntervention::make($pathOld);
                $img->fit(282, 310, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50

                $img->fit(50, 50, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->is_default = ($key == $n - 1) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $post->image()->save($photo);
            }
        }

        return redirect()->route('backend.test.index')->with('success', 'Đã cập nhật thành công');
    }
    public function destroy($id)
    {
        $post = $this->testRepository->getByID($id);
        if (!$post) {
            return ResponseHelper::error('Không tìm thấy câu hỏi');
        }
        $post->delete();

        return ResponseHelper::success('Đã xóa thành công');
    }

    public function searchQuestion(Request $request)
    {
        $search =  $request->search ?? null;
        $category_id =  $request->category_id ?? null;
        $params  = [
            'module_id' => [ModuleType::Quiz],
            'category_id' => !empty($category_id) ? [$category_id] : [],
            'search' => $search,
            'type' => $request->type ?? 0,
            'debug' => 0
        ];


        $posts = $this->postRepository->getAll($params);
        $this->data['questions'] = $posts;
        $html = view('components.backend.quiz.test.questions', $this->data)->render();
        return ResponseHelper::success('thành công', ['jsonResult' => $html]);
    }

    public function loadQuestion(Request $request)
    {
        $questions =  $request->questions ?? null;
        $params  = [
            'post_id' => !empty($questions) ? explode(',', $questions) : [],
            'debug' => 0
        ];
        $posts = $this->postRepository->getAll($params,null);
        $this->data['questions'] = $posts;
        $html = view('components.backend.quiz.test.load_questions', $this->data)->render();
        return ResponseHelper::success('thành công', ['jsonResult' => $html]);
    }

    public function createPart(Request $request)
    {
        $params = $request->all();
        $test_id = $params['test_id'] ?? 0;
        $test = $this->testRepository->getByID($test_id);
        if (!$test) {
            return ResponseHelper::error('Không tìm thấy bài kiểm tra');
        }

        $insert = [
            'name' => $params['part_name'] ?? '',
            'type' => $params['type'] ?? '',
            'short_description' => $params['short_description'] ?? '',
            'description' => $params['description'] ?? '',
            'order' => $params['order'] ?? 0,
        ];
        $part = $test->testpart()->createMany([$insert]);

        $this->data['part'] = $part->first();
        $html = view('components.backend.quiz.test.accordion', $this->data)->render();
        return ResponseHelper::success('thành công', ['jsonResult' => $html]);
    }

    public function updatePart(Request $request)
    {
        $params = $request->all();
        $part_id = $params['part_id'];
        $part = $this->questionsPartRepository->getById($part_id);
        unset($part['part_id']);
        unset($part['_token']);
        $part->update($params);
        return ResponseHelper::success('thành công');
    }

    public function addQuestionPart(Request $request)
    {
        $params = $request->all();
        $part_id = $params['part_id'] ?? 0;
        $post_id = $params['post_id'] ?? 0;
        $part = $this->questionsPartRepository->getById($part_id);
        if (!$part) {
            return ResponseHelper::error('Không tìm thấy Part');
        }

        $insert = [
            'order' => 0,
            'test_id' => $part->test_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $part->posts()->syncWithoutDetaching([$post_id]);
        $part->posts()->updateExistingPivot($post_id, $insert);
        $this->data['questions'] = $part->posts()->get();
        $html = view('components.backend.quiz.test.addQuestion', $this->data)->render();
        return ResponseHelper::success('thành công', ['jsonResult' => $html]);
    }

    public function updateQuestionPart(Request $request, $id)
    {
        $qpq = QuestionsPartQuestion::find($id);
        if ($qpq) {
            $qpq->update(['order' => $request->order]);
        }
        return ResponseHelper::success('thành công');
    }

    public function duplicate(Request $request)
    {
        //https://laracoding.com/how-to-clone-a-model-in-laravel-with-or-without-relations/
        $test = $this->testRepository->getByID($request->id);
        if (!$test) {
            return ResponseHelper::error('Không tìm thấy câu hỏi');
        }
        $testNew = $test->replicate();
        $testNew->save();

        foreach ($test->testquestions()->get() as $part) {
            $clonedPart = $part->replicate();
            $clonedPart->test_id = $testNew->id;
            $clonedPart->save();
        }

        return ResponseHelper::success('Thành công');
    }

    public function duplicateEnglish(Request $request)
    {
        $test = $this->testRepository->getByID($request->id);
        if (!$test) {
            return ResponseHelper::error('Không tìm thấy câu hỏi');
        }

        $testNew = $test->replicate();
        $testNew->save();

        if ($test->testpart()->count() > 0) {
            foreach ($test->testpart()->get() as $part) {
                $clonedPart = $part->replicate();
                $clonedPart->test_id = $testNew->id;
                $clonedPart->save();
                if ($part->posts->count() > 0) {

                    foreach ($part->posts as $sub) {

                        $insert = [
                            'order' => $sub->pivot->order ?? 0,
                            'test_id' => $testNew->id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ];

                        $clonedPart->posts()->syncWithoutDetaching([$sub->id]);
                        $clonedPart->posts()->updateExistingPivot($sub->id, $insert);
                    }
                }
            }
        }
        return ResponseHelper::success('Thành công');
    }

    public function updateText(Request $request, $id)
    {

        $test = $this->testRepository->getByID($id);
        if (!$test) {
            return ResponseHelper::error('Không tìm thấy câu hỏi');
        }

        $title  = $request->title;
        $test->update(['title' => $title]);

        return ResponseHelper::success('Thành công');
    }
}
