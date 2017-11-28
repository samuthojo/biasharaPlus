<table id="myTable" class="table table-hover">
  <thead>
    <th>No.</th>
    <th>PriceList</th>
    <th>Price</th>
    <th>Tanzania-Price</th>
    <th>Kenya-Price</th>
    <th>Uganda-Price</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($prices as $price)
      <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
        <td>{{$loop->iteration}}</td>
        <td id="{{'pricelist_name_' . $price->id}}">{{$price->pricelist_name}}</td>
        <td id="{{'price_' . $price->id}}">
          {{sprintf("%s", number_format($price->price))}}
        </td>
        <td id="{{'tanzania_' . $price->id}}">
          {{sprintf("%s", number_format($price->tanzania))}}
        </td>
        <td id="{{'kenya_' . $price->id}}">
          {{sprintf("%s", number_format($price->kenya))}}
        </td>
        <td id="{{'uganda_' . $price->id}}">
          {{sprintf("%s", number_format($price->uganda))}}
        </td>
        <td>
          <div class="btn-group">
            <button class="btn btn-warning" title="update price"
              onclick="showEditPriceModal({{$price}})">
              <span class="glyphicon glyphicon-pencil"></span>
            </button>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<script>
  $(function () {
    myDataTable('{{$product->name}}');
    $(":text").keydown(function() {
      $(this).next().fadeOut(0);
    });
  });
  function myDataTable(product_name) {
    $("#myTable").dataTable({
        dom: 'Bfrtip',
        buttons: [
            {
              extend: 'print',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: product_name + "Prices",
              messageTop: product_name + " Prices As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: product_name + "Prices",
               messageTop: product_name + " Prices As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: product_name + "Prices",
               messageTop: product_name + " Prices As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });

  }
</script>
