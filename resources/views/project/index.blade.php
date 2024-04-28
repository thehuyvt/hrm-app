<h2>Danh sách các dự án</h2>
@if (session()->has('success'))

    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif
<a href="{{route('projects.create')}}">Tạo mới dự án</a>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Description</th>
            <th>Company</th>
            <th>People in project</th>
            <th>Action</th>

        </tr>
    </thead>
    @foreach($projects as $project)
        <tr>
            <td>{{$project->code}}</td>
            <td>{{$project->name}}</td>
            <td>{{$project->description}}</td>
            <td>{{$project->company->name}}</td>
            <td>
                @foreach($project->people as $person)
                    {{$person->full_name. ', '}}
                @endforeach</td>
            <td>
                <a href="{{route('projects.edit', $project->code)}}">Edit</a>
                <form action="{{route('projects.destroy', $project->code)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $projects->links() }}
