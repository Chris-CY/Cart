@extends('default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end">
                <a href="{{ route('order.index') }}" type="button" class="btn btn-secondary btn-block">
                    Back
                </a>
            </div>
        </div>

        <div class="card mt-4 mb-5 row">
            <h4 class="card-header">Order Details</h4>
            <div class="card-body">
                <legend>Product List</legend>
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col" class="text-center">Quantity</th>
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
                            <td class="col-1 text-center">
                                {{$product->quantity}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <form action="{{ route('order.edit', ['id' => $order->id]) }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="orderDate" class="col-sm-2 col-form-label">Order Date :</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="orderDate"
                                   value="{{ \Carbon\Carbon::parse($order->order_date)->format('j F Y') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="orderDate" class="col-sm-2 col-form-label">Order Time :</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="orderDate"
                                   value="{{ \Carbon\Carbon::parse($order->order_date)->format('h:m A') }}">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label class="col-sm-2 col-form-label">Status :</label>
                        <div class="col-sm-10">
                            <h4>
                            <span class="badge @if($order->status == 'Submitted') bg-warning
                                                @elseif($order->status == 'Completed') bg-primary
                                                @else bg-secondary
                                                @endif">
                                {{ $order->status }}
                            </span>
                            </h4>
                        </div>
                    </div>
                    @if($order->status == 'Submitted')
                        <hr>
                        <div class="float-end">
                            <button type="submit" class="btn btn-primary btn-lg" name="action" value="D">
                                Complete Order
                            </button>
                            <button type="submit" class="btn btn-secondary btn-lg" name="action" value="C">
                                Cancel Order
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
