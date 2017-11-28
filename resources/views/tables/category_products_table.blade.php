<table id="myTable" class="table table-hover">
  <thead>
    <th></th>
    <th style="display: none;"></th>
    <th>No.</th>
    <th>Name</th>
    <th>Code</th>
    <th>CC</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($products as $product)
      <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
        <td class="details-control" title="view more"></td>
        <td style="display: none;">{{$product->id}}</td>
        <td>{{$loop->iteration}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->code}}</td>
        <td>{{$product->cc}}</td>
        <td>
          <div class="btn-group">
            <a class="btn btn-default" title="view prices"
              href="{{url('/categories/' . $category->id . '/products/' . $product->id . '/prices')}}">
              <span class="glyphicon glyphicon-eye-open"></span>
            </a>
            <button class="btn btn-warning" title="edit product"
              onclick="showEditProductsModal({{$product->id}})">
              <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button class="btn btn-danger" title="delete product"
              onclick="showProductsDeleteModal({{$product->id}})">
              <span class="glyphicon glyphicon-trash"></span>
            </button>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<script>
  $(function() {
    myDataTable('{{$category->name}}');
    $(":text").keydown(function() {
      $(this).next().fadeOut(0);
    });
  });
</script>
