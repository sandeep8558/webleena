@layout('layouts/admin')

@section('head')
<title>User Manager</title>
@endsection('head')

@section('body')

<crud file="auth" title="User Manager" btn="Add User" color="warning"></crud>

@endsection('body')