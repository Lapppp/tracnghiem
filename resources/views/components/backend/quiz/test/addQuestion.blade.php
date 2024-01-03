@foreach($questions as $key => $question)
    <tr>
        <th scope="row">
            <input type="number" value="{{ $question->pivot->order }}" data-post_id="{{ $question->id }}" data-part_id="{{ $question->pivot->part_id }}" class="form-control form-control-sm">
        </th>
        <td>{{ $question->name ?? '' }}</td>
    </tr>
@endforeach

