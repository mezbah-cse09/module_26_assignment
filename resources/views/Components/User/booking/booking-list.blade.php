{{-- <section class="ftco-section ftco-cart   ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
                <div class="car-list-filter">
                    <div class="table-responsive">
                        <table class="table table-hover table-auto" cellspacing=20px cellpadding=20px>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}


<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">My Bookings</h1>
    <p class="mb-4">Tables is a showing Listings of all bookings in system. User can Change the booking
        if is not started, canceled, rejected.
        Tables is a showing Listings of all bookings in system. User can Change the booking
        if is not started, canceled, rejected.
    </p>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Image</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Daily Rent</th>
                            <th>Car</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    getlist()

    async function getlist() {

        showLoader();
        let res = await axios.get('/list-rental')
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {

            let row =
                `<tr>
                    <td>${item['id']}</td>
                    <td width="100" height="100">
                        <img class="w-100 h-auto" alt="" src="{{ asset('/') }}${item['car']['image']}">
                    </td>
                    <td>${item['start_date']}</td>
                    <td>${item['end_date']}</td>
                    <td>${item['car']['daily_rent_price']}</td>
                    <td>${item['car']['name']}</td>
                    <td>${item['car']['brand']}</td>
                    <td>${item['car']['model']}</td>
                    <td>${item['total_cost']}</td>
                {{--    <td>${item['status']}</td> --}}

                    <td>
                        ${item['status'] === 'Processing' ? `
                            <p class=" badge badge-info text-xs font-weight-bold text-uppercase mb-2 mt-3">${item['status']}</p>
                            <button data-id="${item['id']}" class="btn changeStatusBtn btn-sm btn-outline-danger">Cancel</button>

                        ` : item['status'] === 'Started' ? `
                            <p class=" badge badge-primary text-xs font-weight-bold text-uppercase mb-2 mt-3">${item['status']}</p>
                        ` : item['status'] === 'Completed' ? `
                            <p class=" badge badge-success text-xs font-weight-bold text-uppercase mb-2 mt-3">${item['status']}</p>
                        ` : item['status'] === 'Canceled' ? ` 
                            <p class=" badge badge-warning text-xs font-weight-bold text-uppercase mb-2 mt-3">${item['status']}</p>
                        ` : `
                            <p class=" badge badge-danger text-xs font-weight-bold text-uppercase mb-2 mt-3">${item['status']}</p>
                        `}
                 </td> 

             </tr>`
            tableList.append(row)
        })
        $('.changeStatusBtn').on('click', async function() {
            let id = $(this).data('id');

            changeStatus(id);
        })

        new DataTable('#tableData', {
            order: [
                [0, 'desc']
            ],
            lengthMenu: [5, 10, 15, 20, 30]
        });

    }

    async function changeStatus($id) {
        let id = $id;
        showLoader();
        let res = await axios.post("/update-rental", {
            id: id
        })
        hideLoader();
        if (res.data === 1) {
            // successToast("Request completed")

            getlist()
        } else {
            errorToast("Request fail!")
        }
    }
</script>
