@extends('layouts.front_app')
@section('content')
<section class="p-blog-se">
    <div class="container-fluid">
        <div class="p-comman-title-se d-flex align-items-center justify-content-between">
            <h3>Schedule </h3>
            <!-- <span>Check our<a href="#" class="p-pink"> Calendar</a></span> -->
        </div>

        <div class="schedule-tab">
            <ul>
                <li><a class="active" href="{{ route('front.schedule') }}">Upcoming</a></li>
                <li><a href="{{ route('front.completed_schedule') }}">Completed</a></li>
            </ul>
        </div>

        <div class="city-tab">
            <ul>
                <li><a class="{{ $active_city != '' ? '' : 'active' }}" href="{{ route('front.schedule') }}">All Cities</a></li>
                @if ($cities->isNotEmpty())
                    @foreach ($cities as $city)
                        <li><a class="{{ $active_city == $city->name ? 'active' : '' }}" href="{{ route('front.schedule', $city->name) }}">{{ $city->name }}</a></li>
                    @endforeach
                @endif
            </ul>
        </div>

         <div class="p-blog-list-se">
            @forelse ($upcomming_schedule as $key => $schedule)
            <div class="p-blog-list">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <div class="p-post-date">
                            <h5>{{ date('d', strtotime($schedule->date_time)) }}<sup>{{ date('S', strtotime($schedule->date_time)) }}</sup><span>{{ date('F', strtotime($schedule->date_time)) }}</span></h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="post-img">
                            @if ($schedule->banner != '')
                                <img src="{{ asset('uploads/schedule/' . $schedule->banner) }}">
                            @else
                                <img src="{{ asset('assets/front/images/schedule.png') }}">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-part">
                            <div class="post-title">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a class="title-link-class" href="{{ route('front.schedule.details', $schedule->slug) }}"><h3>{{ $schedule->title }}</h3></a>
                                    <span>{{ date('g.i A', strtotime($schedule->date_time)) }} - {{ date('l', strtotime($schedule->date_time)) }}</span>
                                </div>
                            </div>
                            <ul>
                                <li>Photowalk</li>
                                <li>{{ $schedule->city->name }}</li>
                            </ul>
                            <p>{{ $schedule->desc }}</p>
                            <a href="{{ route('front.schedule.details', $schedule->slug) }}">Register</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-blog-list">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="right-part">
                            <div class="post-title">
                                <div class="d-flex justify-content-between align-items-center text-center">
                                    <h3>No data found.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
         </div>
    </div>
</section>
@endsection
