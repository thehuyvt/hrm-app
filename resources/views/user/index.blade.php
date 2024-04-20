<h2>List Countries</h2>
@if (session()->has('success'))

    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif
<a href="{{route('users.create')}}">Create a new user</a>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Full name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->person->full_name}}</td>
            <td>{{$user->person->genderName}}</td>
            <td>{{$user->person->age}}</td>
            <td>{{$user->person->phone_number}}</td>
            <td>{{$user->person->address}}</td>
            <td>{{$user->activeName}}</td>
            <td>
                <a href="{{route('users.edit', $user->id)}}">Edit</a>
                <form action="{{route('users.destroy', $user->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $users->links() }}
