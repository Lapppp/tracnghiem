<option value=""> -- [Chọn Quận] --</option>
@foreach($district as $district)
    <option value="{{ $district->id }}">{{ $district->name ?? '' }}</option>
@endforeach
