<?php

namespace App\Http\Controllers\Backend\Quiz;

use App\Helpers\ArrayHelper;
use App\Http\Requests\Backend\Quiz\QuestionsImportRequest;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Enums\Modules\ModuleType;
use App\Enums\Posts\PostStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Category\CategoryQuestionsRequest;

use App\Http\Requests\Backend\Quiz\QuestionsCreateRequest;
use App\Models\Images\Image;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Images\ImageRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Quiz\AnswerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image as ImageIntervention;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use App\Helpers\StringHelper;


class QuestionsController extends BackendController
{

    private $data = [];
    protected $postRepository, $categoryRepository, $imageRepository, $answerRepository;

    public function __construct(
        PostRepository     $postRepository,
        CategoryRepository $categoryRepository,
        ImageRepository    $imageRepository,
        AnswerRepository   $answerRepository
    ) {

        parent::__construct();
        $this->data['title'] = 'Câu hỏi';
        View::share('title', 'Câu hỏi');

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
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
        $this->answerRepository = $answerRepository;
    }


    public function index(Request $request)
    {
        $params = $request->only(['username', 'password']);
        $status = !empty($request->status) ? explode(',', $request->status) : [];
        $post = $this->postRepository->getAll([
            'module_id' => [ModuleType::Quiz], 'search' => $request->search, 'status' => $status
        ]);


        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;
        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.questions.index') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);

        return view('components.backend.quiz.questions.index', $this->data);
    }

    public function create()
    {
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        $this->data['isEdit'] = 0;
        $this->data['questions'] = [];
        return view('components.backend.quiz.questions.create', $this->data);
    }

    public function createEnglish()
    {
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        $this->data['isEdit'] = 0;
        $this->data['questions'] = [];
        return view('components.backend.quiz.questions.createEnglish', $this->data);
    }

