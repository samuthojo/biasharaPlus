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
  function myDataTable(category_name) {
    table = $("#myTable").DataTable({
       dom: 'Bfrtip',
       buttons: [
           {
             extend: 'print',
             exportOptions: {
               columns: ":not(:last-child)"
             },
             title: category_name + " Products",
             messageTop: category_name + " Products As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'excel',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: category_name + " Products",
              messageTop: category_name + " Products As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'pdf',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: category_name + " Products",
              messageTop: category_name + " Products As Of {{date('d-m-Y')}}"
           }
       ],
       iDisplayLength: 8,
       bLengthChange: false
     });

    //  $("#category_id").click(function() {
    //    $(this).next().fadeOut(0);
    //  });
     //
    //  $("#edit_category_id").click(function() {
    //    $(this).next().fadeOut(0);
    //  });


     // Add event listener for opening and closing details
     $('#myTable tbody').on('click', 'td.details-control', function () {
       var tr = $("td.details-control").closest('tr');
       var row = table.row( tr );

       var product_id = row.data()[1];

       if ( row.child.isShown() ) {
           // This row is already open - close it
           row.child.hide();
           tr.removeClass('shown');
       }
       else {
         var link = "/products/" + product_id + "/product_details";
              $.getJSON(link)
               .done( function (product) {
                 row.child.hide();
                 tr.removeClass('shown');
                 row.child(format(product)).show();
                 tr.addClass('shown');
               })
               .fail( function (error) {
                 console.log(error);
               });
               row.child(format2()).show();
               tr.addClass('shown');
       }
     });

  }

</script>
