@layout('layouts/admin')

@section('head')
<title>Settings</title>
@endsection('head')

@section('body')

<h1 class="text-center m-12">Settings</h1>

<Settings :settings='{{{ $settings }}}' :fields='{{{ $fields }}}'></Settings>

@endsection('body')