@layout('layouts/admin')

@section('head')
<title>Navigation</title>
@endsection('head')

@section('body')

<navigation :pages='{{{ $pages }}}'></navigation>

@endsection('body')