@extends('layouts.site')

@section('content')
    <!--Page Title-->
    <section class="page-title centred" style="background-image: url(assets/images/background/page-title-3.jpg);">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>{!! $data->title !!}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>{!! $data->title !!}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- about-section -->
    <section class="about-section about-page pb-0">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row align-items-center clearfix">

                    <div class="col-12 content-column">
                        <div class="content_block_3">
                            <div class="content-box">
                                <div class="sec-title">
                                    <h5>{!! $data->title !!}</h5>
                                </div>
                                <div class="text">
                                    {!! $data->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->
@endsection
