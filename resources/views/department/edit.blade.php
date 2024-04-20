<h2>Sửa phòng ban</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('departments.update', $department->code)}}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="code" value="{{$department->code}}">
    <input type="hidden" name="company_id" value="{{$department->company_id}}">
    <br>
    <label for="name">Name:
        <input type="text" name="name" value="{{$department->name}}">
    </label>
    <br>
    <label for="parent_id">Department Parent:
        <select name="parent_id">
            <option value="">Không</option>
            @foreach($departments as $each)
                <option value="{{$each->code}}"
                @if($each->code === $department->code)
                    checked
                    @endif>
                    {{$each->name}}
                </option>
            @endforeach
        </select>
    </label>
    <br>
    <input type="submit" value="Update">
</form>
