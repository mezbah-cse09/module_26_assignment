<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">

                                    <label class="form-label mt-2">Name</label>
                                    <input type="text" class="form-control" id="name">

                                    <label class="form-label mt-2">Email</label>
                                    <input type="text" class="form-control" id="email">

                                    <label class="form-label mt-2">Password</label>
                                    <input type="text" class="form-control" id="password">

                                    <label class="form-label">Role</label>
                                    <select type="text" class="form-control form-select" id="role">
                                        <option value="">Select Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Customer">Customer</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-secondary mx-2" data-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    async function Save() {

        // let productCategory=document.getElementById('productCategory').value;
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let role = document.getElementById('role').value;


        if(name.length===0){
            errorToast("Customer Name Required !")
        }
        else if(email.length===0){
            errorToast("Customer Email Required !")
        }
        else if(password.length===0){
            errorToast("Customer Password Required !")
        }
        else if(role.length===0){
            errorToast("Customer role Required !")
        }

        else {
            document.getElementById('modal-close').click();

            showLoader();
            let res = await axios.post("/admin/create-customer",{
                name:name,
                email:email,
                password:password,
                role:role
            })
            hideLoader();

            if(res.status===201){
                successToast('Request completed');
                document.getElementById("save-form").reset();
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>
