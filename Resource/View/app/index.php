@layout('layouts/app')

@section('head')
<title>Demo Page</title>
@endsection('head')

@section('body')

<h1>{{{ $settings['brand'] }}}</h1>

<h1>{{{ $settings['tag'] }}}</h1>

<h1>{{{ $settings['mobile'] }}}</h1>

@endsection('body')