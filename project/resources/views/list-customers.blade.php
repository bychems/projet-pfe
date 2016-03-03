@extends("default")
@section('title',$title)

@section('content')
<style>
    h3{
        background: #F5F5F5;
        border-radius: 7px;
        padding: 10px 20px;
        font-size: 17px !important;
        text-transform: uppercase;
        border: 1px solid rgba(221, 221, 221, 0.86);
        margin-top: 35px !important;
    }
    .dddd {
        background: red;
    }
    .rows .row {
        margin-bottom: 20px;
    }
    .hidden{
        display: none;
    }
    p{
        padding:6px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: #f5f5f5;
    }
</style>

<h1>Clients</h1>
<ul>
    @foreach($customers as $customer)
    @if(!empty($customer->name))
    <li><a href="{{route('afficheCustomer', $customer->id)}}">{{ $customer->name }} {{$customer->last_name}}</a></li>
    @endif
    @endforeach

</ul>
@stop