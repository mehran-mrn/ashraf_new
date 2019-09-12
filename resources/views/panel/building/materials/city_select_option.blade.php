<option value="0">---</option>
@foreach($cities as $city)
    <option value="{{$city['id']}}">{{$city['name']."  "}}
    </option>
@endforeach