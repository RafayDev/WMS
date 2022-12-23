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
                <form action="/add-product" method="POST">
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
                                <select class="form-control mt-2" style="background-color:#FAFAFA;">
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
                    <label for="description"><b>Description:</b></label>
                    <textarea class='mt-2' id="description" name="description"></textarea>
                    <div class="border-top my-3 mt-5"></div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="primary"><b>Add Product</b></button>
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
    url: '/upload',
    method: 'post',
    autoProcessQueue: false,
    uploadMultiple: true,
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time + file.name;
    },
    parallelUploads: 10,
    maxFiles: 12,
    maxFilesize: 10,
    acceptedFiles: ".jpeg,.jpg,.png,",
    addRemoveLinks: true,
    key: "submitRequest",
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.
        this.on("complete", function(file) {
            location.reload();
        });
        // for Dropzone to process the queue (instead of default form behavior):
        document.getElementById("submit").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            dzClosure.processQueue();
        });
        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("_token", jQuery("[name=_token]").val());
            formData.append("title", jQuery("#title").val());
            formData.append("description", jQuery("#description").val());
            formData.append("start-date", jQuery("#start-date").val());
            formData.append("category", jQuery("#category").val());
            formData.append("end-date", jQuery("#end-date").val());
            formData.append("infinity", jQuery("#infinity").val());
            formData.append("scope", jQuery("#scope").val());
            formData.append("team", jQuery("#team").val());
            formData.append("member", jQuery("#member").val());


        });
    }
}
tinymce.init({
    selector: 'textarea#description',
    plugins: "table pagebreak preview print fullpage emoticons spellchecker image imagetools anchor wordcount lists",
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
});
</script>
@endsection