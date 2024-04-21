<h2>List Countries</h2>
@if (session()->has('success'))

    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif
<a href="{{route('countries.create')}}">Create a new country</a>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    @foreach($countries as $country)
        <tr>
            <td>{{$country->id}}</td>
            <td>{{$country->code}}</td>
            <td>{{$country->name}}</td>
            <td>{{$country->description}}</td>
            <td>
                <a href="{{route('countries.edit', $country->id)}}">Edit</a>
                <form action="{{route('countries.destroy', $country->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $countries->links() }}
