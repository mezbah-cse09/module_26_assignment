<section class="ftco-section ftco-cart   ">
    <div class="container">
        <div class="row">
            @php
                use Carbon\Carbon;

                // Define your start and end dates
                $todayString = Carbon::today()->toDateString();
                $startDateParsed = Carbon::parse($startDate);
                $endDateParsed = Carbon::parse($endDate);

                // Calculate the difference in days
                $daysDifference = $startDateParsed->diffInDays($endDateParsed) + 1;

            @endphp
            <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
                <div class="car-list-filter">
                    <div class="d-flex">
                        <div class="form-group mr-2">
                            <label for="" class="label">Start Date</label>

                            <input type="date" min="{{ $todayString }}" max="2050-12-31" class="form-control"
                                id="startDate" placeholder="Start Date"
                                value="{{ isset($startDate) ? "$startDate" : '' }}" />

                        </div>
                        <div class="form-group ml-2">
                            <label for="" class="label">End Date</label>
                            <input type="date" min="{{ $todayString }}" max="2050-12-31" class="form-control"
                                id="endDate" placeholder="End Date" value="{{ isset($endDate) ? "$endDate" : '' }}" />
                        </div>

                        <div class="form-group ml-2">
                            <label for="" class="label">Brand</label>
                            <select type="text" class="form-control form-select" id="brand">
                                <option value="">Select Brand</option>
                                {{-- @if (isset($brand))
                                    <option value="{{ $brand }}" selected>
                                        {{ $brand }}
                                @endif --}}
                            </select>
                        </div>

                        <div class="form-group ml-2">
                            <label for="" class="label">Model</label>
                            <select type="text" class="form-control form-select" id="model">
                                <option value="">Select Model</option>
                                {{-- @if (isset($model))
                                    <option value="{{ $model }}" selected>
                                        {{ $model }}
                                @endif --}}
                            </select>
                        </div>

                        <div class="form-group ml-2">
                            <label for="" class="label">Car Type</label>
                            <select type="text" class="form-control form-select" id="type">
                                <option value="">Select Car Type</option>
                                {{-- @if (isset($type))
                                    <option value="{{ $type }}" selected>
                                        {{ $type }}
                                @endif --}}
                            </select>
                        </div>

                        <div class="form-group ml-2">
                            <label for="" class="label">Daily Rent</label>
                            <input type="text" class="form-control" id='daily_rent'
                                value="{{ isset($daily_rent) ? "$daily_rent" : '' }}" placeholder="Maximum Daily Rent">
                        </div>

                        {{-- <div class="form-group ml-2 ">
                            <label for="" class="label"></label>
                            <button class="btn searchBtn btn-sm btn-primary ">Search</button>
                            <a href="" class="btn btn-lg btn-info">Search</a>
                        </div> --}}


                        <button onclick="filter()" class="btn searchBtn btn-lg btn-info ml-2 my-4 mx-2">Search</button>


                        {{-- <p>{{ $error_msg }}</p> --}}

                    </div>

                </div>
            </div>

            {{-- @php
                use Carbon\Carbon;

                // Define your start and end dates
                $todayString = Carbon::today()->toDateString();
                $startDateParsed = Carbon::parse($startDate);
                $endDateParsed = Carbon::parse($endDate);

                // Calculate the difference in days
                $daysDifference = $startDateParsed->diffInDays($endDateParsed) + 1;

            @endphp --}}


            @if (!$error_msg)

                <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
                    <div class="car-list-filter">
                        <div class="table-responsive">
                            <table class="table table-hover table-auto" cellspacing=20px cellpadding=20px>
                                <thead>
                                    <tr class="bg-light">
                                        <th>
                                            Image
                                        </th>
                                        <th>
                                            Name
                                        </th>

                                        <th>
                                            Brand
                                        </th>
                                        <th>
                                            Model
                                        </th>
                                        <th>
                                            Car Type
                                        </th>
                                        <th>
                                            Daily Rent
                                        </th>
                                        <th>
                                            Total Rent
                                        </th>

                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($availableCars as $availableCar)
                                        <tr>
                                            <td width="100" height="100">
                                                <img class="w-100 h-auto"
                                                    src="{{ asset('/') }}{{ $availableCar['image'] }} ">
                                            </td>
                                            <td class="ml-10">
                                                <p margin-left="8px">{{ $availableCar->name }}</p>
                                            </td>
                                            <td>
                                                {{ $availableCar->brand }}
                                            </td>
                                            <td>
                                                {{ $availableCar->model }}
                                            </td>
                                            <td>
                                                {{ $availableCar->car_type }}
                                            </td>
                                            <td>
                                                {{ $availableCar->daily_rent_price }}
                                            </td>

                                            <td>
                                                {{ $daysDifference * $availableCar->daily_rent_price }}{{ ' BDT' }}

                                                {{-- {{ $availableCar->daily_rent_price * 2 }} --}}
                                            </td>

                                            <td>
                                                <button
                                                    onclick="createRental({{ $availableCar->id }}, {{ $daysDifference * $availableCar->daily_rent_price }})"
                                                    data-id="{{ $availableCar->id }}"
                                                    class="rentBtn btn btn-lg btn-primary">
                                                    Rent
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="">
                                {{-- {{ $availableCars->links() }} --}}

                                {{-- @if ($availableCar->links())
                                {{ $availableCar->links() }}
                            @endif --}}

                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
                    <div class="car-list-filter">
                        <div class="flex justify-center mt-10 space-x-2">
                            {{ $availableCars->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
                    <div class="car-list-filter">
                        <div class="d-felx justify-content-center">
                            <p class="text-danger">{{ $error_msg }}</p>
                        </div>
                    </div>
                </div>

            @endif









        </div>
    </div>
</section>

<script>
    function filter() {
        // alert("{{ $startDate }}");
        // alert(document.getElementById('startDate').value);

        // if ("{{ $error_msg }}") {
        //     alert("ase")
        // } else {
        //     alert("nai")
        // }

        let startDate = document.getElementById('startDate').value
        let endDate = document.getElementById('endDate').value
        let brand = document.getElementById('brand').value
        let model = document.getElementById('model').value
        let type = document.getElementById('type').value
        let daily_rent = document.getElementById('daily_rent').value
        // alert(`${startDate}--${endDate}`);

        if (startDate && endDate) {
            if (startDate <= endDate) {
                url = `/car?startDate=${startDate}&endDate=${endDate}`
                if (brand) {
                    url = `${url}&brand=${brand}`
                }
                if (model) {
                    url = `${url}&model=${model}`
                }
                if (type) {
                    url = `${url}&type=${type}`
                }
                if (daily_rent) {
                    url = `${url}&daily_rent=${daily_rent}`
                }
                window.location.href = url;
            } else {
                errorToast("End Date must be grater or Equal to Start Date")
            }
        } else {
            errorToast("Start Date and End Date Required")
        }

    }


    async function createRental(id, total_cost) {

        try {
            showLoader();
            let res = await axios.post("create-rental", {
                car_id: id,
                start_date: "{{ $startDate }}",
                end_date: "{{ $endDate }}",
                total_cost: total_cost
            })
            hideLoader()

            if (res.status === 200 && res.data === 'wrong Entry !') {
                errorToast("Something is wrong!")
            } else {
                successToast("Request completed")
                window.location.href = "/my-booking"
            }


        } catch (e) {
            hideLoader()
            if (e.response.status === 401) {
                sessionStorage.setItem('last_location', window.location.href)
                window.location.href = "/login"
            }
        }
    }



    getCarFilterData();

    async function getCarFilterData() {
        showLoader();
        let res = await axios.get("/carFilterData")
        hideLoader();

        res.data['brand'].forEach(function(item, index) {
            let option = `<option value="${item.toLowerCase()}">${item}</option>`
            $("#brand").append(option);
        })

        res.data['model'].forEach(function(item, index) {
            let option = `<option value="${item.toLowerCase()}">${item}</option>`
            $("#model").append(option);
        })

        res.data['car_type'].forEach(function(item, index) {
            let option = `<option value="${item.toLowerCase()}">${item}</option>`
            $("#type").append(option);
        })

        let brand = "{{ $brand }}".toLowerCase();
        if (brand) {
            document.getElementById('brand').value = brand;
        }

        let model = "{{ $model }}".toLowerCase();
        if (model) {
            document.getElementById('model').value = model;
        }

        let type = "{{ $type }}".toLowerCase();
        if (type) {
            document.getElementById('type').value = type;
        }


        // alert("{{ $error_msg }}");



    }
</script>
