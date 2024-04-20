<h2>List Companies</h2>
@if (session()->has('success'))

    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif
<a href="{{route('companies.create')}}">Create a new company</a>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    @foreach($companies as $company)
        <tr>
            <td>{{$company->id}}</td>
            <td>{{$company->code}}</td>
            <td>{{$company->name}}</td>
            <td>{{$company->address}}</td>
            <td>
                <a href="{{route('companies.edit', $company->id)}}">Edit</a>
                <form action="{{route('companies.destroy', $company->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    @endforeach
</table>
