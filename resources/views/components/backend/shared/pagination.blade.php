@if($total > 0)
    <div class="d-flex justify-content-end flex-stack flex-wrap pt-1">
        {{--                {{ __('account/index.failed') }}--}}
        {{--                <x-shared.forms.alert message="{{ __('account/index.failed') }}"></x-shared.forms.alert>--}}
        <ul class="pagination pagination-circle">
            <li class="page-item previous disabled"><a href="#" class="page-link"><i class="previous"></i></a>
            </li>
            <li class="page-item "><a href="#" class="page-link">1</a></li>
            <li class="page-item active"><a href="#" class="page-link">2</a></li>
            <li class="page-item "><a href="#" class="page-link">3</a></li>
            <li class="page-item "><a href="#" class="page-link">4</a></li>
            <li class="page-item "><a href="#" class="page-link">5</a></li>
            <li class="page-item "><a href="#" class="page-link">6 {{$status}}</a></li>
            <li class="page-item next"><a href="#" class="page-link"><i class="next"></i></a></li>
        </ul>
    </div>
@endif
