{{-- <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Car</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add new Car</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Customer</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark "/>
                <table class="table" id="tableData">
                    <thead>
                    <tr class="bg-light">
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div> --}}

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Car</h1>
    <p class="mb-4">Tables is a showing Listings of all added cars in system. Admin can Add, edit, and delete car
        details if necessary.
        Tables is a showing Listings of all added cars in system. Admin can Add, edit, and delete car details if
        necessary.
    </p>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Car</h6>
        </div> --}}
        <div class="card-header py-3">
            <button data-toggle="modal" data-target="#create-modal" class="btn btn-primary">Add New Car</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Type</th>
                            <th>Rent</th>
                            <th>Availability</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


</div>

<script>
    getList();


    async function getList() {


        showLoader();
        let res = await axios.get("/admin/list-car");
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();



        res.data.forEach(function(item, index) {
            let row = `<tr>
                    <td>${item['id']}</td>
                    <td width="100" height="100">
                        <img class="w-100 h-auto" alt="" src="{{ asset('/') }}${item['image']}">
                    </td>
                    <td>${item['name']}</td>
                    <td>${item['brand']}</td>
                    <td>${item['model']}</td>
                    <td>${item['year']}</td>
                    <td>${item['car_type']}</td>
                    <td>${item['daily_rent_price']}</td>
                    {{-- <td>${item['availability']}</td> --}}

                    <td>
                        ${item['availability'] === 1 ? `
                            <p class=" badge badge-success text-xs font-weight-bold text-uppercase mb-2 mt-3">Active</p>
                            <button data-id="${item['id']}" data-availability="${item['availability']}" class="btn availabiltyBtn btn-sm btn-outline-danger">Make Inactive</button>

                        ` : `
                            <p class=" badge badge-danger text-xs font-weight-bold text-uppercase mb-2 mt-3">Inactive</p>
                            <button data-id="${item['id']}" data-availability="${item['availability']}" class="btn availabiltyBtn btn-sm btn-outline-success">Make Active</button>
                        `}                        
                    </td>
                    <td>
                        <button data-path="${item['image']}" data-id="${item['id']}" class="mb-2 mt-3 btn editBtn btn-sm btn-outline-warning ">Edit</button>
                        
                        <button data-path="${item['image']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                 </tr>`
            tableList.append(row)
        })

        $('.availabiltyBtn').on('click', async function() {
            let id = $(this).data('id');
            let availability = $(this).data('availability');
            changeAvailability(id, availability);
        });

        $('.editBtn').on('click', async function() {
            let id = $(this).data('id');
            let filePath = $(this).data('path');
            await FillUpUpdateForm(id, filePath)
            $("#update-modal").modal('show');
        })

        $('.deleteBtn').on('click', function() {
            let id = $(this).data('id');
            let filePath = $(this).data('path');

            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
        })

        new DataTable('#tableData', {
            order: [
                [0, 'desc']
            ],
            lengthMenu: [5, 10, 15, 20, 30]
        });

    }


    async function changeAvailability($id, $availability) {
        let id = $id;
        let availability = $availability;
        showLoader();
        let res = await axios.post("/admin/update-car-availability", {
            id: id,
            availability: availability
        })
        hideLoader();
        if (res.data === 1) {
            successToast("Request completed")
            await getList();
        } else {
            errorToast("Request fail!")
        }
    }
</script>
