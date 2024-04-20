<h2>Edit this country</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('countries.update', $country)}}" method="post">
    @csrf
    @method('PUT')
{{--    <input type="hidden" name="code" value="{{$country->id}}">--}}
    <label for="code">Code:
        <input type="text" name="code" value="{{$country->code}}">
    </label>
    <br>
    <label for="name">Name:
        <input type="text" name="name" value="{{$country->name}}">
    </label>
    <br>
    <label for="description">Description:
        <input type="text" name="description" value="{{$country->description}}">
    </label>
    <br>
    <input type="submit" value="Update">
</form>
