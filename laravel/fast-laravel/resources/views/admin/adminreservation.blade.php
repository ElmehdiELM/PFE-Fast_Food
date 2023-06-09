<x-app-layout>


</x-app-layout>


<!DOCTYPE html>
<html lang="en">
  <head>
  @include("admin.admincss")
  </head>
  <body>
  <div class='container-scroller'>


  @include("admin.navbar")



  <div >

  <table bgcolor="grey" border="1px">
    <tr>
        <th style='padding: 35px'>Name</th>
        <th style='padding: 35px'>email</th>
        <th style='padding: 35px'>phone</th>
        <th style='padding: 35px'>date</th>
        <th style='padding: 35px'>Time</th>
        <th style='padding: 35px'>Message</th>
    </tr>
    @foreach($data as $data)

    <tr align="center">

        <td>{{$data->name}}</td>
        <td>{{$data->email}}</td>
        <td>{{$data->phone}}</td>
        <td>{{$data->date}}</td>
        <td>{{$data->time}}</td>
        <td>{{$data->massage}}</td>
     
    </tr>
    @endforeach
  </table>
</div>

</div>
  @include("admin.adminscript")
   
  </body>
</html>
