<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Rental</h1>
    <p class="mb-4">Tables is a showing Listings of all Rents in system. Admin can Add, edit, and delete
        Rent details if necessary.
        Tables is a showing Listings of all Rents Customers in system. Admin can Add, edit, and delete Customer details
        if necessary.
    </p>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <a href="/admin/rentalPage/create" class="btn btn-success">Make New Rent</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>Rental ID</th>
                            <th>Customer Name</th>
                            <th>Car Name</th>
                            <th>Brand</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Cost</th>
                            <th>Status</th>
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
        try {
            showLoader();
            let res = await axios.get("/admin/rental/list-rental");
            hideLoader();

            console.log(res);

            let tableList = $("#tableList");
            let tableData = $("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();



            res.data.forEach(function(item, index) {
                let row = `<tr>
                    <td>${item['id']}</td>
                    <td>${item['user']['name']}</td>
                    <td>${item['car']['name']}</td>
                    <td>${item['car']['brand']}</td>
                    <td>${item['start_date']}</td>
                    <td>${item['end_date']}</td>
                    <td>${item['total_cost']}</td>

                    <td>
                        ${item['status'] === 'Processing' ? `
                            <p class=" badge badge-info text-xs font-weight-bold text-uppercase mb-2 mt-3">${item['status']}</p>
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
                    
                    <td>
                        <button id="${index}"  data-id="${item['id']}" class="mb-2 mt-3 btn editBtn btn-sm btn-outline-warning ">Edit</button>
                        
                        <button id="${index}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                 </tr>`
                tableList.append(row)
            })

            $('.editBtn').on('click', async function() {
                rentIndex = ($(this).attr('id'));
                updateView(res.data[rentIndex])
                $("#update-modal").modal('show');
            })

            $('.deleteBtn').on('click', function() {
                let id = $(this).data('id');
                $("#delete-modal").modal('show');
                $("#deleteID").val(id);
            })

            new DataTable('#tableData', {
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [5, 10, 15, 20, 30]
            });
        } catch (e) {

        }
    }
</script>
