<table id="myTable" class="table table-hover">
  <thead>
    <th></th>
    <th style="display: none;"></th>
    <th>No.</th>
    <th>Name</th>
    <th>Category</th>
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
        <td id="{{'product_name_' . $product->id}}">{{$product->name}}</td>
        <td id="{{'category_name_' . $product->id}}">{{$product->category_name}}</td>
        <td id="{{'product_code_' . $product->id}}">{{$product->code}}</td>
        <td id="{{'product_cc_' . $product->id}}">{{$product->cc}}</td>
        <td>
          <div class="btn-group">
            <a class="btn btn-default" title="view prices"
              href="{{url('/products/' . $product->id . '/prices')}}">
              <span class="glyphicon glyphicon-eye-open"></span>
            </a>
            <button class="btn btn-warning" title="edit product"
              onclick="showEditProductModal({{$product->id}})">
              <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button class="btn btn-danger" title="delete product"
              onclick="showProductDeleteModal({{$product->id}})">
              <span class="glyphicon glyphicon-trash"></span>
            </button>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<script>
$(document).ready( function() {
  callMe();
});
</script>
