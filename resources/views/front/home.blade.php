@extends('layouts.front_app')
@section('content')
    <section class="p-top-banner">
        @if ($homePageContent->banner != '')
            <img src="{{ asset('uploads/home_page/' . $homePageContent->banner) }}">
        @else
            <img src="{{ asset('assets/front/images/banner.png') }}">
        @endif
    </section>
    <section class="p-top-banner-mobile">
        <img src="{{ asset('assets/front/images/blue-gif.png') }}">
    </section>


    <section class="p-padding-40-0 p-banner-content text-center">
        <div class="container">
            @if ($homePageContent->section_one_banner_desc_one != '')
                <p>{{ $homePageContent->section_one_banner_desc_one }}</p>
            @endif
            @if ($homePageContent->section_one_banner_desc_two != '')
                <p>{{ $homePageContent->section_one_banner_desc_two }}</p>
            @endif
        </div>
    </section>


    <section class="p-left-right-se">
        <div class="container-fluid p-md-0 ">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="p-left-right-title-content p-padding-l-50">
                        @if ($homePageContent->section_two_title != '')
                            <h3>{{ $homePageContent->section_two_title }}</h3>
                        @endif
                        @if ($homePageContent->section_two_banner_desc_one != '')
                            <p>{{ $homePageContent->section_two_banner_desc_one }}</p>
                        @endif
                        @if ($homePageContent->section_two_banner_desc_two != '')
                            <p>{{ $homePageContent->section_two_banner_desc_two }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    @if ($homePageContent->section_two_banner != '')
                        <img src="{{ asset('uploads/home_page/' . $homePageContent->section_two_banner) }}">
                    @else
                        <img src="{{ asset('assets/front/images/city.png') }}">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="p-left-right-se">
        <div class="container-fluid p-md-0">
            <div class="row align-items-center p-tablet-r">
                <div class="col-md-5 text-start">
                    @if ($homePageContent->section_three_banner != '')
                        <img src="{{ asset('uploads/home_page/' . $homePageContent->section_three_banner) }}">
                    @else
                        <img src="{{ asset('assets/front/images/festive.png') }}">
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="p-left-right-title-content p-padding-r-50">
                        @if ($homePageContent->section_three_title != '')
                            <h3>{{ $homePageContent->section_three_title }}</h3>
                        @endif
                        @if ($homePageContent->section_three_desc_one != '')
                            <p>{{ $homePageContent->section_three_desc_one }}</p>
                        @endif
                        @if ($homePageContent->section_three_desc_two != '')
                            <p>{{ $homePageContent->section_three_desc_two }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="p-left-right-se">
        <div class="container-fluid p-md-0">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="p-left-right-title-content p-padding-l-50">
                        @if ($homePageContent->section_four_title != '')
                            <h3>{{ $homePageContent->section_four_title }}</h3>
                        @endif
                        @if ($homePageContent->section_four_desc_one != '')
                            <p>{{ $homePageContent->section_four_desc_one }}</p>
                        @endif
                        @if ($homePageContent->section_four_desc_two != '')
                            <p>{{ $homePageContent->section_four_desc_two }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    @if ($homePageContent->section_four_banner != '')
                        <img src="{{ asset('uploads/home_page/' . $homePageContent->section_four_banner) }}">
                    @else
                        <img src="{{ asset('assets/front/images/nature.png') }}">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="p-foi-se">
        <div class="container-fluid pe-0">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="p-padding-l-50">
                        @if ($homePageContent->section_five_contest_title != '')
                            <h3 class="p-purple">{{ $homePageContent->section_five_contest_title }}</h3>
                        @endif
                        @if ($homePageContent->section_five_contest_sub_title != '')
                            <h4 class="p-white">{{ $homePageContent->section_five_contest_sub_title }}</h4>
                        @endif
                        @if ($homePageContent->section_five_contest_desc != '')
                            <h6 class="p-yellow">{{ $homePageContent->section_five_contest_desc }}</h6>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                            @if ($homePageContent->section_five_contest_winning_text != '')
                                <p class="p-white">{!! $homePageContent->section_five_contest_winning_text !!}</p>
                            @endif
                            <img src="{{ asset('assets/front/images/no-fees.png') }}">
                        </div>
                        @if ($homePageContent->section_five_contest_end_text != '')
                            <p class="mb-0 p-white">{{ $homePageContent->section_five_contest_end_text }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    @if ($homePageContent->section_five_contest_image != '')
                        <img src="{{ asset('uploads/home_page/' . $homePageContent->section_five_contest_image) }}">
                    @else
                        <img src="{{ asset('assets/front/images/festivals.png') }}">
                    @endif
                </div>
            </div>
        </div>
    </section>
    @if ($galleryData->isNotEmpty())
        <section class="p-banner-photo-se">
            <div class="container-fluid p-0">
                <div class="slide-option">
                    <div id="infinite" class="highway-slider">
                        <div class="highway-barrier">
                            <ul class="highway-lane">
                                @foreach ($galleryData as $key => $gallery)
                                    @if ($key < 24)
                                        <li class="highway-car"><img src="{{ asset('uploads/home_page_slider/'.$gallery->image) }}"></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div id="infinite" class="highway-slider">
                        <div class=" highway-barrier">
                            <ul class="highway-lane">
                                @foreach ($galleryData as $key => $gallery)
                                    @if ($key > 23)
                                        <li class="highway-car"><img src="{{ asset('uploads/home_page_slider/'.$gallery->image) }}"></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="p-pwi-se">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="p-padding-l-50">
                        <div class="p-left-se">
                            <h3>the <b class="p-00c7e9"> #photowalksindia</b> community</h3>
                            <p class="mb-0 p-blue">photowalks</p>
                            <p class="mb-0 p-red">workshops</p>
                            <p class="mb-0 p-coffee">meetups</p>
                            <p class="mb-0 p-yellow">contests</p>
                            <p class="mb-0 p-00c7e9">exhibitions</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @if ($homePageContent->section_six_community_desc_one != '')
                        <p>{{ $homePageContent->section_six_community_desc_one }}</p>
                    @endif
                </div>
                <div class="col-md-4">
                    @if ($homePageContent->section_six_community_desc_two != '')
                        <p>{{ $homePageContent->section_six_community_desc_two }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if ($upcomming_schedule->isNotEmpty())
        <section class="p-blog-se">
            <div class="container-fluid">
                <div class="p-comman-title-se d-flex align-items-center justify-content-between">
                    <h3>Upcoming </h3>
                    <span>Check our<a href="{{ route('front.schedule') }}" class="p-pink"> Calendar</a></span>
                </div>

                <div class="p-blog-post-se">
                    <div class="owl-carousel blog-slider">
                        @foreach ($upcomming_schedule as $schedule)
                            <div class="itam">
                                <div class="p-blog-box">
                                    @if ($schedule->banner != '')
                                        <img src="{{ asset('uploads/schedule/' . $schedule->banner) }}">
                                    @else
                                        <img src="{{ asset('assets/front/images/schedule.png') }}">
                                    @endif
                                    <div class="p-blog-post-meta">{{ date('d', strtotime($schedule->date_time)) }}<br>{{ date('M', strtotime($schedule->date_time)) }}</div>
                                    <h5 class="p-white">{{ $schedule->title }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif


    <section class="p-gif-home-se">
        <div class="container-fluid">
            @if ($homePageContent->section_seven_banner != '')
                <img src="{{ asset('uploads/home_page/' . $homePageContent->section_seven_banner) }}">
            @else
                <img src="{{ asset('assets/front/images/gif.png') }}">
            @endif
        </div>
    </section>

    <section class="p-instagram-se">
        <div class="container-fluid p-0">
            @if ($homePageContent->section_eight_banner != '')
                <img src="{{ asset('uploads/home_page/' . $homePageContent->section_eight_banner) }}">
            @else
                <img src="{{ asset('assets/front/images/instagram-se.png') }}">
            @endif
        </div>
    </section>
@endsection
