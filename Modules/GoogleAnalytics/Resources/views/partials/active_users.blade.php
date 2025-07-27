<div class="card active-user">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>{{ __('Active Users') }}</h5>
    </div>
    <div class="card-block text-center h-360">
        <div class="placeholder wave h-300px">
            <div class="square"></div>
        </div>
        <span class="d-none active-card">
            <h5 class="card-title mt-3 f-24">{{ __('In Last :x Minutes', ['x' => 30]) }}</h5>
            <i class="fas fa-user-friends mt-3 f-60 text-c-green"></i>
            <h2 class="f-w-300 mt-3" id="active_user"></h2>
            <span class="card-title f-16">{{ __('Active Users On Site') }}</span>
            <div class="progress mt-4 m-b-40">
                <div class="progress-bar progress-c-theme w-100" role="progressbar" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="row card-active active-user-device">
                @include('googleanalytics::partials.card_footer')
            </div>
        </span>
    </div>
</div>
