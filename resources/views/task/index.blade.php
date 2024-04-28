<h2>List Tasks</h2>
@if (session()->has('success'))

    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif
<a href="{{route('tasks.create')}}">Create a new task</a>
<br>
<a href="{{route('tasks.printPdf')}}">Print list tasks</a>

<table border="1" width="100%">
    <caption>
        <form action="{{route('tasks.index')}}" method="get">
            <h3>Filter task</h3>
            <label>Company
                <select name="company" id="selectCompany">
                    <option value="">All</option>

                    @foreach($companies as $company)
                        <option value="{{$company->id}}"
                                @if($company->id === (int)request()->get('company')) selected @endif>{{$company->name}}</option>
                    @endforeach
                </select>
            </label>
            <label>Project
                <select name="project" id="selectProject">
                    <option value="">All</option>

                </select>
            </label>
            <label>Status
                <select name="status">
                    <option value="">All</option>

                    @foreach($listStatus as $key => $status)
                        <option value="{{$status->value}}"
                        @if($status->value === (int)request()->get('status')) selected @endif>{{$key}}</option>
                    @endforeach
                </select>
            </label>
{{--            <label>{{request()->get('status')}}</label>--}}
            <label>Priority
                <select name="priority">
                    <option value="">All</option>

                    @foreach($listPriorities as $key => $priority)
                        <option value="{{$priority->value}}"
                                @if($priority->value === (int)request()->get('priority')) selected @endif>{{$key}}</option>
                    @endforeach
                </select>
            </label>
            <label>Name
                <input type="text" name="name" value="{{request()->get('name')}}">
            </label>
{{--            <input type="search" name="name" placeholder="search name ...">--}}
            <input type="submit" value="Search">
        </form>
    </caption>
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
            <th>Action</th>
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
            <td>
                <a href="{{route('tasks.edit', $task->id)}}">Edit</a>
                <form action="{{route('tasks.destroy', $task->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $tasks->appends(request()->all())->links() }}

<script>
    let selectProject = document.getElementById('selectProject');
    let selectCompany = document.getElementById('selectCompany');
    let companies = {!! json_encode($companies->toArray()) !!};
    console.log(companies);
    function addOption(){
        let company = document.getElementById('selectCompany').value;
        selectProject.options.length = 1;

        for (let i = 0; i < companies.length; i++){
            if (companies[i]['id'] === parseInt(company)){
                console.log(companies[i]);
                let projects = companies[i]['projects'];
                console.log(companies[i]['projects']);
                for (let j = 0; j < projects.length; j++){
                    var option = document.createElement("option");
                    option.text = projects[j]['name'];
                    option.value = projects[j]['code'];
                    // if (projects[j]['id'] === request()){
                    //     option.selected = true;
                    // }
                    selectProject.appendChild(option);
                }
            }
        }
    }
    addOption();
    selectCompany.addEventListener('change', addOption);
</script>
