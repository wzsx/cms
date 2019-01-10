@extends('layouts.bst')

@section('content')
    <div class="container">
        <h3>未支付订单：</h3>
        <ul>
            @foreach($list as $k=>$v)
                <li>订单ID: {{$v['order_sn']}} --  订单总价：¥{{$v['order_amount'] / 100}}   --  下单时间：{{date('Y-m-d H:i:s',$v['add_time'])}}
                    <a href="/pay/o/{{$v['oid']}}" class="btn btn-info">去支付</a><br><br>
                </li>
            @endforeach
        </ul>
    </div>
@endsection