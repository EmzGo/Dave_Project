@extends('layouts.front_app')
@section('content')
    <section class="p-about-se" style="background: url({{ asset('uploads/aboutus_page/' . $about_us->banner) }});background-size: cover;background-position: center;">
        {{-- @if ($about_us->banner != '')
            <img class="w-100" src="{{ asset('uploads/aboutus_page/' . $about_us->banner) }}">
        @else
            <img class="w-100" src="{{ asset('assets/front/images/gif-text-box.png') }}">
        @endif --}}
    </section>

    <section class="p-community-se">
        <div class="container ">
            @if ($about_us->section_one_community_title != '')
                <h2 class="p-white text-center">{{ $about_us->section_one_community_title }}</h2>
            @else
                <h2 class="p-white text-center">Community</h2>
            @endif
            <div class="row">
                <div class="col-md-6">
                    @if ($about_us->section_one_community_desc_one != '')
                        <p>{{ $about_us->section_one_community_desc_one }}</p>
                    @endif
                </div>
                <div class="col-md-6">
                    @if ($about_us->section_one_community_desc_two != '')
                        <p>{{ $about_us->section_one_community_desc_two }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="p-gif-se">
        @if ($about_us->section_two_image != '')
            <img class="w-100" src="{{ asset('uploads/aboutus_page/' . $about_us->section_two_image) }}">
        @else
            <h3 class="p-00c7e9">GIF</h3>
        @endif
    </section>

    <section class="p-travel-se">
        <div class="container ">
            @if ($about_us->section_three_travel_title != '')
                <h2 class="p-pink text-center">{{ $about_us->section_three_travel_title }}</h2>
            @else
                <h2 class="p-pink text-center">travel</h2>
            @endif
            <div class="row">
                <div class="col-md-6">
                    @if ($about_us->section_three_travel_desc_one != '')
                        <p class="p-pink">{{ $about_us->section_three_travel_desc_one }}</p>
                    @endif
                </div>
                <div class="col-md-6">
                    @if ($about_us->section_three_travel_desc_two != '')
                        <p class="p-pink">{{ $about_us->section_three_travel_desc_two }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="p-gif-se-2">
        @if ($about_us->section_four_image != '')
            <img class="w-100" src="{{ asset('uploads/aboutus_page/' . $about_us->section_four_image) }}">
        @else
            <h3 class="p-00c7e9">GIF</h3>
        @endif
    </section>

    <section class="p-learn-se">
        <div class="container ">
            @if ($about_us->section_five_learn_title != '')
                <h2 class="p-00c7e9 text-center">{{ $about_us->section_five_learn_title }}</h2>
            @else
                <h2 class="p-00c7e9 text-center">learn</h2>
            @endif
            <div class="row">
                <div class="col-md-6">
                    @if ($about_us->section_five_learn_desc_one != '')
                        <p class="p-00c7e9">{{ $about_us->section_five_learn_desc_one }}</p>
                    @endif
                </div>
                <div class="col-md-6">
                    @if ($about_us->section_five_learn_desc_two != '')
                        <p class="p-00c7e9">{{ $about_us->section_five_learn_desc_two }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="p-gif-se-3">
        <h3 class="p-00c7e9">#photowalksindia</h3>
    </section>
@endsection
