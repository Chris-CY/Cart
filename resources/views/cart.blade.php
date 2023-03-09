@extends('default')

@section('content')
    <div class="card">
        <h4 class="card-header">Cart</h4>
        @if(Route::is('cart') )
            <form action="{{ route('cart', ['id' => $cart_id]) }}" method="post">
                @csrf
                <div class="card-body">
                    <table class="table">
                        <thead class="table-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <input type="hidden" class="form-control" name="id[]" value="{{$product->id}}">
                            <tr>
                                <td scope="row">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{$product->image_url}}" class="img-thumbnail" style="height:130px;width:130px;">
                                    </div>
                                </td>
                                <td>{{$product->name}}</td>
                                <td class="col-1">
                                    <input type="text" class="form-control text-center" name="quantity[]" value="{{$product->quantity}}" required>
                                </td>
                                <td class="col-1">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-light delete-btn" data-id="{{$product->id}}">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Place Order
                    </button>
                </div>
            </form>
        @else
            <div class="card-body py-5">
                <div class="row justify-content-center">Your cart is empty.</div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('catalogue') }}" type="button" class="btn btn-warning btn-block">
                        Go to Catalogue
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $cart_id = {{$cart_id}}

            $(".delete-btn").click(function () {
                $.ajax({
                    url: "/delete-cart",
                    method: 'POST',
                    data: {
                        product_id: $(this).data("id"),
                        cart_id: $cart_id
                    },
                    success: function (data) {
                        console.log(data);
                        location.reload();
                    },
                    error: function (data) {
                        alert(data);
                    }
                });
            });
        });
    </script>
@endsection
