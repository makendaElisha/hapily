@extends('layouts.app')

@section('content')
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item w-100 mB-40">
            <div class="row gap-20">
                <div class="col-md-3">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Total Surveys</h6></div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash"></span></div>
                                <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">{{$totalSurveys}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Male Participants</h6></div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash2"></span></div>
                                <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">{{$maleSexSurveys}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Female Participants</h6></div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash3"></span></div>
                                <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">{{$femaleSexSurveys}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Other Participants</h6></div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash4"></span></div>
                                <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">{{$otherSexSurveys}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="masonry-item w-100">
            <div class="row gap-20">
                <div class="col-md-6">
                    <h6 class="lh-1 mB-20">Participants per age group</h6>
                    <div style="width: 100%; margin: 0 auto;">
                        {!! $usersPieChart->container() !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="lh-1 mB-20">Average percentage per area of life</h6>
                    <div class="layers">
                        @foreach ($areasOfLife as $key => $area)
                            <div class="layer w-100">
                                <h5 class="mB-5">{{$area->averageAreaScore}}</h5><small class="fw-600 c-grey-700">{{$area->name}}</small> <span class="pull-right c-grey-600 fsz-sm">{{$area->averageAreaScore * 10}}%</span>
                                <div class="progress mT-10">
                                    <div class="progress-bar bgc-deep-blue-500" role="progressbar" aria-valuenow="{{$area->averageAreaScore * 10}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$area->averageAreaScore * 10}}%"><span class="sr-only">{{$area->averageAreaScore * 10}}% Complete</span></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="peers pT-20 mT-20 bdT fxw-nw@lg+ jc-sb ta-c gap-10">
                        <div class="peer">
                            <div class="easy-pie-chart" data-size="80" data-percent="" data-bar-color="#f44336"><span></span></div>
                            <h6 class="fsz-sm">Today's Surveys: {{$todaySurvey}}</h6></div>
                        <div class="peer">
                            <div class="easy-pie-chart" data-size="80" data-percent="" data-bar-color="#2196f3"><span></span></div>
                            <h6 class="fsz-sm">Total Subscriptions {{$totalSubscriptions}}</h6></div>
                        <div class="peer">
                            <div class="easy-pie-chart" data-size="80" data-percent="" data-bar-color="#ff9800"><span></span></div>
                            <h6 class="fsz-sm">Total Leads {{$totalLeads}}</h6></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{!! $usersPieChart->script() !!}

@endsection
