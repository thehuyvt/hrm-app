<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
</head>
<body>
<h1>{{ $title }}</h1>
<p>{{ $date }}</p>
<br/>
<br/>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Project</th>
            <th>Person</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Description</th>
            <th>Start time</th>
            <th>End time</th>
        </tr>
    </thead>
    @foreach($tasks as $task)
        <tr>
            <td>{{$task->id}}</td>
            <td>{{$task->name}}</td>
            <td>{{$task->project->name}}</td>
            <td>{{$task->person->full_name}}</td>
            <td>{{$task->priority}}</td>
            <td>{{$task->status}}</td>
            <td>{{$task->description}}</td>
            <td>{{$task->start_time}}</td>
            <td>{{$task->end_time}}</td>

        </tr>
    @endforeach
</table>
{{--{{ $tasks->appends(request()->all())->links() }}--}}


</body>
</html>