@layout('layouts/admin')

@section('head')
<title>Settings</title>
@endsection('head')

@section('body')

<h1 class="text-center m-12">Settings</h1>

<div class="container shadow-4 rounded-8 p-15 m-12">

@foreach($settings as $k=>$v)

<div class="p-10">
    <span class="capitalize">{{ $k }}</span> : {{ input($fields[$k], $k, $v) }}
</div>

@endforeach

</div>

@endsection('body')