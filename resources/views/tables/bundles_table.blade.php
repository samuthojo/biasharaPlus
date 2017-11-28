<table id="myTable" class="table table-hover">
  <thead>
    <th>No.</th>
    <th>Name</th>
    <th>Price</th>
    <th>Duration (months)</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($bundles as $bundle)
      <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
        <td>{{$loop->iteration}}</td>
        <td>{{$bundle->name}}</td>
        <td>
          {{sprintf('%s', number_format($bundle->price))}}
        </td>
        <td>
          {{$bundle->duration_in_months}}
        </td>
        <td>
          <div class="btn-group">
            <button class="btn btn-warning" title="edit bundle"
              onclick="showEditBundleModal({{$bundle}})">
              <span class="glyphicon glyphicon-pencil"></span>
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

function callMe() {
  table = $("#myTable").DataTable({
     dom: 'Bfrtip',
     buttons: [
         {
           extend: 'print',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "Bundles",
           messageTop: "The List Of Bundles As Of {{date('d-m-Y')}}"
         },
          {
            extend: 'excel',
            exportOptions: {
              columns: ":not(:last-child)"
            },
            title: "Bundles",
            messageTop: "The List Of Bundles As Of {{date('d-m-Y')}}"
         },
          {
            extend: 'pdf',
            exportOptions: {
              columns: ":not(:last-child)"
            },
            title: "Bundles",
            messageTop: "The List Of Bundles As Of {{date('d-m-Y')}}"
         }
     ],
     iDisplayLength: 8,
     bLengthChange: false
   });

   $(":text").keydown(function() {
     $(this).next().fadeOut(0);
   });

}
</script>
