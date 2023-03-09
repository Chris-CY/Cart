@extends('default')

@section('content')
    <h2 class="mb-4">Order List</h2>
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
            <th scope="col">ID</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td scope="row">
                    {{$order->id}}
                </td>
                <td>{{$order->status}}</td>
                <td class="col-2">
                    <a href="{{ route('order.edit', ['id' => $order->id]) }}" class="btn btn-primary edit">
                        Edit
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $orders->links() !!}
    </div>
@endsection
