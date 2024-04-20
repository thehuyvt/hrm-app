<h2>Create a new user</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('users.store')}}" method="post">
    @csrf
    <label for="email">Email:
        <input type="email" name="email" value="{{old('email')}}">
    </label>
    <br>
    <label for="password">Password:
        <input type="password" name="password" value="{{old('password')}}">
    </label>
    <br>
    <label for="listRoleId">Role:
        <select name="listRoleId[]" multiple>
            @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->role}}</option>
            @endforeach
        </select>
    </label>
    <br>
    <h4>Thông tin chi tiết</h4>
    <label for="full_name">Full name:
        <input type="text" name="full_name" value="{{old('full_name')}}">
    </label>
    <br>
    <label for="gender">Gender:
        <input type="radio" name="gender" value="1" checked> Nam
        <input type="radio" name="gender" value="0"> Nữ
    </label>
    <br>
    <label for="birthdate">Birthdate:
        <input type="date" name="birthdate" value="{{old('birthdate')}}">
    </label>
    <br>
    <label for="phone_number">Phone number:
        <input type="text" name="phone_number" value="{{old('phone_number')}}">
    </label>
    <br>
    <label for="address">Address:
        <textarea name="address" rows="4" cols="30">{{old('address')}}</textarea>
    </label>
    <br>
    <label for="company_id">Company:
        <select name="company_id">
            @foreach($companies as $company)
                <option value="{{$company->id}}">{{$company->name}}</option>
            @endforeach
        </select>
    </label>
    <br>
    <input type="submit" value="Create">
</form>
