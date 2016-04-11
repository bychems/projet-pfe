@extends("default")
@section('title',$title)

@section('banner')
       <div class="banner">
           <div class="container">
               <div class="col-md-3" style="text-align: center">
                   <h2>Demandes Client <br> OFFLINE </h2>
               </div>
           </div>
       </div>

@endsection
@section('content')

                                   <div class="panel panel-default">
                                       <!-- Default panel contents -->
                                       <div class="panel-heading">Nouveaux Clients</div>
                                       <!-- Table -->
                                       <table class="table">
                                           <thead>
                                           <tr>
                                               <th class="milieu">Nom</th>
                                               <th class="milieu">Pr&eacute;nom</th>
                                               <th class="milieu">Action</th>
                                           </tr>
                                           </thead>
                                           <tbody class="table_new_customer">

                                           </tbody>
                                       </table>
                                       <button class="droite save_all_customers hidden btn btn-success ">Sauvegarder tout</button>

                                   </div>


@endsection

@section('js')
<script>
   var addCustomerRoute= "{{route('addcustomerOffline')}}";
   var token ="{{ csrf_token() }}";

   $(document).ready(function(){
       getNewCustomers();
   });
</script>
@endsection

