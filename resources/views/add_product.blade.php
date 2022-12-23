@extends('layouts.app')
@section('content')
<style>
.primary {
  background-color: #0947F9;
  border: none;
  color: white;
  padding: 10px 90px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 16px;
}

.primary:hover {
  background-color: #0041FC;
}
</style>
<div class="container">
    <div class='row'>
        <div class='col-md-2'></div>
        <div class='col-md-8'>
            <h4> Add Product Here</h4>
            <div class='mt-3'>
            <form id="addProductform" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product_name"><b>Title:</b></label>
                        <input type="text" class="form-control mt-2" id="title" name="title"
                            style="background-color:#FAFAFA;">
                    </div>
                    <div class='row mt-5'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label for="sku"><b>Store Keeping Unit (SKU):</b></label>
                                <input type="text" class="form-control mt-2" id="sku" name="sku"
                                    style="background-color:#FAFAFA;">
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label for="upc"><b>Universal Product Code (UPC):</b></label>
                                <input type="text" class="form-control mt-2" id="upc" name="upc"
                                    style="background-color:#FAFAFA;">
                            </div>
                        </div>
                    </div>
                    <div class='row mt-3'>
                        <div class='col-md-3'>
                            <div class="form-group">
                                <label for="condition"><b>Condition:</b></label>
                                <select class="form-control mt-2"  id='condition' name="condition" style="background-color:#FAFAFA;">
                                    <option value="New">New</option>
                                    <option value="Used">Used</option>
                                    <option value="Broken">Broken</option>
                                </select>
                            </div>
                        </div>
                        <div class='col-md-9'></div>
                    </div>
                    <div class='mt-3'>
                        <label for="images"><b>Photos:</b></label>
                        <div class="dropzone text-center justify-content-center" id="images" name="images">
                            <p>Upload Your Photos .jgeg, .png, .jpg</p>
                            <h1><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                <h1>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category"><b>Category:</b></label>
                                <input type="text" class="form-control mt-2" id="category" name="category"
                                    style="background-color:#FAFAFA;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand"><b>Brand:</b></label>
                                <input type="text" class="form-control mt-2" id="brand" name="brand"
                                    style="background-color:#FAFAFA;">
                            </div>
                        </div>
                    </div>
                    <div class="border-top my-3"></div>
                    <div class='row mt-3'>
                        <div class='col-md-3'>
                            <div class="form-group">

                                <label for="price"><b>Price ($):</b></label>
                                <div class='input=group'>
                                    <input type="number" class="form-control mt-2" id="price" name="price"
                                        style="background-color:#FAFAFA;">
                                </div>

                            </div>
                        </div>
                        <div class='col-md-10'></div>
                    </div>
                    <div class='row mt-3'>
                        <div class='col-md-3'>
                            <div class="form-group">
                                <label for="brand"><b>Quanity:</b></label>
                                <input type="number" class="form-control mt-2" id="quantity" name="quantity"
                                    style="background-color:#FAFAFA;">
                            </div>
                        </div>
                    </div>
                    <div class='row mt-3'>
                        <div class='col-md-3'>
                            <div class="form-group">
                                <label for="shiping_cost"><b>Shiping Cost ($):</b></label>
                                <input type="number" class="form-control mt-2" id="shiping_cost" name="shiping_cost"
                                    style="background-color:#FAFAFA;">
                            </div>
                        </div>
                        <div class='col-md-9'></div>
                    </div>
                    <div class="border-top my-3"></div>
                    <label for="description" class='mt-2'><b>Description:</b></label>
                    <textarea id="content" name="content"></textarea>
                    <div class="border-top my-3 mt-5"></div>
                    <div class="d-flex justify-content-center">
                        <button id="submit" name="submit" type='submit' class="primary"><b>Add Product</b></button>
                    </div>
                </form>
            </div>
        </div>
        <div class='col-md-2'></div>
    </div>
</div>
@endsection
@section('script')
<script>
Dropzone.options.images = {
    headers: {
        'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
    },
    url: '/addProduct',
    method: 'post',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 10,
    maxFiles: 12,
    maxFilesize: 10,
    acceptedFiles: ".jpeg,.jpg,.png,",
    addRemoveLinks: true,
    key: "submitRequest",
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.
        
        // for Dropzone to process the queue (instead of default form behavior):
        document.getElementById("submit").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
            // get tiny mce editot Data
            // var content = tinyMCE.activeEditor.getContent();
            // console.log(content);
            // console.log(content);
            e.preventDefault();
            e.stopPropagation();
            dzClosure.processQueue();
        });
        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("title", $('#title').val());
            formData.append("description", tinyMCE.activeEditor.getContent());
            formData.append("sku", $('#sku').val());
            formData.append("upc", $('#upc').val());
            formData.append("condition", $('#condition').val());
            formData.append("category", $('#category').val());
            formData.append("brand", $('#brand').val());
            formData.append("price", $('#price').val());
            formData.append("quantity", $('#quantity').val());
            formData.append("shipping_cost", $('#shiping_cost').val());
        });
        //after sucess
        this.on("successmultiple", function(files, response) {
            console.log(response);
            // clear form Data
            $('#title').val('');
            $('#sku').val('');
            $('#upc').val('');
            $('#condition').val('');
            $('#category').val('');
            $('#brand').val('');
            $('#price').val('');
            $('#quantity').val('');
            $('#shiping_cost').val('');
            tinyMCE.activeEditor.setContent('');
            // clear dropzone
            this.removeAllFiles(true);
            toastr.success("Product added sucessfully<br><a href='/home'>Go to Inventory</a>");
            //reload page
            // location.reload();

        });
    }
}
tinymce.init({
    selector: 'textarea#content',
    plugins: "table pagebreak preview emoticons anchor wordcount lists",
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
});
</script>
@endsection