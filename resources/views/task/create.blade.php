<h2>Create a new task</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('tasks.store')}}" method="post">
    @csrf
    <label for="name">Name:
        <input type="text" name="name" value="{{old('name')}}">
    </label>
    <br>
    <label for="description">Description:
        <textarea name="description">{{old('description')}}</textarea>
    </label>
    <br>
    <label for="project_id">Project:
        <select name="project_id" id="projectSelect">
            @foreach($projects as $project)
                <option value="{{$project->code}}">{{$project->name}}</option>
            @endforeach
        </select>
    </label>
    <br>
    <label for="person_id">Person:
        <select name="person_id" id="personSelect">

        </select>
    </label>
    <br>
    <label for="start_time">Start time:
        <input type="date" name="start_time" value="{{old('start_time')}}">
    </label>
    <br>
    <label for="end_time">End time:
        <input type="date" name="end_time" value="{{old('end_time')}}">
    </label>
    <br>
    <label for="priority">Priority:
        <select name="priority">
            @foreach($listPriorities as $key => $priority)
                <option value="{{$priority->value}}">{{$key}}</option>
            @endforeach
        </select>
    </label>
    <br>
    <label for="status">Status:
        <select name="status">
            @foreach($listStatus as $key => $status)
                <option value="{{$status->value}}">{{$key}}</option>
            @endforeach
        </select>
    </label>
    <br>
    <input type="submit" value="Create">
</form>

<script>
    let projectSelect = document.getElementById('projectSelect');
    let personSelect = document.getElementById('personSelect');
    var projects = {!! json_encode($projects->toArray()) !!};
    // console.log(projects);
    function addOption(){
        let project = projectSelect.value;
        personSelect.options.length = 0;
        for(let i = 0; i < projects.length; i++){
            if (projects[i]['code'] === parseInt(project) ){
                // console.log(1);
                var people = projects[i]['people'];
                for(let j = 0; j < people.length; j++){
                    var option = document.createElement("option");
                    option.text = people[j]['full_name'];
                    // console.log(people);
                    option.value = people[j]['id']; // Optional: You can set a value for each option
                    personSelect.appendChild(option);
                }
            }
        }
    }
    addOption();
    projectSelect.addEventListener('change', addOption);
</script>
