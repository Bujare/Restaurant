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

    <div style="position: relative; top: 60px; right: -150px">

        <form action="{{url('/uploadfood')}}" method="post" enctype="multipart/form-data">

            @csrf

            <div>
                <label>Title</label>
                <input type="text" name="title" placeholder="Write a title" required>
            </div>

            <div>
                <label>Price</label>
                <input type="num" name="price" placeholder="price" required>
            </div>

            <div>
                <label>Image</label>
                <input type="file" name="image" required>
            </div>

            <div>
                <input style="color: black" type="submit" value="Save" >
            </div>

        </form>

    </div>

</div>

    @include("admin.script")

 
  </body>
</html>


