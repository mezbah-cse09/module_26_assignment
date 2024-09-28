
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Customer</h1>
    <p class="mb-4">Tables is a showing Listings of all added Customers in system. Admin can Add, edit, and delete Customer details if necessary. 
        Tables is a showing Listings of all added Customers in system. Admin can Add, edit, and delete Customer details if necessary.
    </p>


    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <button data-toggle="modal" data-target="#create-modal" class="btn btn-success">Add New Customer</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Rental History</th>
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
        let res=await axios.get("/admin/list-customer");
        hideLoader();

        console.log(res);
    
        let tableList=$("#tableList");
        let tableData=$("#tableData");
    
        tableData.DataTable().destroy();
        tableList.empty();

        

        res.data.forEach(function (item,index) {
        let row=`<tr>
                    <td>${item['id']}</td>
                    <td>${item['name']}</td>
                    <td>${item['email']}</td>
                    <td>${item['role']}</td>
                    <td>
                        <button data-id="${item['id']}"  class="btn rentalHistoryBtn btn-sm btn-outline-info">See History</button>
                    </td>
                    <td>
                        <button  data-id="${item['id']}" class="mb-2 mt-3 btn editBtn btn-sm btn-outline-warning ">Edit</button>
                        
                        <button  data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                 </tr>`
        tableList.append(row)
    })
    
        $('.rentalHistory').on('click',async function (){
            let id = $(this).data('id');
            // changeAvailability(id,availability);
        });

        $('.editBtn').on('click', async function () {
               let id= $(this).data('id');
               await FillUpUpdateForm(id)
               $("#update-modal").modal('show');
        })
    
        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
        })
    
        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20,30]
        });
    
    }
    

    async  function  changeAvailability($id,$availability){
            let id=$id;
            let availability=$availability;
            showLoader();
            let res=await axios.post("/admin/update-car-availability",{id:id,availability:availability})
            hideLoader();
            if(res.data===1){
                successToast("Request completed")
                await getList();
            }
            else{
                errorToast("Request fail!")
            }
     }
    
    </script>
    