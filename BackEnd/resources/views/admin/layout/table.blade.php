<table class="table table-bordered border-primary" style=" text-align: center">
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">Tên Danh Mục</th>
        <th scope="col">Tùy Chọn</th>

      </tr>
    </thead>
    <tbody>
        @foreach ($items as $key=> $item)
      <tr>
        <th scope="row">{{++$key}}</th>
        <td>{{$item->name}}</td>
        <td>
            <a style='color:rgb(52,136,245)' class='btn' href=""><i class='bi bi-eye h4'></i></a>
            <a style='color:rgb(52,136,245)' class='btn' href="{{route('category.edit',$item->id)}}"><i class='bi bi-arrow-clockwise h4'></i></a>
            <a style='color:rgb(52,136,245)' class ='btn' href=""><i class='bi bi-trash h4'></i></a>
        </td>

      </tr>
      @endforeach

    </tbody>
  </table>
