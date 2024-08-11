<script src="{{ asset('js/app.js') }}" defer></script>

<div class="main-content" id="app">
    <!--     <appc></appc> -->
    <div class="container-fluid">
        <div class="row clearfix">

            {{-- Total Records in TopNews --}}
            @if (auth()->check())
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Total Records in TopNews</h6>
                                    <h2>{{ App\Models\TopNews::count() }}</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-file-text"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62" aria-valuemin="0"
                                aria-valuemax="100" style="width: 62%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- TopNews for Today --}}
            @if (auth()->check())
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>TopNews for Today</h6>
                                    <h2>{{ App\Models\TopNews::whereDate('created_at', now()->toDateString())->count() }}
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-calendar"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0"
                                aria-valuemax="100" style="width: 78%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Total date_times --}}
            @if (auth()->check())
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Total date_times</h6>
                                    <h2>{{ App\Models\DateTime::count() }}</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-clock"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31" aria-valuemin="0"
                                aria-valuemax="100" style="width: 31%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Total API Calls --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Total API Calls</h6>
                                    <h2>{{ App\Models\ApiLog::count() }}</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-server"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Total Unique Token Calls --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Total Unique Tokens</h6>
                                    <h2>{{ App\Models\ApiLog::where('token', 'NOT LIKE', '%server')->distinct('token')->count('token') }}
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-shield"></i> <!-- First icon -->
                                    <i class="ik ik-lock"></i> <!-- Second icon -->
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Today's Total Unique Token Calls --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Today's Unique Token Calls</h6>
                                    <h2>{{ App\Models\ApiLog::whereDate('created_at', Carbon\Carbon::today())->where('token', 'NOT LIKE', '%server')->distinct()->count('token') }}
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-shield"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- This Month Unique Token Calls --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>This Month Unique Tokens</h6>
                                    <h2>{{ App\Models\ApiLog::where('token', 'NOT LIKE', '%server')->whereMonth('created_at', Carbon\Carbon::now()->month)->distinct()->count('token') }}
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-calendar"></i> <!-- Updated icon to represent the month -->
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Successful API Calls: 200 --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Successful API Calls: 200</h6>
                                    <h2>{{ App\Models\ApiLog::where('response_code', 200)->count() }}</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-check-circle"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Redirected API Calls: 302 --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Redirected API Calls: 302</h6>
                                    <h2>{{ App\Models\ApiLog::where('response_code', 302)->count() }}</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-refresh-cw"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Total API Calls Today --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Total API Calls Today</h6>
                                    <h2>{{ App\Models\ApiLog::whereDate('created_at', today())->count() }}</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-calendar"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Total API Calls This Month --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Total API Calls This Month</h6>
                                    <h2>{{ App\Models\ApiLog::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count() }}
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-calendar"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Failed API Calls: 400+ --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Failed API Calls: 400+</h6>
                                    <h2>{{ App\Models\ApiLog::where('response_code', '>=', 400)->count() }}</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-alert-circle"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Most Common Error Code --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Most Common Error Code</h6>
                                    <h2>{{ App\Models\ApiLog::select('response_code')->where('response_code', '>=', 400)->groupBy('response_code')->orderByRaw('COUNT(*) DESC')->first()->response_code ?? 'N/A' }}
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-x-circle"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Average Response Time (s) --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Average Response Time (s)</h6>
                                    <h2>
                                        {{ number_format(App\Models\ApiLog::avg('execution_time'), 3) }}
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-clock"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Slowest API Call (s) --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Slowest API Call (s)</h6>
                                    <h2>
                                        {{ optional(App\Models\ApiLog::orderBy('execution_time', 'desc')->first())->execution_time !== null
                                            ? number_format(optional(App\Models\ApiLog::orderBy('execution_time', 'desc')->first())->execution_time, 3)
                                            : 'N/A' }}
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-slow-motion"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Fastest API Call (s) --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Fastest API Call (s)</h6>
                                    <h2>
                                        {{ optional($log = App\Models\ApiLog::orderBy('execution_time', 'asc')->first())->execution_time !== null
                                            ? number_format($log->execution_time, 3)
                                            : 'N/A' }}
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-fast-forward"></i>
                                </div>
                            </div>
                            <small class="text-small mt-10 d-block"></small>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
</div>
