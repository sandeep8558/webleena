@layout('layouts/admin')

@section('head')
<title>User Manager</title>
@endsection('head')

@section('body')

<!-- <user-manager></user-manager> -->

<crud file="auth" title="User Manager" btn="Add User" color="warning"></crud>

@endsection('body')