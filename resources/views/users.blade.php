<!DOCTYPE html>
<html>
<head>
    <title>Laravel Table Inline Editing Example - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
    <script>$.fn.poshytip={defaults:null}</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
</head>
<body>
      
<div class="container">
    <h1>Laravel Table Inline Editing Example - ItSolutionStuff.com</h1>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <a href="" class="update" data-name="name" data-type="text" data-pk="{{ $user->id }}" data-title="Enter name">{{ $user->name }}</a>
                        <a href="" class="update" data-name="email" data-type="text" data-pk="{{ $user->id }}" data-title="Enter email">{{ $user->email }}</a>
                    </td>
                    <td>
                        <a href="" class="update" data-name="email" data-type="text" data-pk="{{ $user->id }}" data-title="Enter email">{{ $user->email }}</a>
                    </td>
                </tr>
                
            @endforeach
            <tr id="addUserRow">
                <td></td>
                <td><input type="text" id="newUserName" placeholder="Enter name"></td>
                <td><input type="email" id="newUserEmail" placeholder="Enter email"></td>
                <td><button id="addUserBtn">Add User</button></td>
            </tr>
        </tbody>
    </table>
</div>
     
<h1>Список пользователей</h1>
    <ul>
        @foreach ($users as $user)
            @if ($user->phone == '2147483647')
                <li style="color: red;">{{ $user->name }}</li>
            @else
                <li>{{ $user->name }}</li>
            @endif
        @endforeach
    </ul>

</body>
     

</html>