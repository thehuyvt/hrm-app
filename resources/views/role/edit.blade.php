<h2>Edit this role</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('roles.update', $role)}}" method="post">
    @csrf
    @method('PUT')
{{--    <input type="hidden" name="code" value="{{$role->id}}">--}}
    <label for="role">Role:
        <input type="text" name="role" value="{{$role->role}}">
    </label>
    <br>
    <label for="description">Description:
        <input type="text" name="description" value="{{$role->description}}">
    </label>
    <br>
    <input type="submit" value="Update">
</form>
