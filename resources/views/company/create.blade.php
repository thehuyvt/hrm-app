<h2>Create a new department</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('department.store')}}" method="post">
    @csrf
    <label for="code">Code:
        <input type="text" name="code" value="{{old('code')}}">
    </label>
    <br>
    <label for="name">Name:
        <input type="text" name="name" value="{{old('name')}}">
    </label>
    <br>
    <label for="address">Address:
        <textarea name="address" cols="30" rows="4">{{old('address')}}</textarea>
    </label>
    <br>
    <input type="submit" value="Create">
</form>
