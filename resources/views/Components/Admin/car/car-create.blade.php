<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">

                                    {{-- <label class="form-label">Category</label>
                                    <select type="text" class="form-control form-select" id="productCategory">
                                        <option value="">Select Category</option>
                                    </select> --}}

                                    <label class="form-label mt-2">Name</label>
                                    <input type="text" class="form-control" id="carName">

                                    <label class="form-label mt-2">Brand</label>
                                    <input type="text" class="form-control" id="carBrand">

                                    <label class="form-label mt-2">Model</label>
                                    <input type="text" class="form-control" id="carModel">

                                    <label class="form-label mt-2">Year</label>
                                    <input type="text" class="form-control" id="carYear">

                                    <label class="form-label mt-2">Type</label>
                                    <input type="text" class="form-control" id="carType">

                                    <label class="form-label mt-2">Daily Rent</label>
                                    <input type="number" min="0" class="form-control" id="carRent">


                                    <br/>
                                    <img class="w-15" id="newImg" src="{{asset('images/default.svg')}}"/>
                                    <br/>

                                    <label class="form-label">Image</label>
                                    <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="carImg">

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



    // FillCategoryDropDown();

    // async function FillCategoryDropDown(){
    //     let res = await axios.get("/list-category")
    //     res.data.forEach(function (item,i) {
    //         let option=`<option value="${item['id']}">${item['name']}</option>`
    //         $("#productCategory").append(option);
    //     })
    // }


    async function Save() {

        // let productCategory=document.getElementById('productCategory').value;
        let carName = document.getElementById('carName').value;
        let carBrand = document.getElementById('carBrand').value;
        let carModel = document.getElementById('carModel').value;
        let carYear = document.getElementById('carYear').value;
        let carType = document.getElementById('carType').value;
        let carRent = document.getElementById('carRent').value;
        let carImg = document.getElementById('carImg').files[0];


        if(carName.length===0){
            errorToast("Car Name Required !")
        }
        else if(carBrand.length===0){
            errorToast("Car Price Required !")
        }
        else if(carModel.length===0){
            errorToast("Car Model Required !")
        }
        else if(carYear.length===0){
            errorToast("Car Year Required !")
        }
        else if(carType.length===0){
            errorToast("Car Type Required !")
        }
        else if(carRent.length===0){
            errorToast("Car Rent Required !")
        }
        else if(!carImg){
            
            errorToast("Product Image Required !")
        }

        else {

            document.getElementById('modal-close').click();

            let formData=new FormData();
            formData.append('img',carImg)
            formData.append('name',carName)
            formData.append('brand',carBrand)
            formData.append('model',carModel)
            formData.append('year',carYear)
            formData.append('car_type',carType)
            formData.append('daily_rent_price',carRent)
            formData.append('availability',1)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/admin/create-car",formData,config)
            hideLoader();

            if(res.status===201){
                successToast('Request completed');
                document.getElementById("save-form").reset();
                document.getElementById("newImg").src="{{asset('images/default.svg')}}";            
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>