    public function store(QuestionsCreateRequest $request)
    {
        $params = $request->all();
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['module_id'] = ModuleType::Quiz;
        $params['slug'] = Str::slug($params['name']);
        $answers = $params['answers'] ?? [];
        $post = $this->postRepository->create($params);
        if (!$post) {
            return redirect()->route('backend.questions.index')->with('error', 'Server đang bận không thể tạo');
        }

        // Thêm câu trả lời
        if (!empty($answers)) {
            foreach ($answers as $key => $answer) {
                $aAnswer = [
                    'is_correct' => $params['myAnswer'] == $key ? 1 : 0,
                    'description' => $answer
                ];
                $post->answers()->createMany([$aAnswer]);
            }
        }


        if ($request->hasfile('files')) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ($request->file('files') as $key => $file) {
                $path = $file->store('products/' . $date);
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
                $img->heighten(165, function ($constraint) {
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
        return redirect()->route('backend.questions.index')->with('success', 'Đã tạo tài thành công');
    }

    public function storeCreateEnglish(QuestionsCreateRequest $request)
    {
        $params = $request->all();

        $params['category_id'] = $params['category_id'] ?? 0;
        $params['module_id'] = ModuleType::Quiz;
        $params['slug'] = Str::slug($params['name']);
        $params['type'] = 1;
        $groups = $params['groups'] ?? [];
        $answers = $params['answers'] ?? [];
        $correct = $params['correct'] ?? [];
        $post = $this->postRepository->create($params);
        if (!$post) {
            return redirect()->route('backend.questions.index')->with('error', 'Server đang bận không thể tạo');
        }

        // Thêm câu trả lời
        if (!empty($groups)) {
            foreach ($groups as $key => $group) {
                $a = $answers[$key][0];
                $b = $answers[$key][1];
                $c = $answers[$key][2];
                $d = $answers[$key][3];
                $is_correct = $correct[$key] ?? 'a';
                $aAnswer = [
                    'a' => $a,
                    'b' => $b,
                    'c' => $c,
                    'd' => $d,
                    'is_correct' => $is_correct,
                    'group_question' => $key
                ];
                $post->questionMultiples()->createMany([$aAnswer]);
            }
        }


        if ($request->hasfile('files')) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ($request->file('files') as $key => $file) {
                $path = $file->store('products/' . $date);
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
                $img->heighten(165, function ($constraint) {
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
        return redirect()->route('backend.questions.index')->with('success', 'Đã tạo tài thành công');
    }
    public function edit($id)
    {
        $post = $this->postRepository->getByID($id);
        $this->data['posts'] = $post;
        if (!$post) {
            return redirect()->route('backend.questions.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['questions'] = $post->answers()->get();
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        return view('components.backend.quiz.questions.create', $this->data);
    }

    public function editEnglish($id){
        $post = $this->postRepository->getByID($id);
        $this->data['posts'] = $post;
        if (!$post) {
            return redirect()->route('backend.questions.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $questions = $post->questionMultiples()->get();
        $this->data['questions'] = $questions->groupBy('group_question');
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        return view('components.backend.quiz.questions.createEnglish', $this->data);
    }


    public function update(QuestionsCreateRequest $request, $id)
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['updated_at'] = date('Y-m-d H:i:s');
        $post = $this->postRepository->getByID($id);
        if (!$post) {
            return redirect()->route('backend.questions.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);
        $post->answers()->delete();

        $answers = $params['answers'] ?? [];

        // Thêm câu trả lời
        if (!empty($answers)) {
            foreach ($answers as $key => $answer) {
                //$answerInfo = $this->answerRepository->getByQuestion($post->id,$key);
                $aAnswer = [
                    'is_correct' => $params['myAnswer'] == $key ? 1 : 0,
                    'description' => $answer,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $post->answers()->createMany([$aAnswer]);
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
                $img->heighten(165, function ($constraint) {
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

        return redirect()->route('backend.questions.index')->with('success', 'Đã cập nhật thành công');
    }

    public function updateCreateEnglish(QuestionsCreateRequest $request, $id)
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['updated_at'] = date('Y-m-d H:i:s');
        $post = $this->postRepository->getByID($id);
        if (!$post) {
            return redirect()->route('backend.questions.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        $answers = $params['answers'] ?? [];
        $groups = $params['groups'] ?? [];
        $aIsCorrect = $params['is_correct'] ?? [];
        if(!empty($groups)) {
            foreach ($groups as $key =>$value) {
                $a = $answers[$key][0];
                $b = $answers[$key][1];
                $c = $answers[$key][2];
                $d = $answers[$key][3];
                $is_correct = $aIsCorrect[$key];
                $update = [
                    'a'=>$a,
                    'b'=>$b,
                    'c'=>$c,
                    'd'=>$d,
                    'is_correct'=>$is_correct,
                ];
                $post->questionMultiplesGroup($key)->update($update);
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
                $img->heighten(165, function ($constraint) {
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

        return redirect()->route('backend.questions.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy($id)
    {
        $post = $this->postRepository->getByID($id);
        if (!$post) {
            return ResponseHelper::error('Không tìm thấy câu hỏi');
        }

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

        $post->answers()->delete();
        $post->delete();

        return ResponseHelper::success('Đã xóa thành công');
    }

    public function category(Request $request)
    {
        $params = $request->only(['username', 'password']);
        $post = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]], 20);
        $this->data['title'] = 'Question';
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.questions.category') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.quiz.questions.category', $this->data);
    }

    public function createCategory()
    {
        $this->data['category_parents'] = $this->categoryRepository->getAll([
            'module_id' => [ModuleType::Quiz], 'parent_id' => [0]
        ]);
        $this->data['isEdit'] = 0;
        return view('components.backend.quiz.questions.category-create', $this->data);
    }

    public function storeCategory(CategoryQuestionsRequest $request)
    {
        $params = $request->all();
        $params['status'] = 1;
        $params['module_id'] = ModuleType::Quiz;
        $params['slug'] = $params['name'] ?? '';
        $post = $this->categoryRepository->create($params);
        if (!$post) {
            return redirect()->route('backend.questions.category')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.questions.category')->with('success', 'Đã tạo tài thành công');
    }

    public function updateCategory(CategoryQuestionsRequest $request, $id)
    {
        $params = $request->all();
        $params['status'] = 1;
        $params['slug'] = $params['name'] ?? '';
        $post = $this->categoryRepository->getByID($id);
        if (!$post) {
            return redirect()->route('backend.questions.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.questions.category')->with('success', 'Đã cập nhật thành công');
    }

    public function editCategory($id)
    {
        $post = $this->categoryRepository->getByID($id);
        $this->data['posts'] = $post;
        if (!$post) {
            return redirect()->route('backend.questions.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['category_parents'] = $this->categoryRepository->getAll([
            'module_id' => [ModuleType::Quiz], 'parent_id' => [0]
        ]);
        return view('components.backend.quiz.questions.category-create', $this->data);
    }

    public function destroyCategory($id)
    {
        $category = $this->categoryRepository->getByID($id);
        if (!$category) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        //$category->posts()->delete();
        $category->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

    public function updateImageDefault(Request $request)
    {
        $id = $request->post_id ?? 0;
        $image_id = $request->image_id ?? 0;
        $post = $this->postRepository->getByID($id);
        if ($post) {
            $post->image()->update(['is_default' => 0]);
            $image = $this->imageRepository->getByID($image_id);
            $image->is_default = 1;
            $image->save();
            return ResponseHelper::success('Đã xóa thành công');
        }
        return ResponseHelper::error('Không tìm thấy tài khoản');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAnswer(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->post_id ?? 0;
        $post = $this->postRepository->getByID($id);
        if (!$post) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        $insert = ['is_correct' => 0];
        $this->data['value'] = $post->answers()->createMany([$insert])->first();
        $count = $post->answers()->count();
        $this->data['alphabet'] = StringHelper::convertToLetter($count);
        $html = view('components.backend.quiz.questions.ajaxanswer', $this->data)->render();
        //$data = [];
        return ResponseHelper::success('Đã xóa thành công', ['jsonResult' => $html]);
    }

    public function import(Request $request)
    {
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        return view('components.backend.quiz.questions.import', $this->data);
    }

    public function insertImport(QuestionsImportRequest $request)
    {
        $params = $request->all();
        $excelMimes = [
            'text/xls',
            'text/xlsx',
            'application/excel',
            'application/vnd.msexcel',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        $file = $_FILES['file'];
        $type = $_FILES['file']['type'];
        if ($request->hasfile('file') && in_array($type, $excelMimes)) {

            $reader = new Xlsx();
            $spreadsheet = $reader->load($file['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $list = [];
            foreach ($worksheet->getRowIterator() as $k => $row) {
                if ($k > 2) {
                    $r = [];
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(FALSE);
                    foreach ($cellIterator as $cell) {
                        $r[] = $cell->getValue();
                    }
                    if (!ArrayHelper::arrayHasEmptyValue($r)) {
                        $list[] = $r;
                    }
                }
            }

            $collection = collect($list);
            $grouped = $collection->groupBy(function ($item, $key) {
                return $item[12];
            });
            $ls = $grouped->toArray();
            $params['category_id'] = $params['category_id'] ?? 0;
            $params['module_id'] = ModuleType::Quiz;
            foreach ($ls as $k => $value) {
                $question_name = $value[0][1];
                $params['code'] = $value[0][12];
                $params['name'] = $question_name;
                $params['status'] = PostStatusType::Approved;
                $params['slug'] = Str::slug($params['name']);
                $post = $this->postRepository->create($params);
                foreach ($value as $m => $val) {
                    if ($m > 0) {
                        $name = trim($val[2]);
                        $answer = $val[11] ?? 0;
                        $aAnswer = [
                            'is_correct' => $answer,
                            'description' => $name
                        ];
                        $post->answers()->createMany([$aAnswer]);
                    }
                }
            }
        }

        return ResponseHelper::success('Đã import thành công');
    }

    public function addQuestionEnglish(Request $request) {

        $params = $request->all();
        $id = $params['post_id'] ?? 0;
        $this->data['isEdit'] = 0;
        $this->data['listAnswers'] = [];
        $post = $this->postRepository->getByID($id);
        if($post) {

            $prefix = StringHelper::generateRandomCode('', 2);
            $group = StringHelper::generateRandomCode($prefix.'_', 10);

            $dataGroup  = [
                [
                    'a'=>'',
                    'b'=>'',
                    'c'=>'',
                    'd'=>'',
                    'is_correct'=>'a',
                    'group_question'=>$group,
                ]
            ];

            $this->data['isEdit'] = 1;
            foreach ($dataGroup as $answer) {
                $post->questionMultiples()->createMany([$answer]);
            }
            $this->data['listAnswers'] = $post->questionMultiplesGroup($group)->get();
        }

        $html = view('components.backend.quiz.questions.answerEnglish',$this->data)->render();
        return ResponseHelper::success('Đã import thành công',['responseHtml'=>$html]);
    }
}
