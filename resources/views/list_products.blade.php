@extends('layouts.app')
@section('content')
<style>
    .zoom:hover {
  -ms-transform: scale(5.5); /* IE 9 */
  -webkit-transform: scale(5.5); /* Safari 3-8 */
  transform: scale(5.5); 
}
    </style>
<div class="container">
    <div class='row'>
        <div class='col-md-6'>
            <h3>Inventory</h3>
        </div>
        <div class='col-md-6'>
            <!-- search box -->
            <form action="/search" method="GET">
                <div class="input-group">
                    <input type="search" name="search" class="form-control" placeholder="Search your Product Here">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
        <div class='col-md-12 mt-5'>
            <table class="table table-hover">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product Id</th>
                        <th scope="col">Product Title</th>
                        <th scope="col">SKU</th>
                        <th scope="col">UPC</th>
                        <th scope="col">Category</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Condition</th>
                        <th scope="col">Price</th>
                        <th scope="col">Shipping Cost</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @if(count($products) > 0)
                    @foreach($products as $product)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        @if(!empty($product->image->path))
                        <td><a href='#'><div class="zoom"><img src="{{asset('images/'.$product->image->path)}}" alt="product image" width="50px"
                                height="50px"></div></a></td>
                        @else
                        <td>No Image</td>
                        @endif
                        <td>{{$product->id}}</td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->sku}}</td>
                        <td>{{$product->upc}}</td>
                        <td>{{$product->category}}</td>
                        <td>{{$product->brand}}</td>
                        <td>{{$product->condition}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->shipping_cost}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>
                            <select name="action" id="action" style="border: 1px solid #fff; background-color: transparent; width: 100px;">
                                <option value="" hidden>Edit</option>
                                <option value="update" data-product-id="{{$product->id}}">Update</option>
                                <option value="delete" data-product-id="{{$product->id}}">Delete</option>
                            </select>
                            <!-- <a href="/edit-product/{{$product->id}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil"></i></a>
                            <a href="/delete-product/{{$product->id}}" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="12" class="text-center"><b>No Product Found</b>
                    </tr>
                    @endif
                </tbody>
            </table>
            <!-- //paginate the link -->
            <div class="d-flex justify-content-center">
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>
<!-- delete waring model -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/delete-product" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id" value="">
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

    @endsection
    @section('script')
    <script>
        $(document).ready(function () {
            $('#action').change(function () {
                var action = $(this).val();
                var product_id = $(this).find(':selected').data('product-id');
                if (action == 'delete') {
                    $('#product_id').val(product_id);
                    $('#deleteModal').modal('show');
                }
                else if (action == 'update') {
                    window.location.href = '/edit-product/' + product_id;
                }
            });
        });
        // if cancel click resrt the select option
        $('#cancel').click(function () {
            $('#action').val('');
        });
    </script>
    @endsection