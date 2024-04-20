<h2>Thêm mới phòng ban</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('departments.store')}}" method="post">
    @csrf
    <input type="hidden" name="company_id" value="{{$company->id}}">
    <label for="code">Code:
        <input type="text" name="code" value="{{old('code')}}">
    </label>
    <br>
    <label for="name">Name:
        <input type="text" name="name" value="{{old('name')}}">
    </label>
    <br>
    <label for="parent_id">Department Parent:
        <select name="parent_id">
            <option value="">Không</option>
            @foreach($company->department as $each)
                <option value="{{$each->code}}">{{$each->name}}</option>
            @endforeach
        </select>
    </label>
    <br>
    <input type="submit" value="Create">
</form>
