@layout('layouts/admin')

@section('head')
<title>Element <?php echo $request['elm']; ?></title>
@endsection('head')

@section('body')

<crud file="{{{ $request['elm'] }}}" dir="Elements"></crud>


@endsection('body')