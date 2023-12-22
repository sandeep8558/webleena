@layout('layouts/app')

@section('head')
<title>Demo Page</title>
@endsection('head')

@section('body')

<div class="container flex flex-row flex-wrap gap-10 bg-danger p-20">
    <div class="bg-info border border-2 p-20">1</div>
    <div class="bg-info border border-2 p-20">2</div>
    <div class="bg-info border border-2 p-20">3</div>
    <div class="bg-info border border-2 p-20">4</div>
    <div class="bg-info border border-2 p-20">5</div>
    <div class="bg-info border border-2 p-20">6</div>
</div>

<div class="container-full m-10 shadow-10 p-20 rounded-10 text-center">

    <div class="w-100">

        <div class="image image-cover image-header mb-20 rounded-10 shadow-25">
            <img src="/images/nature.jpg" alt="Nature">
        </div>

    </div>

    <h1 class="text-primary text-danger-lg">Sandeep Rathod</h1>
    <p class="font-size-20 uppercase">this is too required</p>
    <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam ad maiores accusamus aperiam placeat. Quae similique facere veritatis quasi corrupti doloremque! Non animi in quos inventore accusamus vero unde doloribus.</p>

</div>

@endsection('body')