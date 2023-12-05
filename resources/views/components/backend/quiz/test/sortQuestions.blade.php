<div class="table-responsive">
    <table class="table table-bordered">
            <thead>
            <tr class="fw-bold fs-6 text-gray-800">
                <th scope="col" style="width: 10%">Sắp xếp</th>
                <th scope="col">Tên câu hỏi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($questions as $key => $value)
                <tr>
                    <th scope="row">
                        <input type="number" name="sortQuestions[]" data-change="on" class="form-control form-control-sm" value="{{ $value->pivot->order_by}}">
                        <input type="hidden" data-change="on" name="question_id[]" value="{{ $value->id }}">
                    </th>
                    <td>{{ $value->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>


