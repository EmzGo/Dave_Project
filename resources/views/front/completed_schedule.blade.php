@extends('layouts.front_app')
@section('content')
<section class="p-blog-se">
    <div class="container-fluid">
        <div class="p-comman-title-se d-flex align-items-center justify-content-between">
            <h3>Schedule </h3>
        </div>

        <div class="schedule-tab">
            <ul>
                <li><a href="{{ route('front.schedule') }}">Upcoming</a></li>
                <li><a class="active" href="{{ route('front.completed_schedule') }}">Completed</a></li>
            </ul>
        </div>

        <div class="city-tab">
            <ul>
                <li><a class="{{ $active_city != '' ? '' : 'active' }}" href="{{ route('front.completed_schedule') }}">All Cities</a></li>
                @if ($cities->isNotEmpty())
                    @foreach ($cities as $city)
                        <li><a class="{{ $active_city == $city->name ? 'active' : '' }}" href="{{ route('front.completed_schedule', $city->name) }}">{{ $city->name }}</a></li>
                    @endforeach
                @endif
            </ul>
        </div>

        <div class="p-blog-post-se">
            <div class="row">
                @forelse ($completed_schedule as $key => $schedule)
                <div class="col-md-4 col-sm-6">
                    <div class="p-blog-box">
                        @if ($schedule->banner != '')
                            <img src="{{ asset('uploads/schedule/' . $schedule->banner) }}">
                        @else
                            <img src="{{ asset('assets/front/images/schedule.png') }}">
                        @endif
                        <div class="p-blog-post-meta">{{ date('d', strtotime($schedule->date_time)) }}<br>{{ date('M', strtotime($schedule->date_time)) }}</div>
                    </div>
                    <div class="p-blog-box-title">
                        <h3>{{ $schedule->title }}</h3>
                        <span>Gallery</span>
                    </div>
                </div>
                @empty
                    <div class="col-md-12 col-sm-12">
                        <div class="p-blog-box-title text-center">
                            <h3>No data found.</h3>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
