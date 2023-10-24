<x-layout.frontend>

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title text-white mb-25">Kết quả các bài kiểm tra</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a class="text-white"
                                                                            href="{{ Route('frontend.home.index') }}">Trang
                                    chủ</a></li>
                            <li class="breadcrumb__content--menu__items"><a class="text-white"
                                                                            href="{{ Route('frontend.tests.index') }}">Làm các bài kiểm tra khác</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <section class="contact__section section--padding">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">Các bài kiểm tra đã thi</h2>
            </div>
            <div class="main__contact--area position__relative">

                <div class="contact__form" style="margin-left: 0px !important;font-weight: normal">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên bài thi</th>
                            <th scope="col">Ngày thi</th>
                            <th scope="col">Xem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($posts as $key => $post)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $post->title ?? '' }}</td>
                                <td>{{ !empty($post->created_at) ? date('d/m/Y',strtotime($post->created_at)) : '' }}</td>
                                <td><a class="btn btn-primary btn-sm" href="{{ Route('frontend.tests.result',['id'=>$post->id]) }}" target="_blank" role="button">Xem kết quả</a></td>
                            </tr>
                        @empty
                            <tr>
                                <th scope="row">-</th>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="pagination__area bg__gray--color">
                    <nav class="pagination justify-content-center">
                        @if(!empty($pager))
                            {!! $pager !!}
                        @endif
                    </nav>
                </div>

            </div>
        </div>
    </section>

    <x-slot name="javascript">
        <script type="text/javascript">
            $( document ).ready(function() {

            });
        </script>
    </x-slot>
</x-layout.frontend>
