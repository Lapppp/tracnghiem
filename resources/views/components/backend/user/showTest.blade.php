<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>Bài kiểm tra</th>
            <th>Ngày thi</th>
        </tr>
        </thead>
        <tbody>
        @if($user->tests()->count() > 0)
            @foreach($user->tests()->get() as $key => $value)
                <tr>
                    <td>{{ $value->title ?? '' }}</td>
                    <td>{{ !empty($value->created_at) ? date('d/m/Y',strtotime($value->created_at)) : '' }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td> - </td>
                <td> - </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
