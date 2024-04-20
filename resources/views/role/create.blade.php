<h2>Create a new role</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('roles.store')}}" method="post">
    @csrf
    <label for="role">Role:
        <input type="text" name="role" value="{{old('role')}}">
    </label>
    <label for="description">Description:
        <input type="text" name="description" value="{{old('description')}}">
    </label>
    <br>
    <input type="submit" value="Create">
</form>
