<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Car</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">

                                    <label class="form-label mt-2">Name</label>
                                    <input type="text" class="form-control" id="carNameUpdate">

                                    <label class="form-label mt-2">Brand</label>
                                    <input type="text" class="form-control" id="carBrandUpdate">

                                    <label class="form-label mt-2">Model</label>
                                    <input type="text" class="form-control" id="carModelUpdate">

                                    <label class="form-label mt-2">Year</label>
                                    <input type="text" class="form-control" id="carYearUpdate">

                                    <label class="form-label mt-2">Type</label>
                                    <input type="text" class="form-control" id="carTypeUpdate">

                                    <label class="form-label mt-2">Daily Rent</label>
                                    <input type="number" min="0" class="form-control" id="carRentUpdate">


                                    <br/>
                                    <img class="w-15" id="oldImg" src="{{asset('images/default.svg')}}"/>
                                    <br/>

                                    <label class="form-label mt-2">Image</label>
                                    <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="carImgUpdate">

                                    <input type="text" class="d-none" id="updateID">
                                    <input type="text" class="d-none" id="filePath">
    

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



    // FillCategoryDropDown();

    // async function FillCategoryDropDown(){
    //     let res = await axios.get("/list-category")
    //     res.data.forEach(function (item,i) {
    //         let option=`<option value="${item['id']}">${item['name']}</option>`
    //         $("#productCategory").append(option);
    //     })
    // }

    async function FillUpUpdateForm(id,filePath){
        document.getElementById('updateID').value=id;
        document.getElementById('filePath').value=filePath;
        document.getElementById('oldImg').src=filePath;

        document.getElementById('filePath').value=filePath;
        document.getElementById('oldImg').src="{{asset('/')}}"+filePath;

        showLoader();
        // await UpdateFillCategoryDropDown();

        let res=await axios.post("/admin/car-by-id",{id:id})
        hideLoader();

        document.getElementById('carNameUpdate').value = res.data['name'];
        document.getElementById('carBrandUpdate').value = res.data['brand'];
        document.getElementById('carModelUpdate').value = res.data['model'];
        document.getElementById('carYearUpdate').value = res.data['year'];
        document.getElementById('carTypeUpdate').value = res.data['car_type'];
        document.getElementById('carRentUpdate').value = res.data['daily_rent_price'];


    }

    async function Update() {

        // let productCategory=document.getElementById('productCategory').value;
        let carName = document.getElementById('carNameUpdate').value;
        let carBrand = document.getElementById('carBrandUpdate').value;
        let carModel = document.getElementById('carModelUpdate').value;
        let carYear = document.getElementById('carYearUpdate').value;
        let carType = document.getElementById('carTypeUpdate').value;
        let carRent = document.getElementById('carRentUpdate').value;
        let updateID=document.getElementById('updateID').value;
        let filePath=document.getElementById('filePath').value;
        let carImgUpdate = document.getElementById('carImgUpdate').files[0];


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

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('id',updateID)
            formData.append('img',carImg)
            formData.append('name',carName)
            formData.append('brand',carBrand)
            formData.append('model',carModel)
            formData.append('year',carYear)
            formData.append('car_type',carType)
            formData.append('daily_rent_price',carRent)
            formData.append('file_path',filePath)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/admin/update-car",formData,config)
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast('Request completed');
                document.getElementById("update-form").reset();
                document.getElementById("newImg").src="{{asset('images/default.svg')}}";            
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>
