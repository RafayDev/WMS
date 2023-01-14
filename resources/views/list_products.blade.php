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
                    <input type="search" name="search" id="livesearch" class="form-control" placeholder="Search your Product Here">
                    <span class="input-group-prepend">
                        <a href="#" class="btn btn-primary"><i class="fa fa-search"></i></a>
                    </span>
                </div>
            </form>
        </div>
        <div class='col-md-12 mt-5'>
        <table id="product" class="table table-bordered table-striped" data-resizable-columns-id="demo-table-v2"  style="width:100%">
                <thead class="text-center">
                    <tr>
                        <th data-resizable-column-id="#">#</th>
                        <th data-resizable-column-id="image">Image</th>
                        <th data-resizable-column-id="product_id">Product Id</th>
                        <th data-resizable-column-id="product_title" style="width:2000px;">Product Title</th>
                        <th data-resizable-column-id="sku">SKU</th>
                        <th data-resizable-column-id="upc">UPC</th>
                        <th data-resizable-column-id="category">Category</th>
                        <th data-resizable-column-id="brand">Brand</th>
                        <th data-resizable-column-id="condition">Condition</th>
                        <th data-resizable-column-id="price">Price</th>
                        <th data-resizable-column-id="shippring_cost">Shipping Cost</th>
                        <th data-resizable-column-id="quantity">Quantity</th>
                        <th data-resizable-column-id="action" data-noresize>Action</th>
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
                            <!-- <select name="action" id="action" style="border: 1px solid #fff; background-color: transparent; width: 100px;">
                                <option value="" hidden>Edit</option>
                                <option value="update" data-product-id="{{$product->id}}">Update</option>
                                <option value="delete" data-product-id="{{$product->id}}">Delete</option>
                            </select> -->
                            <div class="btn-group">
  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Edit
  </button>
  <ul class="dropdown-menu" style="min-width: 70px;">
    <li><a class="dropdown-item" href="/edit-product/{{$product->id}}">Update</a></li>
    <li> <button class="dropdown-item delete-product"
                                                data-delete-product-id="{{ $product->id }}" data-bs-toggle="modal"
                                                data-bs-target="#deletefilemodal">Delete
                                            </button></li>
  </ul>
</div>
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
        </div>
    </div>
</div>
        <!-- Modal delete -->
        <div class="modal fade" id="deletefilemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete File</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <p>Are you Sure to delete this Product?</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a class="btn btn-danger" href="" role="button" id="modaldeletecontract">Delete</a>



                        </div>
                    </div>

                </div>
            </div>


    @endsection
    @section('script')
    <script>
            $('.delete-product').click(function(e) {
        $('#modaldeletecontract').attr('href', '/delete-product/' + $(this).attr('data-delete-product-id'));
    });
        $(document).ready(function(){

$('input#livesearch').liveSearch({
  table : 'table' // table selector
});

});
  //assending and desending order in table
        $(document).ready(function () {
            $('th').click(function () {
                var table = $(this).parents('table').eq(0)
                var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
                this.asc = !this.asc
                if (!this.asc) { rows = rows.reverse() }
                for (var i = 0; i < rows.length; i++) { table.append(rows[i]) }
            })
        })
        function comparer(index) {
            return function (a, b) {
                var valA = getCellValue(a, index), valB = getCellValue(b, index)
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
            }
        }
        function getCellValue(row, index) { return $(row).children('td').eq(index).text() }
        //live search in table 
        // $(document).ready(function () {
            
            
        //     $("#search").on("keyup", function () {
        //         var value = $(this).val().toLowerCase();
        //         $("#product tr").filter(function () {
        //             //always show the first row
        //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        //         });
        //     });
        // });

        //delete product

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
        $(function(){
      $("table").resizableColumns({
        store: window.store
      });
    });

</script>
    @endsection