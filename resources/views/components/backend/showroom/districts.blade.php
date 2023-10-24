@if(count($districts) > 0)
    <option value="">---</option>
    @foreach($districts as $district)
        <option value="{{ $district->id }}" @if($selected_district == $district->id) selected="selected" @endif >{{ $district->name ?? '' }}</option>
    @endforeach
@endif
