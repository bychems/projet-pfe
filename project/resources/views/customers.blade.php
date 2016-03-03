
@foreach($customers as $cu)

<p>{{ $cu->name_customer }} {{ $cu->last_name_customer }}</p>

@endforeach

@foreach ($customers as $customer) *

    {{$customer->cin_customer }}

@endforeach