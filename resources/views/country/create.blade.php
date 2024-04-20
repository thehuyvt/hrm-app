<h2>Create a new country</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('countries.store')}}" method="post">
    @csrf
    <label for="code">Code:
        <input type="text" name="code" value="{{old('code')}}">
    </label>
    <br>
    <label for="name">Name:
        <input type="text" name="name" value="{{old('name')}}">
    </label>
    <br>
    <label for="description">Description:
        <input type="text" name="description" value="{{old('description')}}">
    </label>
    <br>
    <input type="submit" value="Create">
</form>
