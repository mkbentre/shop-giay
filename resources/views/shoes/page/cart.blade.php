@extends('templates.shoes.master')
@section('title') Giỏ hàng @endsection
@section('content')
    <div class="cart">
        @if( Cart::count() != 0 )
            <div class="container margin-res-top" style="margin-top: 150px">
            <div class="col-sm-7 cart-content-left">
                <form action="{{route('shoes.shopping.update')}}" method="post">
                    @csrf
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                                <td>
                                    <div class="cart-product">
                                        <div class="cart-product-image">
                                            <img src="{{$urlStorage}}storage/app/products/{{$item->options->image}}" alt="">
                                        </div>
                                        <div class="cart-product-info">
                                            <p>{{$item->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{number_format($item->price)}} đ</td>
                                <td>
                                    <div class="quantity">
                                        <input type="number" value="{{$item->qty}}" onchange="qtyCart(this.value,'{{$item->rowId}}')" class="value-qty {{$item->rowId}}" maxlength="2" min="1" max="10" size="1" id="number" style="text-align: center">
                                    </div>
                                </td>
                                <td>
                                    <span id="{{$item->rowId}}">{{number_format($item->subtotal)}}</span>
                                    <a href="{{route('shoes.shopping.del',$item->rowId)}}" class="close" >
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                    <a href="{{route('shoes.shoes.index')}}" class="button-close btn btn-success" style="opacity: 1">
                        <i class="fa fa-arrow-circle-left"></i> Tiếp tục mua sản phẩm
                    </a>
                </div>
                </form>
                <script src="{{$urlPublicShoes}}js/ajax.functions.js"></script>
            </div>
            <div class="col-sm-5 cart-content-right">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Tổng tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Tổng phụ</th>
                        <td><span id="price_total">{{ Cart::priceTotal(0) }}</span> đ</td>
                    </tr>
                    <tr>
                        <th scope="row">Thuế VAT(2%)</th>
                        <td><span id="tax">{{Cart::tax(0) }}</span> đ</td>
                    </tr>
                    <tr>
                        <th scope="row">Tổng cộng</th>
                        <td><span id="total">{{ Cart::total(0) }}</span> đ</td>
                    </tr>
                    </tbody>
                </table>
                <a href="{{route('shoes.shoes.pay')}}" style="width: 100%" class="button btn btn-primary">Tiến hành thanh toán</a>
            </div>
        </div>
        @else
            <div class="container margin-res-top" style="margin-top: 150px;text-align: center">
                <h3>Giỏ hàng trống</h3>
                <a href="{{route('shoes.shoes.index')}}" class="button-close btn btn-success" style="opacity: 1">
                    <i class="fa fa-arrow-circle-left"></i> Tiếp tục mua sản phẩm
                </a>
            </div>
        @endif
    </div>
@endsection
