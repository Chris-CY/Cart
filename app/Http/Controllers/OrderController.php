<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;

use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', '!=', 'P')->paginate(10);
        foreach ($orders as $order) {
            $order->status = Order::$status[$order->status];
        }

        return view('order.index', compact('orders'));
    }

    public function edit($id, Request $request)
    {
        $order = Order::find($id);

        if ($request->isMethod('post')) {
            $order->status = $request->action;
            $order->save();

            //create notification
            $notification = new Notification();
            $notification->order_id = $order->id;
            $notification->status = 'U';
            $notification->save();

            return redirect()->route('order.index')->with('success', 'Order status update successfully');
        }

        $products = $this->getOrderProduct($id);
        $order->status = Order::$status[$order->status];

        return view('order.edit', compact('order', 'products'));
    }

    public function addCart(Request $request)
    {
        $order = Order::firstOrCreate(
            ['status' => 'P']
        );

        $orderProduct = OrderProduct::where('order_id', $order->id)
            ->where('product_id', $request->id)
            ->first();

        if ($order->products()->where('id', $request->id)->exists()) {
            $order->products()->syncWithPivotValues([$request->id], ['quantity' => $orderProduct->quantity + 1], false);
        } else {
            $order->products()->attach([$request->id], ['quantity' => 1]);
        }

        return response()->json(['success' => 'Item has been added to cart.']);
    }

    public function cart($id, Request $request)
    {
        //submit order
        if ($request->isMethod('post')) {
            $order = Order::find($id);

            foreach ($request->id as $key => $ids) {
                $order->products()->syncWithPivotValues([$request->id[$key]], ['quantity' => $request->quantity[$key]], false);
            }

            $order->status = 'S';
            $order->order_date = now()->toDateTimeString();
            $order->save();
            return redirect()->route('catalogue')->with('success', 'Order successfully!');
        }

        $products = $this->getOrderProduct($id);

        return view('cart', compact('products'));
    }

    //get products with order_id
    public function getOrderProduct($order_id)
    {
        $orderProducts = OrderProduct::where('order_id', $order_id)->get();
        $productIds = $orderProducts->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            $product->quantity = $orderProducts->where('product_id', $product->id)->first()->quantity;
        }

        return $products;
    }

    public function deleteCart(Request $request)
    {
        $order = Order::find($request->cart_id);
        $order->products()->detach($request->product_id);

        return response()->json(['success' => 'Item has been deleted from cart.']);
    }
}
