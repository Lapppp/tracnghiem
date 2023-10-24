<?php

namespace App\Http\Controllers\Backend\Product;

use App\Enums\Modules\ModuleType;
use App\Enums\Posts\PostStatusType;
use App\Enums\Products\ColorType;
use App\Enums\Products\DeliveryTimeType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Category\CategoryRequest;
use App\Http\Requests\Backend\Product\ProductCreateRequest;
use App\Models\Images\Image;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Images\ImageRepository;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Units\UnitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image as ImageIntervention;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ProductController extends BackendController
{

    private $data = [];
    protected $productRepository, $categoryRepository,$brandRepository,$unitRepository,$imageRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        BrandRepository $brandRepository,
        UnitRepository $unitRepository,
        ImageRepository $imageRepository
    )
    {
        parent::__construct();
        View::share('title', 'Sản phẩm');
        $this->data['status'] = [
            PostStatusType::Approved => 'Xuất bản',
            PostStatusType::Deactivated => 'Nháp',
        ];

        $this->data['options'] = [
            PostStatusType::New => 'Mới',
            PostStatusType::Home => 'Sản phẩm ưu đãi 50%',
            PostStatusType::ProductHot => 'Sản phẩm khác',
        ];

        $this->data['colors'] = ColorType::Colors;
        $this->data['delivery_time'] = DeliveryTimeType::DeliveryTime;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->unitRepository = $unitRepository;
        $this->imageRepository = $imageRepository;
    }


    public function index( Request $request )
    {
        $params = $request->only(['search', 'status','category_id']);
        $paramsData = [
            'search'=>$request->search ?? '',
            'status'=>!empty($params['status']) ? [$params['status']] : [],
            'category_id'=>!empty($params['category_id']) ? [$params['category_id']] : []
        ];
        $post = $this->productRepository->getAll($paramsData, 20);
        $this->data['title'] = 'Sản phẩm';
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 20;

        $page = !empty($request->page) ? $request->page : 1;

        unset($params['page']);
        $url = route('backend.product.index') . '?' . Arr::query($params).'&';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        $this->data['params'] = $params;
        $this->data['statusSearch'] = $request->status ?? 0;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Product],'parent_id'=>[0]],null);
        return view('components.backend.product.index', $this->data);
    }

    public function create()
    {
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Product],'parent_id'=>[0]]);
        $this->data['isEdit'] = 0;
        $this->data['brands'] = $this->brandRepository->getAll([]);
        $this->data['units'] = $this->unitRepository->getAll([]);
        return view('components.backend.product.create', $this->data);
    }

    public function store( ProductCreateRequest $request )
    {
        $params = $request->all();
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['unit_id'] = $params['unit_id'] ?? 0;
        $params['brand_id'] = $params['brand_id'] ?? 0;
        $post = $this->productRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.product.index')->with('error', 'Server đang bận không thể tạo');
        }

        if ( $request->hasfile('files') ) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $path = $file->store('products/' . $date);
                $aImage = $file->hashName();
                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->is_default = ( $key == $n - 1 ) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $post->image()->save($photo);
                $pathOld = public_path('storage/products/' . $date . '/' . $aImage);
                $fileNew = public_path('storage/products/' . $date . '/thumb_' . $aImage);
                $fileNewSize = public_path('storage/products/' . $date . '/thumb_50x50_' . $aImage);

                // size height 165
                $img = ImageIntervention::make($pathOld);
                $img->heighten(165, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50
                $img->fit(50, 50, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);
            }
        }
        return redirect()->route('backend.product.index')->with('success', 'Đã tạo  thành công');
    }

    public function edit( $id )
    {
        $post = $this->productRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.product.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Product]]);
        $this->data['brands'] = $this->brandRepository->getAll([]);
        $this->data['units'] = $this->unitRepository->getAll([]);
        return view('components.backend.product.create', $this->data);
    }

    public function update( ProductCreateRequest $request, $id )
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['unit_id'] = $params['unit_id'] ?? 0;
        $params['brand_id'] = $params['brand_id'] ?? 0;
        $params['updated_at'] = date('Y-m-d H:i:s');
        $post = $this->productRepository->getByID($id);
        if ( !$post ) {
            return redirect()->route('backend.product.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        if ( $request->hasfile('files') ) {

//            $images = $post->image()->get();
//            if ( count($images) > 0 ) {
//                foreach ( $images as $item ) {
//                    $deleteFile = $item->url ?? null;
//                    if ( !empty($deleteFile) ) {
//                        $fileUnlink = Str::of('/' . $deleteFile)->basename();
//                        @unlink(public_path('storage/products/' . $deleteFile));
//                        @unlink(public_path('storage/products/' . str_replace($fileUnlink, 'thumb_' . $fileUnlink, $deleteFile)));
//                        @unlink(public_path('storage/products/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
//                    }
//                    $item->delete();
//                }
//            }

            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('products/' . $date);
                $aImage = $file->hashName();

                $pathOld = public_path('storage/products/' . $date . '/' . $aImage);
                $fileNew = public_path('storage/products/' . $date . '/thumb_' . $aImage);
                $fileNewSize = public_path('storage/products/' . $date . '/thumb_50x50_' . $aImage);

                // size height 165
                $img = ImageIntervention::make($pathOld);
                $img->heighten(165, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50

                $img->fit(50, 50, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->filename = $file->getClientOriginalName();
                $photo->is_default = ( $key == $n - 1 ) ? 1 : 0;
                $post->image()->save($photo);

            }
        }

        return redirect()->route('backend.product.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->productRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $images = $post->image()->get();
        if ( count($images) > 0 ) {
            foreach ( $images as $item ) {
                $deleteFile = $item->url ?? null;
                if ( !empty($deleteFile) ) {
                    $fileUnlink = Str::of('/' . $deleteFile)->basename();
                    @unlink(public_path('storage/products/' . $deleteFile));
                    @unlink(public_path('storage/products/' . str_replace($fileUnlink, 'thumb_' . $fileUnlink, $deleteFile)));
                    @unlink(public_path('storage/products/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                }
                $item->delete();
            }
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

    public function category( Request $request )
    {
        $params = $request->only(['username', 'password']);
        $post = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Product]], 20);
        $this->data['title'] = 'News';
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.product.category') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.product.category', $this->data);
    }

    public function createCategory()
    {
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Product]]);
        $this->data['isEdit'] = 0;
        $this->data['category_parents'] = $this->categoryRepository->getParentsActive(ModuleType::Product);
        $this->data['posts'] = [];
        return view('components.backend.product.category-create', $this->data);
    }

    public function storeCategory( CategoryRequest $request )
    {
        $params = $request->all();
        $params['status'] = 1;
        $params['module_id'] = ModuleType::Product;
        $post = $this->categoryRepository->create($params);

        if ( $request->hasfile('files') ) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $path = $file->store('category/' . $date);
                $aImage = $file->hashName();
                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->is_default = ( $key == $n - 1 ) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $post->image()->save($photo);
                $pathOld = public_path('storage/category/' . $date . '/' . $aImage);
                $fileNew = public_path('storage/category/' . $date . '/thumb_' . $aImage);
                $fileNewSize = public_path('storage/category/' . $date . '/thumb_50x50_' . $aImage);

                // size height 165
                $img = ImageIntervention::make($pathOld);
                $img->heighten(165, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50
                $img->fit(50, 50, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);
            }
        }
        if ( !$post ) {
            return redirect()->route('backend.product.category')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.product.category')->with('success', 'Đã tạo tài thành công');
    }

    public function updateCategory( CategoryRequest $request, $id )
    {
        $params = $request->all();
        $params['status'] = 1;
        $post = $this->categoryRepository->getByID($id);
        if ( !$post ) {
            return redirect()->route('backend.product.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        if ( $request->hasfile('files') ) {

            $images = $post->image()->get();
            if ( count($images) > 0 ) {
                foreach ( $images as $item ) {
                    $deleteFile = $item->url ?? null;
                    if ( !empty($deleteFile) ) {
                        $fileUnlink = Str::of('/' . $deleteFile)->basename();
                        @unlink(public_path('storage/category/' . $deleteFile));
                        @unlink(public_path('storage/category/' . str_replace($fileUnlink, 'thumb_' . $fileUnlink, $deleteFile)));
                        @unlink(public_path('storage/category/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                    }
                    $item->delete();
                }
            }

            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('category/' . $date);
                $aImage = $file->hashName();

                $pathOld = public_path('storage/category/' . $date . '/' . $aImage);
                $fileNew = public_path('storage/category/' . $date . '/thumb_' . $aImage);
                $fileNewSize = public_path('storage/category/' . $date . '/thumb_50x50_' . $aImage);

                // size height 165
                $img = ImageIntervention::make($pathOld);
                $img->heighten(165, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50

                $img->fit(50, 50, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->filename = $file->getClientOriginalName();
                $photo->is_default = ( $key == $n - 1 ) ? 1 : 0;
                $post->image()->save($photo);

            }
        }
        return redirect()->route('backend.product.category')->with('success', 'Đã cập nhật thành công');
    }

    public function editCategory( $id )
    {
        $post = $this->categoryRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.product.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['category_parents'] = $this->categoryRepository->getParentsActive(ModuleType::Product);
        return view('components.backend.product.category-create', $this->data);
    }

    public function destroyCategory( $id )
    {
        $category = $this->categoryRepository->getByID($id);
        if ( !$category ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $images = $category->image()->get();
        if ( count($images) > 0 ) {
            foreach ( $images as $item ) {
                $deleteFile = $item->url ?? null;
                if ( !empty($deleteFile) ) {
                    $fileUnlink = Str::of('/' . $deleteFile)->basename();
                    @unlink(public_path('storage/category/' . $deleteFile));
                    @unlink(public_path('storage/category/' . str_replace($fileUnlink, 'thumb_' . $fileUnlink, $deleteFile)));
                    @unlink(public_path('storage/category/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                }
                $item->delete();
            }
        }

        $category->posts()->delete();
        $category->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

    public function updateCategoryImageDefault(Request $request) {
        $id = $request->post_id ?? 0;
        $image_id = $request->image_id ?? 0;
        $post = $this->categoryRepository->getByID($id);
        if($post) {
            $post->image()->update(['is_default' => 0 ]);
            $image = $this->imageRepository->getByID($image_id);
            $image->is_default = 1;
            $image->save();
            return ResponseHelper::success('Đã xóa thành công');
        }
        return ResponseHelper::error('Không tìm thấy tài khoản');
    }

    public function updateImageDefault(Request $request) {
        $id = $request->post_id ?? 0;
        $image_id = $request->image_id ?? 0;
        $post = $this->productRepository->getByID($id);
        if($post) {
            $post->image()->update(['is_default' => 0 ]);
            $image = $this->imageRepository->getByID($image_id);
            $image->is_default = 1;
            $image->save();
             return ResponseHelper::success('Đã xóa thành công');
        }
        return ResponseHelper::error('Không tìm thấy tài khoản');
    }

    public function export(Request $request) {

        $paramsData = [
            'search'=>$request->search ?? '',
            'status'=>!empty($request->status) ? [$request->status] : [],
            'category_id'=>!empty($request->category_id) ? [$request->category_id] : []
        ];

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(public_path('template/template.xlsx'));
        $sheet = $spreadsheet->getActiveSheet();

        $styleArray = [
            'alignment' => [
                'wrapText' => true,
                'vertical'=>\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ]
        ];

        $posts = $this->productRepository->getAll($paramsData, null);
        if($posts->count() > 0) {
            $i = 2;
            foreach ( $posts as $key => $value) {
                $sheet->setCellValue('A'.$i,$value->name ?? '');
                $sheet->setCellValue('B'.$i,$value->description ?? '');
                $sheet->setCellValue('C'.$i,$value->short_description ?? '');
                $sheet->setCellValue('D'.$i,$value->price ?? '');
                $sheet->setCellValue('E'.$i,$value->specifications ?? '');
                $sheet->setCellValue('F'.$i,$value->service_policy ?? '');
                $sheet->setCellValue('G'.$i,$value->choose_kenji ?? '');
                $sheet->setCellValue('H'.$i,$value->id ?? '');

                if($value->default() && $value->default()['url']) {
                    $file = public_path('storage/products/' . $value->default()['url']);
                    if(file_exists($file)) {

                        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                        $drawing->setName($value->name);
                        $drawing->setDescription($value->name);
                        $drawing->setPath($file); /* put your path and image here */
                        $drawing->getShadow()->setVisible(true);
                        $drawing->setHeight(100);
                        $drawing->setWidth(100);
                        $drawing->setCoordinates('H'.$i);
                        $drawing->setWorksheet($sheet);
                        $sheet->getRowDimension(1)->setRowHeight(80);
                        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                    }
                }

                $sheet->getStyle('A'.$i.':H'.$i)->applyFromArray($styleArray);
                $i++;
            }

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
            $date = date('d-m-Y').'-'.time();
            $writer->save(public_path('uploads/userfiles/files').'/products-'.$date.'.xlsx');
            $data = [
                'url' => url('uploads/userfiles/files/').'/products-'.$date.'.xlsx'
            ];
            return ResponseHelper::success('Thành công',$data);
        }
        return ResponseHelper::error('Không có dữ liệu');
    }
}
