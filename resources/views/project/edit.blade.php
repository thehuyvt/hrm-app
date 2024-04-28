<h2>Chỉnh sửa thông tin dự án</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('projects.update', $project->code)}}" method="post">
    @csrf
    @method('PUT')
    <label for="name">Name:
        <input type="text" name="name" value="{{$project->name}}">
    </label>
    <br>
   <label for="description">Description
       <textarea cols="30" rows="4" name="description">{{$project->description}}</textarea>
   </label>
    <br>
    <label for="company_id">Company:
        <select name="company_id" id="company_id" onchange="addOption()">
            @foreach($companies as $company)
                <option value="{{$company->id}}"
                    @if($company->id === $project->company_id) selected @endif>
                    {{$company->name}}
                </option>
            @endforeach
        </select>
    </label>
    <br>
    <label for="people">People:
        <select id="people"  name="people[]" multiple>
        </select>
    </label>
    <br>
    <input type="submit" value="Create">
</form>

<script>
    var selectPeople = document.getElementById('people');
    var companies = {!! json_encode($companies->toArray()) !!};

    // console.log(companies[3]['people'][1]['full_name']);
    // console.log(companies[3]['people']);
    function addOption(){
        var selectCompany = document.querySelector('#company_id').value;
        selectPeople.options.length = 0;
        for (let  i = 0; i < companies.length; i++){
            if (companies[i]['id'] === parseInt(selectCompany) ){
                // console.log(1);
                var people = companies[i]['people'];
                for(let j = 0; j < people.length; j++){
                    var option = document.createElement("option");
                    option.text = people[j]['full_name'];
                    // console.log(people);
                    option.value = people[j]['id'];

                    let peopleSelected = [];
                    peopleSelected = @php foreach ($companies as $company)
                                            {
                                                if ($company->id === $project->company_id){
                                                    Print($project->people);
                                                }
                                            }
                                    @endphp;

                    // console.log(peopleSelected);
                    peopleSelected.forEach(function (e){
                        if (e['id'] ===  people[j]['id']){
                            option.selected = true;
                        }
                    })
                    selectPeople.appendChild(option);
                }
            }
        }
    }
    addOption();

</script>
