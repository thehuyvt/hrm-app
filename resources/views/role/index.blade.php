<h2>List Roles</h2>
@if (session()->has('success'))

    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif
<a href="{{route('roles.create')}}">Create a new role</a>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Role</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    @foreach($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->role}}</td>
            <td>{{$role->description}}</td>
            <td>
                <a href="{{route('roles.edit', $role->id)}}">Edit</a>
                <form action="{{route('roles.destroy', $role->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    @endforeach
</table>
