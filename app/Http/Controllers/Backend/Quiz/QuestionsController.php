<?php

namespace App\Http\Controllers\Backend\Quiz;

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
    protected $postRepository, $categoryRepository, $imageRepository,$answerRepository;

    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        ImageRepository $imageRepository,
        AnswerRepository $answerRepository
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
        $url = route('backend.questions.index').'?'.Arr::query($params);
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

    public function store(QuestionsCreateRequest $request)
    {
        $params = $request->all();
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['module_id'] = ModuleType::Quiz;
        $params['slug'] = Str::slug($params['name']);
        $answers = $params['answers'] ?? [];
        $post = $this->postRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.questions.index')->with('error', 'Server đang bận không thể tạo');
        }

        // Thêm câu trả lời
        if ( !empty($answers) ) {
            foreach ( $answers as $key => $answer ) {
                $aAnswer = [
                    'is_correct' => $params['myAnswer'] == $key ? 1 : 0,
                    'description' => $answer
                ];
                $post->answers()->createMany([$aAnswer]);
            }
        }


        if ( $request->hasfile('files') ) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $path = $file->store('products/'.$date);
                $aImage = $file->hashName();
                $photo = new Image();
                $photo->url = $date.'/'.$aImage;
                $photo->is_default = ($key == $n - 1) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $post->image()->save($photo);
                $pathOld = public_path('storage/products/'.$date.'/'.$aImage);
                $fileNew = public_path('storage/products/'.$date.'/thumb_'.$aImage);
                $fileNewSize = public_path('storage/products/'.$date.'/thumb_50x50_'.$aImage);

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
        if ( !$post ) {
            return redirect()->route('backend.questions.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['questions'] = $post->answers()->get();
        $this->data['category'] = $this->categoryRepository->getAll(['module_id' => [ModuleType::Quiz]]);
        return view('components.backend.quiz.questions.create', $this->data);
    }

    public function update(QuestionsCreateRequest $request, $id)
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['updated_at'] = date('Y-m-d H:i:s');
        $post = $this->postRepository->getByID($id);
        if ( !$post ) {
            return redirect()->route('backend.questions.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);
        $post->answers()->delete();

        $answers = $params['answers'] ?? [];

        // Thêm câu trả lời
        if ( !empty($answers) ) {
            foreach ( $answers as $key => $answer ) {
                //$answerInfo = $this->answerRepository->getByQuestion($post->id,$key);
                $aAnswer = [
                    'is_correct' => $params['myAnswer'] == $key ? 1 : 0,
                    'description' => $answer,
                    'updated_at'=>date('Y-m-d H:i:s')
                ];
                $post->answers()->createMany([$aAnswer]);
            }
        }

        if ( $request->hasfile('files') ) {

            $images = $post->image()->get();
            if ( count($images) > 0 ) {
                foreach ( $images as $item ) {
                    $deleteFile = $item->url ?? null;
                    if ( !empty($deleteFile) ) {
                        $fileUnlink = Str::of('/'.$deleteFile)->basename();
                        @unlink(public_path('storage/products/'.$deleteFile));
                        @unlink(public_path('storage/products/'.str_replace($fileUnlink, 'thumb_'.$fileUnlink,
                                $deleteFile)));
                        @unlink(public_path('storage/products/'.str_replace($fileUnlink, 'thumb_50x50_'.$fileUnlink,
                                $deleteFile)));
                    }
                    $item->delete();
                }
            }

            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('products/'.$date);
                $aImage = $file->hashName();

                $pathOld = public_path('storage/products/'.$date.'/'.$aImage);
                $fileNew = public_path('storage/products/'.$date.'/thumb_'.$aImage);
                $fileNewSize = public_path('storage/products/'.$date.'/thumb_50x50_'.$aImage);

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
                $photo->url = $date.'/'.$aImage;
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
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy câu hỏi');
        }

        $images = $post->image()->get();
        if ( count($images) > 0 ) {
            foreach ( $images as $item ) {
                $deleteFile = $item->url ?? null;
                if ( !empty($deleteFile) ) {
                    $fileUnlink = Str::of('/'.$deleteFile)->basename();
                    @unlink(public_path('storage/products/'.$deleteFile));
                    @unlink(public_path('storage/products/'.str_replace($fileUnlink, 'thumb_'.$fileUnlink,
                            $deleteFile)));
                    @unlink(public_path('storage/products/'.str_replace($fileUnlink, 'thumb_50x50_'.$fileUnlink,
                            $deleteFile)));
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
        $url = route('backend.questions.category').'?'.Arr::query($params);
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
        if ( !$post ) {
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
        if ( !$post ) {
            return redirect()->route('backend.questions.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.questions.category')->with('success', 'Đã cập nhật thành công');
    }

    public function editCategory($id)
    {
        $post = $this->categoryRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
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
        if ( !$category ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        $category->posts()->delete();
        $category->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

    public function updateImageDefault(Request $request)
    {
        $id = $request->post_id ?? 0;
        $image_id = $request->image_id ?? 0;
        $post = $this->postRepository->getByID($id);
        if ( $post ) {
            $post->image()->update(['is_default' => 0]);
            $image = $this->imageRepository->getByID($image_id);
            $image->is_default = 1;
            $image->save();
            return ResponseHelper::success('Đã xóa thành công');
        }
        return ResponseHelper::error('Không tìm thấy tài khoản');
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAnswer(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->post_id ?? 0;
        $post = $this->postRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        $insert = ['is_correct' => 0];
        $this->data['value'] = $post->answers()->createMany([$insert])->first();
        $count = $post->answers()->count();
        $this->data['alphabet'] = StringHelper::convertToLetter($count);
        $html = view('components.backend.quiz.questions.ajaxanswer', $this->data)->render();
        //$data = [];
        return ResponseHelper::success('Đã xóa thành công',['jsonResult'=>$html]);
    }
}
