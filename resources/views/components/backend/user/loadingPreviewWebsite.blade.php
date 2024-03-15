<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>Thiết bị</th>
            <th>Nội dung</th>
            <th>Địa chỉ IP</th>
            <th>Ngày đăng nhập</th>
        </tr>
        </thead>
        <tbody>
            @foreach($userAgent as $key => $value)
                <tr>
                    <td>{{ $value->deviceType }}</td>
                    <td>{{ $value->description ?? '' }}</td>
                    <td>{{ $value->ip_login ?? '' }}</td>
                    <td>{{ !empty($value->created_at) ? date('d/m/Y',strtotime($value->created_at)) : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
