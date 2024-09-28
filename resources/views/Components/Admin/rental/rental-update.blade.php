<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Rent Detail</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body" id="rentBody">
                                <!-- Rent Detail -->
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Customer Detail</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body" id="userBody">
                                <!-- Customer Detail -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-md-6 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <label for="statusUpdate">Status</label>
                                    <select type="text" class="form-control form-select" id="statusUpdate">
                                        <option value="">---Change Status---</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Started">Started</option>
                                        <option value="Canceled">Canceled</option>
                                        <option value="Rejected">Rejected</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="text" class="d-none" id="updateID">
                <button id="update-modal-close" class="btn btn-secondary mx-2" data-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
</div>




<script>
    // updateView()

    function updateView(item) {
        // console.log(item)
        let html = `
            <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                    src="{{ asset('/') }}${item['car']['image']}" alt="...">
            </div>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center flex-shrink-0 me-3">

                    <div class="d-flex flex-column fw-bold">
                        <a class="text-dark line-height-normal mb-1">${item['car']['name']}</a>
                        <div class="small text-muted line-height-normal">${item['car']['brand']}-${item['car']['model']}-${item['car']['year']}</div>
                    </div>
                </div>
            </div>

            <div class=" justify-content-center">
                <div class="col-xl-12 col-lg-8">
                    <h5 class="card-title mb-4">Review the following information and submit</h5>
                    <div class="row small text-muted">
                        <div class="col-sm-3 text-truncate"><em>Rent Id:</em></div>
                        <div class="col">${item['id']}</div>
                    </div>
                    <div class="row small text-muted">
                        <div class="col-sm-3 text-truncate"><em>Car Id:</em></div>
                        <div class="col">${item['car']['id']}</div>
                    </div>
                    <div class="row small text-muted">
                        <div class="col-sm-3 text-truncate"><em>Start Date:</em></div>
                        <div class="col">${item['start_date']}</div>
                    </div>
                    <div class="row small text-muted">
                        <div class="col-sm-3 text-truncate"><em>End Date:</em></div>
                        <div class="col">${item['end_date']}</div>
                    </div>
                    <div class="row small text-muted">
                        <div class="col-sm-3 text-truncate"><em>Daily Rent:</em></div>
                        <div class="col">${item['car']['daily_rent_price']}  BDT</div>
                    </div>
                    <h7>
                        Status : 
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
    
                    </h7>
                    <hr class="my-4">
                    <h4 class="card-title mb-4">Total Cost : ${item['total_cost']} BDT</h4>

                </div>
            </div>
        `

        document.getElementById('rentBody').innerHTML = html

        let userHtml = `<div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center flex-shrink-0 me-3">
                                <div class="d-flex flex-column fw-bold">
                                    <a class="text-dark line-height-normal mb-1">${item['user']['name']}</a>
                                    <div class="small text-muted line-height-normal">${item['user']['email']}</div>
                                </div>
                            </div>
                        </div>`
        document.getElementById('userBody').innerHTML = userHtml

        document.getElementById('statusUpdate').value = item['status']
        document.getElementById('updateID').value = item['id']

        if ((item['status'] === 'Processing') || (item['status'] === 'Started')) {} else {
            document.getElementById('update-btn').disabled = true
        }
    }


    async function FillUpUpdateForm(id) {
        document.getElementById('updateID').value = id;

        showLoader();

        let res = await axios.post("/admin/customer-by-id", {
            id: id
        })
        console.log(res);

        hideLoader();
        document.getElementById('nameUpdate').value = res.data['name'];
        document.getElementById('emailUpdate').value = res.data['email'];
        document.getElementById('passwordUpdate').value = res.data['password'];
        document.getElementById('roleUpdate').value = res.data['role'];
    }

    async function Update() {
        try {
            let status = document.getElementById('statusUpdate').value;
            let id = document.getElementById('updateID').value;


            if (id.length === 0) {
                errorToast("Some thing wrong !")
            } else if (status.length === 0) {
                errorToast("Rent Status Required !")
            } else {

                document.getElementById('update-modal-close').click();

                showLoader();
                let res = await axios.post("/admin/rental/update-rental", {
                    id: id,
                    status: status
                })
                hideLoader();

                if (res.status === 200 && res.data === 1) {
                    successToast('Request completed');
                    await getList();
                } else {
                    errorToast("Request fail !")
                }
            }
        } catch (e) {
            errorToast("Request fail !")
        }
    }
</script>
