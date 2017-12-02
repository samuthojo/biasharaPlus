<table id="myTable" class="table table-hover">
  <thead>
    <th>No.</th>
    <th>Name</th>
    <th>Effective Date</th>
    <th>Color</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($priceLists as $priceList)
      <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
        <td>{{$loop->iteration}}</td>
        <td>{{$priceList->name}}</td>
        <td>{{$priceList->effective_date}}</td>
        <td>{{$priceList->color}}</td>
        <td>
          <div class="btn-group">
            <button class="btn btn-warning" title="edit price-list"
              onclick="showEditPriceListModal({{$priceList}})">
              <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button class="btn btn-danger" title="delete price-list"
              onclick="showPriceListDeleteModal({{$priceList->id}})">
              <span class="glyphicon glyphicon-trash"></span>
            </button>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
</div>
<script>
$(document).ready(function () {
$("#myTable").dataTable({
  dom: 'Bfrtip',
  buttons: [
      {
        extend: 'print',
        exportOptions: {
          columns: ":not(:last-child)"
        },
        title: "PriceLists",
        messageTop: "The List Of PriceLists As Of {{date('d-m-Y')}}"
      },
       {
         extend: 'excel',
         exportOptions: {
           columns: ":not(:last-child)"
         },
         title: "PriceLists",
         messageTop: "The List Of PriceLists As Of {{date('d-m-Y')}}"
      },
       {
         extend: 'pdf',
         exportOptions: {
           columns: ":not(:last-child)"
         },
         title: "PriceLists",
         messageTop: "The List Of PriceLists As Of {{date('d-m-Y')}}"
      }
  ],
  iDisplayLength: 8,
  bLengthChange: false
});
});
</script>
