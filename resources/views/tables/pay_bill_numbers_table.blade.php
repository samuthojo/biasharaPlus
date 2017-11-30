<table id="myTable" class="table table-hover">
  <thead>
    <th>No.</th>
    <th>Service provider</th>
    <th>Phone Number</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($numbers as $number)
      <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
        <td>{{$loop->iteration}}</td>
        <td>{{$number->service_provider}}</td>
        <td>{{$number->phone_number}}</td>
        <td>
          <div class="btn-group">
            <button class="btn btn-warning" title="edit number"
              onclick="showEditNumberModal({{$number}})">
              <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button class="btn btn-danger" title="delete number"
              onclick="showDeleteNumberModal({{$number->id}})">
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

  $(":text").keydown(function() {
    $(this).next().fadeOut(0);
  });

});

function callMe() {
  table = $("#myTable").DataTable({
     dom: 'Bfrtip',
     buttons: [
         {
           extend: 'print',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "PayBill Numbers",
           messageTop: "The List Of PayBill Numbers As Of {{date('d-m-Y')}}"
         },
          {
            extend: 'excel',
            exportOptions: {
              columns: ":not(:last-child)"
            },
            title: "PayBill Numbers",
            messageTop: "The List Of PayBill Numbers As Of {{date('d-m-Y')}}"
         },
          {
            extend: 'pdf',
            exportOptions: {
              columns: ":not(:last-child)"
            },
            title: "PayBill Numbers",
            messageTop: "The List Of PayBill Numbers As Of {{date('d-m-Y')}}"
         }
     ],
     iDisplayLength: 8,
     bLengthChange: false
   });

}
</script>
