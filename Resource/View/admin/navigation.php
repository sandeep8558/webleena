@layout('layouts/app')

@section('head')
<title>Navigation</title>
@endsection('head')

@section('body')

<navigation :pages='{{{ $pages }}}'></navigation>

@endsection('body')