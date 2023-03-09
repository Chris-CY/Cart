@extends('default')

@section('content')
    <h2 class="mb-4">Catalogue</h2>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="alert alert-success" id="alert" style="display: none"></div>
    <table class="table">
        <thead class="table-light">
        <tr>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td scope="row">
                    <div class="d-flex justify-content-center">
                        <img src="{{$product->image_url}}" class="img-thumbnail" style="height:130px;width:130px;">
                    </div>
                </td>
                <td>{{$product->name}}</td>
                <td class="col-2">
                    <button type="button" class="btn btn-primary add-to-cart" data-id="{{$product->id}}">
                        Add to Cart
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $products->links() !!}
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".add-to-cart").click(function () {
                $.ajax({
                    url: "/add-cart",
                    method: 'POST',
                    data: {id: $(this).data("id")},
                    success: function (data) {
                        @if(!$cart_id)
                            location.reload();
                        @endif
                        $('#alert').show();
                        $('#alert').html(data).fadeIn('slow');
                        $('#alert').html(data.success).fadeIn('slow'); //also show a success message
                        $('#alert').delay(5000).fadeOut('slow');
                    },
                    error: function (data) {
                        alert(data);
                    }
                });
            });
        });
    </script>
@endsection
