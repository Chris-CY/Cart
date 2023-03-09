<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('catalogue') }}" class="nav-link px-2 link-dark">Catalogue</a></li>
                <li><a href="{{ route('order.index') }}" class="nav-link px-2 link-dark">Order List</a></li>
            </ul>

            <div class="dropdown-center">
                <a class="btn dropdown-toggle position-relative me-3" id="btn-noti" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                   style="padding: 4px!important;">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    @if($count_notifications > 0)
                        <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger" id="count_notifications">
                            {{($count_notifications)}}
                        </span>
                    @endif
                </a>
                <ul class="dropdown-menu mt-1">
                    @if(count($notifications) > 0 )
                        @foreach($notifications as $notification)
                            <li>
                                <a class="dropdown-item" href="{{ route('order.edit', ['id' => $notification->order_id]) }}">
                                    <span class="{{ ($notification->status == "U") ? "fw-bold" :  "fw-light"}}">Your order status updated.</span><br>
                                    <small><em>Order ID - {{$notification->order_id}} status already updated. Click to View.</em></small></a>
                                @if($loop->count > 1 && !$loop->last)
                                    <hr>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li>
                            <a class="dropdown-item" href="">
                                <small><em>You have no any notification.</em></small></a>
                        </li>
                    @endif
                </ul>
            </div>

            <a href="@if($cart_id){{ route('cart', ['id' => $cart_id]) }}@else{{ route('cart.empty') }}@endif" class="btn btn-secondary position-relative">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                @if($count_cart > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{$count_cart}}</span>
                @endif
            </a>
        </div>
    </div>
</header>
