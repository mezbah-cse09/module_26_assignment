<div id="contentRef" class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <div class="row">
                        <div class="col-8">
                            <span class=" text-sm text-bold text-dark">Rent TO </span>
                            <p class="text-xs mx-0 my-1">Name: <span id="CName"></span> </p>
                            <p class="text-xs mx-0 my-1">Email: <span id="CEmail"></span></p>
                            <p class="text-xs mx-0 my-1">User ID: <span id="CId"></span> </p>
                        </div>
                        <div class="col-4">
                            <img class="w-50" src="images/logo.png">
                            <p class="text-bolder mx-0 my-1 text-dark">Invoice</p>
                            <p class="text-xs mx-0 my-1">Date: {{ date('Y-m-d') }}</p>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-bold text-xs my-1 text-dark"> Start Date:
                                <span id="date_start"></span>
                            </p>
                            <p class="text-bold text-xs my-1 text-dark"> End Date:
                                <span id="date_end"></span>
                            </p>
                            <p class="text-bold text-xs my-1 text-dark"> Car Name:
                                <span id="name"></span>
                            </p>
                            <p class="text-bold text-xs my-1 text-dark"> Id:
                                <span id="carId"></span>
                            </p>

                            <p class="text-bold text-xs my-1 text-dark"> BRAND:
                                <span id="brand"></span>
                            </p>
                            <p class="text-bold text-xs my-1 text-dark"> MODEL:
                                <span id="model"></span>
                            </p>
                            <p class="text-bold text-xs my-1 text-dark"> YEAR:
                                <span id="year"></span>
                            </p>
                            <p class="text-bold text-xs my-1 text-dark"> CAR TYPE:
                                <span id="type"></span>
                            </p>
                            <p class="text-bold text-xs my-1 text-dark"> DAILY RENT:
                                <span id="daily_rent"></span>
                            </p>

                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary">
                    <div class="row">
                        <div class="col-12">
                            <p class="h5 my-1 text-dark"> TOTAL:
                                <span id="total"></span>
                            </p>
                            <p>
                                <button onclick="createRent()" class="btn  my-3 btn-info w-40">Confirm</button>
                            </p>
                        </div>
                        <div class="col-12 p-2">

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <div id="carTable_wrapper" class="dataTables_wrapper no-footer">
                        <div class="row">
                            <div class="col-8">
                                @php
                                    use Carbon\Carbon;
                                    $todayString = Carbon::today()->toDateString();
                                @endphp

                                <div id="carTable_filter" class="dataTables_filtera">
                                    <label>Start Date :<input type="date" min="{{ $todayString }}" max="2050-12-31"
                                            id="start_date" class="" placeholder="" aria-controls="carTable">
                                    </label>
                                    <label>Start Date :<input type="date" min="{{ $todayString }}" max="2050-12-31"
                                            id="end_date" class="" placeholder="" aria-controls="carTable">
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-success" onclick="SearchCar()">Search
                                    Car</button>
                            </div>
                        </div>
                        <table class="table w-100 no-footer dataTable" id="carTable" aria-describedby="carTable_info"
                            style="width: 505px;">
                            <thead class="w-100">
                                <tr class="text-sm text-bold">
                                    <td class="sorting sorting_desc" tabindex="0" aria-controls="carTable"
                                        rowspan="1" colspan="1"
                                        aria-label="Product: activate to sort column ascending" style="width: 256px;"
                                        aria-sort="descending">Car</td>
                                    <td class="sorting" tabindex="0" aria-controls="carTable" rowspan="1"
                                        colspan="1" aria-label="Pick: activate to sort column ascending"
                                        style="width: 177px;">Pick</td>
                                </tr>
                            </thead>
                            <tbody class="w-100" id="carList">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <div id="customerTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-sm w-100 no-footer dataTable" id="customerTable"
                            aria-describedby="customerTable_info" style="width: 505px;">
                            <thead class="w-100">
                                <tr class="text-sm text-bold">
                                    <td class="sorting sorting_desc" tabindex="0" aria-controls="customerTable"
                                        rowspan="1" colspan="1"
                                        aria-label="Customer: activate to sort column ascending" style="width: 274px;"
                                        aria-sort="descending">Customer</td>
                                    <td class="sorting" tabindex="0" aria-controls="customerTable" rowspan="1"
                                        colspan="1" aria-label="Pick: activate to sort column ascending"
                                        style="width: 159px;">Pick</td>
                                </tr>
                            </thead>
                            <tbody class="w-100" id="customerList">
                                <tr class="text-sm odd">
                                    <td class="sorting_1"><i class="bi bi-person"></i> IRS IT</td>
                                    <td><a data-name="IRS IT" data-email="sdsd@sd.com" data-id="1"
                                            class="btn btn-outline-dark addCustomer  text-xxs px-2 py-1  btn-sm m-0">Add</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (async () => {
        showLoader();
        await CustomerList();
        //   await ProductList();
        hideLoader();
    })()

    $start_date = '';
    $end_date = '';
    $carData = [];


    async function SearchCar() {
        let startDate = document.getElementById('start_date').value
        let endDate = document.getElementById('end_date').value

        if (startDate && endDate) {
            if (startDate <= endDate) {
                //vali
                try {
                    showLoader();

                    let res = await axios.get(
                        `/admin/rental/list-available-car?startDate=${startDate}&endDate=${endDate}`)
                    hideLoader()

                    if (res.status === 200 && res.msg == 'fail') {
                        errorToast('Something wrong no data found!')
                    } else {
                        $start_date = startDate
                        $end_date = endDate
                        let carList = $("#carList")
                        let carTable = $("#carTable")
                        carTable.DataTable().destroy()
                        carList.empty()

                        $carData = res.data.data
                        res.data.data.forEach(function(item, index) {
                            let info = JSON.stringify(item);
                            let row = `<tr class="text-sm">
                        <td> <img class="w-10" src="{{ asset('/') }}${item['image']}"/> ${item['name']} ($ ${item['daily_rent_price']})</td>
                        <td><a data-index='${index}' data-name="${item['name']}" data-rent="${item['daily_rent_price']}" data-id="${item['id']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProduct  btn-sm m-0">Select</a></td>
                        </tr>`
                            carList.append(row)
                        })


                        $('.addProduct').on('click', async function() {
                            let PName = $(this).data('name');
                            let PPrice = $(this).data('price');
                            let PId = $(this).data('id');
                            let index = $(this).data('index')

                            console.log($carData[index]['name'])

                            $("#date_start").text($start_date)
                            $("#date_end").text($end_date)
                            let carObject = $carData[index]
                            $("#name").text(carObject.name)
                            $("#carId").text(carObject.id)
                            $("#brand").text(carObject.brand)
                            $("#model").text(carObject.model)
                            $("#year").text(carObject.year)
                            $("#type").text(carObject.car_type)
                            $("#daily_rent").text(carObject.daily_rent_price)

                            let startDate = new Date($start_date)
                            let endDate = new Date($end_date)

                            // Calculate the difference in milliseconds
                            let differenceInTime = endDate - startDate
                            let differenceInday = differenceInTime / 86400000 + 1

                            $("#total").text(carObject.daily_rent_price * differenceInday)

                            console.log(differenceInday)
                        })


                        new DataTable('#carTable', {
                            order: [
                                [0, 'desc']
                            ],
                            scrollCollapse: false,
                            info: false,
                            lengthChange: false
                        });

                        // res.data
                    }

                } catch (e) {

                    console.log(e);
                    errorToast('Something wrong! in catch')
                }
            } else {
                errorToast('Start Date must be less or Equal to End Date')
            }
        } else {
            errorToast('Start Date and End Date Required')
        }
    }

    async function CustomerList() {
        showLoader();
        let res = await axios.get("/admin/list-customer");
        hideLoader();

        let customerList = $("#customerList");
        let customerTable = $("#customerTable");
        customerTable.DataTable().destroy();
        customerList.empty();

        res.data.forEach(function(item, index) {
            let row = `<tr class="text-sm">
                    <td><i class="bi bi-person"></i> ${item['name']}</td>
                    <td><a data-name="${item['name']}" data-email="${item['email']}" data-id="${item['id']}" class="btn btn-outline-dark addCustomer  text-xxs px-2 py-1  btn-sm m-0">Select</a></td>
                    </tr>`
            customerList.append(row)
        })


        $('.addCustomer').on('click', async function() {

            let CName = $(this).data('name');
            let CEmail = $(this).data('email');
            let CId = $(this).data('id');

            $("#CName").text(CName)
            $("#CEmail").text(CEmail)
            $("#CId").text(CId)

        })

        new DataTable('#customerTable', {
            order: [
                [0, 'desc']
            ],
            scrollCollapse: false,
            info: false,
            lengthChange: false
        });
    }

    async function createRent() {
        let total = document.getElementById('total').innerText;
        let startDate = document.getElementById('date_start').innerText
        let endDate = document.getElementById('date_end').innerText
        let id = document.getElementById('CId').innerText
        let car_id = document.getElementById('carId').innerText


        let Data = {
            "total_cost": total,
            "start_date": startDate,
            "end_date": endDate,
            "user_id": id,
            "car_id": car_id
        }

        console.log(Data)


        if (id.length === 0) {
            errorToast("Customer Required !")
        } else if (total.length === 0) {
            errorToast("Car Select Required !")
        } else {
            try {
                showLoader();
                let res = await axios.post("/admin/rental/create-rental", Data)
                hideLoader();
                if (res.status === 201) {
                    successToast("Rent Created");
                    window.location.href = '/admin/rentalPage'
                } else {
                    errorToast("Something Went Wrong")
                }

            } catch (e) {
                errorToast(e.response.msg)
            }
        }

    }
</script>
