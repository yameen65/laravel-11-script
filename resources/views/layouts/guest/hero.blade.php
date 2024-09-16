<div class="main-page">
    <div class="background-image">
        <img src="{{ asset('assets/images/main-page-image/Vector (1).png') }}" class="img-fluid" />
    </div>
    <!-- Navbar -->
    <div class="main-section container py-5">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12 col-12 z-3">
                <div class="paragraph">
                    <p class="fs-1">
                        {{ __('main-page.welcome_message', ['app_name' => config('app.name')]) }}
                    </p>
                </div>
                <div class="heading">
                    <h1 class="text-black">
                        {{ __('main-page.elevate_heading', ['app_name' => config('app.name')]) }}
                    </h1>
                </div>
                <div class="discription-para">
                    <p>
                        {{ __('main-page.description') }}
                    </p>
                </div>
                <div class="home-buttons g-4 mt-3 mt-lg-0 d-flex align-items-center py-5">
                    <a href="#" class="get-started-home btn mx-2 fs-5">{{ __('main-page.get_started') }}</a>
                    <a href="#" class="learn-more-home btn fs-5">{{ __('main-page.learn_more') }} <i
                            class="bi bi-arrow-right-short"></i></a>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                <div class="main-image">
                    <img src="{{ asset('assets/images/main-page-image/image 76.png') }}" class="w-100 img-fluid"
                        alt="" />
                </div>
            </div>
        </div>
    </div>
</div>