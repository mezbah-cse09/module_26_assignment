<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">

                                    <label class="form-label mt-2">Name</label>
                                    <input type="text" class="form-control" id="nameUpdate">

                                    <label class="form-label mt-2">Email</label>
                                    <input type="text" class="form-control" id="emailUpdate">

                                    <label class="form-label mt-2">Password</label>
                                    <input type="text" class="form-control" id="passwordUpdate">

                                    <label class="form-label">Role</label>
                                    <select type="text" class="form-control form-select" id="roleUpdate">
                                        <option value="">Select Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Customer">Customer</option>
                                    </select>

                                    <input type="text" class="d-none" id="updateID">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="update-modal-close" class="btn btn-secondary mx-2" data-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Update()" id="update-btn" class="btn btn-success" >Update</button>
                </div>
            </div>
    </div>
</div>


<script>

    async function FillUpUpdateForm(id){
        document.getElementById('updateID').value=id;

        showLoader();

        let res=await axios.post("/admin/customer-by-id",{id:id})
        console.log(res);
        
        hideLoader();
        document.getElementById('nameUpdate').value = res.data['name'];
        document.getElementById('emailUpdate').value = res.data['email'];
        document.getElementById('passwordUpdate').value = res.data['password'];
        document.getElementById('roleUpdate').value = res.data['role'];
    }

    async function Update() {

        let idUpdate=document.getElementById('updateID').value;
        let nameUpdate = document.getElementById('nameUpdate').value;
        let emailUpdate = document.getElementById('emailUpdate').value;
        let passwordUpdate = document.getElementById('passwordUpdate').value;
        let roleUpdate = document.getElementById('roleUpdate').value;


        if(nameUpdate.length===0){
            errorToast("Customer Name Required !")
        }
        else if(emailUpdate.length===0){
            errorToast("Customer Email Required !")
        }
        else if(passwordUpdate.length===0){
            errorToast("Customer Password Required !")
        }
        else if(roleUpdate.length===0){
            errorToast("Customer role Required !")
        }

        else {

            document.getElementById('update-modal-close').click();

            showLoader();
            let res = await axios.post("/admin/update-customer",{
                id:idUpdate,
                name:nameUpdate,
                email:emailUpdate,
                password:passwordUpdate,
                role:roleUpdate

            })
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast('Request completed');
                document.getElementById("update-form").reset();
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>
