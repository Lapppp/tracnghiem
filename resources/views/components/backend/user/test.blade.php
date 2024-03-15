<x-layout.backend>

    @include('components.backend.shared.messages')
    <div class="card mb-5 mb-xl-8">

        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Kết quả thi</span>
            </h3>
            <div class="card-title">
                <div class="d-flex align-items-center position-relative me-2">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute"><span class="path1"></span><span class="path2"></span></i>
                    <input type="text" value="{{ $params['search'] ?? '' }}" id="search" name="search" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid  ps-12 form-control-sm" placeholder="Tìm kiếm khách hàng">
                </div>
                <div class="d-flex align-items-center position-relative me-2">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute"><span class="path1"></span><span class="path2"></span></i>
                    <input type="text" value="{{ $params['start_date'] ?? '' }}" id="start_date" name="start_date" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid  ps-12 form-control-sm" placeholder="Ngày bắt đầu">
                </div>

                <div class="d-flex align-items-center position-relative me-2">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute"><span class="path1"></span><span class="path2"></span></i>
                    <input type="text" value="{{ $params['end_date'] ?? '' }}" id="end_date" name="end_date" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid  ps-12 form-control-sm" placeholder="Ngày kết thúc">
                </div>

                <div class="d-flex align-items-center position-relative me-2">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span class="path1"></span><span class="path2"></span></i>
                    <a href="#" class="btn btn-primary btn-sm" id="searchUser">Tìm kiếm</a>
                </div>
                <div class="d-flex align-items-center position-relative me-2">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span class="path1"></span><span class="path2"></span></i>
                    <a href="#" target="_blank" class="btn btn-primary btn-sm" id="ExportExcel">Xuất Excel</a>
                </div>
            </div>

        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-250px rounded-start">Họ tên</th>
                        <th>Tên bài kiểm tra</th>
                        <th>Email</th>
                        <th>Trạng thái</th>
                        <th>Điểm (số câu đúng)</th>
                        <th>Ngày thi</th>
                        <th>Ngày cập nhật</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(count($items) > 0)
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-5">
                                            @if($item->default() && $item->default()['url'])
                                                <img src="{{ str_replace(Str::of($item->default()['url'])->basename(),'thumb_50x50_'.Str::of($item->default()['url'])->basename(),asset('storage/avatar/'.$item->default()['url'])) }}"
                                                     class=""
                                                     alt=""/>
                                            @else
                                                <img src="{{ Avatar::create($item->name)->toBase64() }}"
                                                     class=""
                                                     alt=""/>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $item->name ?? $item->username ?? '' }}</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">{{ $item->title ?? '' }}</span>
                                </td>

                                <td>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">{{ $item->email }}</span>
                                </td>

                                <td>
                                    @if($item->status)
                                        <span class="badge badge-light-primary fs-7 fw-bold">Đang hoạt động</span>
                                    @else
                                        <span class="badge badge-light-danger fs-7 fw-bold">Ngừng hoạt động</span>
                                    @endif
                                </td>

                                <td class="text-center">

                                    <span class="badge badge-success">{{ $item->score ?? 0 }}</span>
                                </td>
                                <td>
                                   {{ !empty($item->created_at ) ? date('d/m/Y',strtotime($item->created_at)) : ''}}
                                </td>



                                <td class="text-end">
                                    {{ !empty($item->updated_at ) ? date('d/m/Y',strtotime($item->updated_at)) : ''}}


                                </td>
                            </tr>
                        @endforeach
                    @else
                        @include('components.backend.shared.user')
                    @endif

                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->


            <!--begin::Pagination-->
            @if(count($items) > 0)
                {!! $pager !!}
            @endif

{{--            @includeIf('components.backend.shared.pagination', ['total' => count($items)])--}}


        </div>
        <!--begin::Body-->
    </div>



    <x-slot name="javascript">
        <script type="text/javascript">
            $(document).ready(function() {
                $("#start_date,#end_date").flatpickr({
                    dateFormat: "d-m-Y",
                });


                $(document).on('click','a#searchUser',function(event) {
                    event.preventDefault();

                    let search = $('#search').val();
                    let start_date = $('#start_date').val();
                    let end_date = $('#end_date').val();
                    window.location.href = '{{ Route('backend.test.userxx.index')}}?search='+search+'&start_date='+start_date+'&end_date='+end_date;
                    return false;
                });



                $(document).on('click','a#ExportExcel',function(event) {
                    event.preventDefault();

                    let search = $('#search').val();
                    let start_date = $('#start_date').val();
                    let end_date = $('#end_date').val();
                    let url = '{{ Route('backend.user.exportTest.index')}}?search='+search+'&start_date='+start_date+'&end_date='+end_date;
                    window.open(url, '_blank');
                    return false;
                });



            });
        </script>
    </x-slot>

</x-layout.backend>
