@extends("default")
@section('title',$title)

@section('content')


<h1>Clients</h1>
<ul>

    @foreach($customers as $customer)
        @if(!empty($customer->name))
            <li><a href="{{route('afficheCustomer', $customer->id)}}">{{ $customer->name }} {{$customer->last_name}}</a></li>
        @endif
    @endforeach

</ul>
@stop