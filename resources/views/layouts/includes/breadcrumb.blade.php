<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            @if(isset($page_title))
                <h4 class="mb-sm-0 font-size-18">{{(isset($page_title) ? $page_title :'')}}</h4>
            @endif
            <div class="page-title-right">
                @if(isset($breadcrumb) && !empty($breadcrumb))
                <ol class="breadcrumb m-0">
                    @foreach($breadcrumb as $crum)
                        @if(isset($crum['link']))
                            <li class="breadcrumb-item"><a href="{{ $crum['link'] }}">{{ $crum['title'] }}</a></li>
                        @else
                            <li class="breadcrumb-item active">{{ $crum['title'] }}</li>
                        @endif
                    @endforeach
                </ol>
                @endif
            </div>
        </div>
    </div>
</div>