<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<x-app-layout>

</x-app-layout>


<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include("admin.css")
   
  </head>
  <body>
    
    <div class="container-scroller">
     
  	@include("admin.navbar")



  	<div  style="position: relative; top: 100px; right: -250px " >
  		
  		<table bgcolor="grey" border="4px" >
  			
  			<tr>
  				<th style="padding: 40px">Name</th>
  				<th style="padding: 40px">Email</th>
  				<th style="padding: 40px">Action</th>
  			</tr>


  			@foreach($data as $data)
  			<tr align="center">
  				<td>{{$data->name}}</td>
  				<td>{{$data->email}}</td>

  				@if($data->usertype=="0")
  				<td><a href="{{url('/deleteuser',$data->id)}}">Delete</a></td>
  				@else
  				<td><a >Not Allowed</a></td>

  				@endif




  			</tr>

  			@endforeach




  		</table>


  	</div>

   </div>

   @include("admin.script")


  </body>
</html>


</body>
</html>
