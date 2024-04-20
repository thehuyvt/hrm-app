@php
        function showChildDepartment($departments) {
        $html = "";
        foreach ($departments as $department) {
            $html .= '<tr>';
            $html .= '<td>';
            $html .= '<a href="' . route('departments.edit', $department->code) . '">Edit</a>';
            $html .= '<form action="' . route('departments.destroy', $department->code) . '" method="post">';
            $html .= '<input type="hidden" name="_token" value='.csrf_token().'>';
            $html .= '<input type="hidden" name="_method" value="DELETE">';
            $html .= '<input type="submit" value="Delete">';
            $html .= '</form>';
            $html .= '</td>';
            $html .= '<td>' . $department->code . '</td>';
            $html .= '<td>' . $department->name . '</td>';
            $html .= '</tr>';

            if (!$department->child->isEmpty()){
                $html .= showChildDepartment($department->child);
            }
        }
        return $html;
    }

    function buildTree($departments) {
        $html = '<ul>';
        foreach ($departments as $department) {
            $html .= '<li>';
            $html .= $department->name;
            if (!$department->child->isEmpty()) {
                $html .= buildTree($department->child);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
@endphp

<h2>Edit company</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('companies.update', $company->id)}}" method="post">
    @csrf
    @method('PUT')
    <label for="code">Code:
        <input type="text" name="code" value="{{$company->code}}">
    </label>
    <br>
    <label for="name">Name:
        <input type="text" name="name" value="{{$company->name}}">
    </label>
    <br>
    <label for="address">Address:
        <textarea name="address" cols="30" rows="4">{{$company->address}}</textarea>
    </label>
    <br>
    <input type="submit" value="Update">
</form>

<h3>Danh mục phòng ban của công ty</h3>
<a href="{{route('departments.create', $company->id)}}">Thêm phòng ban mới cho công ty {{$company->name}}</a>

<table border="1" width="100%">
    <thead>
    <tr>
        <th>Thao tác</th>
        <th>Mã</th>
        <th>Tên phòng ban</th>
    </tr>
    </thead>

    @php
        $treeView = buildTree($departments);
        echo $treeView;
    @endphp
    @php
        $treeView = showChildDepartment($departments);
        echo $treeView;
    @endphp
</table>

