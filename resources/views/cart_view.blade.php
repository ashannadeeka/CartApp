@extends('layouts.base')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(51, 51, 51)">
    <div class="container">
        <a class="navbar-brand" href="#">Cart App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="flex-flow: row-reverse;">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="/">Add Product</a></li>
                <li class="nav-item"><a class="nav-link ml-4 active" href="{{url('view-cart')}}">Cart (<span id="cart_id">0</span>)</a></li>
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
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h2>Shopping Cart</h2>
                <hr>
                <!-- fetch alerts -->
                <div class="form-group">
                    @include('components.alerts')
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <a href="/delete-all-cart" class="btn btn-sm btn-danger px-2 float-right rounded">Empty Cart</a>
                    </div>
                </div>
                <table class="table mt-4" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 60%">Product</th>
                            <th scope="col" style="width: 10%">Price</th>
                            <th scope="col" style="width: 10%">Quantity</th>
                            <th scope="col" style="width: 10%">Total</th>
                            <th scope="col" style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                        <tr>
                            <td>{{$cart->product}}</td>
                            <td id="price_id-{{$cart->id}}">{{$cart->price}}</td>
                            <td><input type="number" class="form-control" id="qty_id-{{$cart->id}}" onchange="changeSubPrice('{{$cart->id}}')" value="{{$cart->qty}}"></td>
                            <td id="sub_total-{{$cart->id}}">{{ $cart->qty * $cart->price }}</td>
                            <td><a href="/delete-cart-item/{{$cart->id}}" class="btn btn-danger">X</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row mt-3">
                    <div class="col-6"></div>
                    <div class="col-3 text-right">
                        <h4>Cart Total</h4>
                    </div>
                    <div class="col-3 text-left">
                        <h3 class="text-danger" id="total_value">1250</h3>
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
    $('#myTable').DataTable();
    searchJob();

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

function changeSubPrice(id){
    var qty = $('#qty_id-'+id).val();
    var price = $('#price_id-'+id).text();
    $('#sub_total-'+id).text(qty*price);
    searchJob();
}

function searchJob() {

var input, filter, table, tr, td, i, txtValue,sum;
table = document.getElementById("myTable");
tr = table.getElementsByTagName("tr");
sum = 0;

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
            txtValue = td.textContent || td.innerText;
            sum += parseInt(txtValue);
        }
    }

    $('#total_value').text(sum);

}

</script>
@endsection

