<div class="hero-wrap ftco-degree-bg" style="background-image: url('{{ asset('frontend/images/bg_1.jpg') }}');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
            <div class="col-lg-8 ftco-animate">
                <div class="text w-100 text-center mb-md-5 pb-md-5">
                    <h1 class="mb-4">Fast &amp; Easy Way To Rent A Car</h1>
                    <p style="font-size: 18px;">A small river named Duden flows by their place and supplies it with the
                        necessary regelialia. It is a paradisematic country, in which roasted parts</p>
                    <a href=""
                        class="icon-wrap popup-vimeo d-flex align-items-center mt-4 justify-content-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="ion-ios-play"></span>
                        </div>
                        <div class="heading-title ml-5">
                            <span>Easy steps for renting a car</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-12	featured-top">
                <div class="row no-gutters">
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="request-form ftco-animate bg-primary">
                            <h2>Rent your Car</h2>
                            @php
                                use Carbon\Carbon;
                            @endphp
                            <div class="d-flex">
                                <div class="form-group mr-2">
                                    <label for="" class="label">Pick-up date</label>
                                    <input type="date" class="form-control"
                                        min="{{ Carbon::today()->toDateString() }}" max="2050-12-31" id="start_date"
                                        placeholder="Date">
                                </div>
                                <div class="form-group ml-2">
                                    <label for="" class="label">Drop-off date</label>
                                    <input type="date" class="form-control"
                                        min="{{ Carbon::today()->toDateString() }}" max="2050-12-31" id="end_date"
                                        placeholder="Date">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-secondary py-3 px-4" onclick="showCars()">Rent A Car Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="services-wrap rounded-right w-100">
                            <h3 class="heading-section mb-4">Better Way to Rent Your Perfect Cars</h3>
                            <div class="row d-flex mb-4">
                                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                    <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span
                                                class="flaticon-route"></span></div>
                                        <div class="text w-100">
                                            <h3 class="heading mb-2">Choose Your Dates</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                    <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span
                                                class="flaticon-handshake"></span></div>
                                        <div class="text w-100">
                                            <h3 class="heading mb-2">Select the Best Deal</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                    <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span
                                                class="flaticon-rent"></span></div>
                                        <div class="text w-100">
                                            <h3 class="heading mb-2">Reserve Your Rental Car</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<script>
    function showCars() {
        let startDate = document.getElementById('start_date').value;
        let endDate = document.getElementById('end_date').value;

        if (startDate.length === 0) {
            errorToast("Pick Up Date Required !")
        } else if (endDate.length === 0) {
            errorToast("Drop Off Date Required !")
        } else if (endDate < startDate) {
            errorToast("PickUp Date Must Less Than DropOff Date")
        } else {
            window.location.href = `/car?startDate=${startDate}&endDate=${endDate}`;
        }


    }
</script>
