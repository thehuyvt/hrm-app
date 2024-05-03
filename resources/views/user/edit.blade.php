<h2>Edit a new user</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('users.update', $user->id)}}" method="post">
    @csrf
    @method('PUT')
    <label for="email">Email:
        <input type="email" name="email" value="{{$user->email}}">
    </label>
{{--    <br>--}}
{{--    <label for="password">Password:--}}
{{--        <input type="password" name="password" value="{{$user->password}}">--}}
{{--    </label>--}}
    <br>
    <label for="listRoleId">Role:
        <select name="listRoleId[]" multiple>
            @foreach($roles as $role)
                <option value="{{$role->id}}"
                @foreach($selectedRoles as $selectedRole)
                       @if($role->id === $selectedRole->id) selected @endif
                @endforeach>
                    {{$role->role}}
                </option>
            @endforeach
        </select>
    </label>
    <br>
    <h4>Profile</h4>
    <label for="full_name">Full name:
        <input type="text" name="full_name" value="{{$user->person->full_name}}">
    </label>
    <br>
    <label for="gender">Gender:
        <input type="radio" name="gender" value="1" @if($user->person->gender === 1) checked @endif> Nam
        <input type="radio" name="gender" value="0"  @if($user->person->gender === 0) checked @endif> Nữ
    </label>
    <br>
    <label for="birthdate">Birthdate:
        <input type="date" name="birthdate" value="{{$user->person->birthdate}}">
    </label>
    <br>
    <label for="phone_number">Phone number:
        <input type="text" name="phone_number" value="{{$user->person->phone_number}}">
    </label>
    <br>
    <label for="address">Address:
        <textarea name="address" rows="4" cols="30">{{$user->person->address}}</textarea>
    </label>
    <br>
    <label for="company_id">Company:
        <select name="company_id">
            @foreach($companies as $company)
                <option value="{{$company->id}}"
                @if($company->id === $user->person->company_id)
                    selected
                @endif>
                    {{$company->name}}
                </option>
            @endforeach
        </select>
    </label>
    <br>
    <input type="submit" value="Update">
</form>
