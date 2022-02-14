@extends('layouts.base')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(51, 51, 51)">
    <div class="container">
        <a class="navbar-brand" href="#">Cart App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="flex-flow: row-reverse;">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Add Product</a></li>
                <li class="nav-item"><a class="nav-link ml-4" href="{{url('view-cart')}}">Cart (<span id="cart_id">0</span>)</a></li>
            </ul>
        </div>
    </div>
</nav>
<header class="py-3 bg-image-full" style="background-image: url('https://image.freepik.com/free-vector/blue-wall-with-spot-lights-background_52683-42963.jpg')">
    <div class="text-center my-4 pt-4">
    </div>
</header>
<section class="py-3">
    <div class="container my-3">
        <div class="row justify-content-center" id="page_starts">
            <div class="col-lg-7">
                <h2>Add New Product</h2>
                <hr>
                <!-- fetch alerts -->
                <div class="form-group">
                    @include('components.alerts')
                </div>

                <form action="{{url('save-new-product')}}" method="POST" id="product_form">
                    @csrf
                    <div class="mb-3">
                        <label for="p_name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="p_name" name="p_name" required>
                        <span id="p_name_err" class="form-text text-danger text-sm"></span>
                    </div>
                    <div class="mb-3">
                        <label for="unit_price" class="form-label">Unit Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="unit_price" name="unit_price" required>
                        <span id="price_err" class="form-text text-danger text-sm"></span>
                    </div>
                    <div class="mb-3">
                        <label for="qty_id" class="form-label">Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control col-2" id="qty_id" name="qty" required>
                        <span id="qty_err" class="form-text text-danger text-sm"></span>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        <span id="description_err" class="form-text text-danger text-sm"></span>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <input type="button" class="btn btn-primary shadow px-2 col-3" value="Add New" onclick="submitForm()">
                        <input type="button" class="btn btn-light btn-outline-secondary float-right px-2 col-2" value="Clear" onclick="resetForm()">
                    </div>
                </form>
            </div>
        </div>
        <br><hr>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h2>Products List</h2>
                <hr>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Qty.</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $pro)
                                    <tr>
                                        <td class="text-primary">{{$pro->name}}</td>
                                        <td>{{$pro->description}}</td>
                                        <td>{{$pro->unit_price}} LKR</td>
                                        <td>{{$pro->qty}}</td>
                                        <td>
                                            <input type="button" class="btn btn-sm btn-primary" value="Edit" data-toggle="modal" data-target="#editModal-{{$pro->id}}">
                                            <a href="/add-to-cart/{{$pro->id}}" class="btn btn-sm btn-success">Add to Cart</a>
                                            <a href="/delete-product/{{$pro->id}}" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal-{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Product Info</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{url('update-new-product')}}" method="POST">
                                                        @csrf
                                                        <input hidden type="text" name="product_id" value="{{$pro->id}}">
                                                        <div class="mb-3">
                                                            <label for="p_name_edit" class="form-label">Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="p_name_edit" name="p_name_edit" value="{{$pro->name}}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="unit_price_edit" class="form-label">Unit Price <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" id="unit_price_edit" name="unit_price_edit" value="{{$pro->unit_price}}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="qty_id_edit" class="form-label">Quantity <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control col-2" id="qty_id_edit" name="qty_id_edit" value="{{$pro->qty}}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description_edit" class="form-label">Description</label>
                                                            <textarea class="form-control" id="description_edit" name="description_edit" rows="3">{{$pro->description}}</textarea>
                                                        </div>
                                                        <hr>
                                                        <div class="mb-3">
                                                            <input type="submit" class="btn btn-primary shadow px-2" value="Update">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('additional-scripts')
<script>

$( document ).ready(function() {
    cartCount();
});

function cartCount(){
    $.ajax({
        url: "/get-cart-count",
        type: 'GET',
        success: function(response) {

            $('#cart_id').text(response.product_count);

        }
    });
}

function resetForm(){

    $('#p_name_err').text("");
    $('#price_err').text("");
    $('#description_err').text("");

    $('#p_name').css('border-color', '');
    $('#unit_price').css('border-color', '');
    $('#description').css('border-color', '');

    $('#product_form').trigger("reset");
    $('html, body').animate({
        scrollTop: $("#page_starts").offset().top
    }, 500);

}

function submitForm(){

    if(!$('#p_name').val()) {

        $('#p_name').css('border-color', 'red');
        $('#p_name_err').text("Please enter the Product Name !");

        $('html, body').animate({
            scrollTop: $("#page_starts").offset().top
        }, 500);

    }else if(!$('#unit_price').val()){

        $('#p_name').css('border-color', '');
        $('#p_name_err').text("");

        $('#unit_price').css('border-color', 'red');
        $('#price_err').text("Please enter your Last name !");

        $('html, body').animate({
            scrollTop: $("#page_starts").offset().top
        }, 500);

    }else if(!$('#qty_id').val()){

        $('#p_name').css('border-color', '');
        $('#p_name_err').text("");

        $('#unit_price').css('border-color', '');
        $('#price_err').text("");

        $('#qty_id').css('border-color', 'red');
        $('#qty_err').text("Please enter Product Quantity !");

        $('html, body').animate({
            scrollTop: $("#page_starts").offset().top
        }, 500);

    }else if($('#qty_id').val()<1){
        $('#p_name').css('border-color', '');
        $('#p_name_err').text("");

        $('#unit_price').css('border-color', '');
        $('#price_err').text("");

        $('#qty_id').css('border-color', 'red');
        $('#qty_err').text("Please enter valid Quantity !");

        $('html, body').animate({
            scrollTop: $("#page_starts").offset().top
        }, 500);
    }else {

        $('#price_err').text("");
        $('#p_name_err').text("");
        $('#qty_err').text("");

        $('#p_name').css('border-color', '');
        $('#unit_price').css('border-color', '');
        $('#qty_id').css('border-color', '');

        $('#product_form').submit();

    }
}
</script>
@endsection

