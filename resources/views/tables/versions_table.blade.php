<table id="myTable" class="table table-hover">
  <thead>
    <th></th>
    <th style="display: none;"></th>
    <th>No.</th>
    <th>Version</th>
    <th>Status</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($versions as $version)
      <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
        <td class="details-control" title="view more"></td>
        <td style="display: none;">{{$version->id}}</td>
        <td>{{$loop->iteration}}</td>
        <td>{{$version->version_number}}</td>
        <td>{{($version->status) ? 'Current' : 'Old'}}</td>
        <td>
          <div class="btn-group">
            <button class="btn btn-warning" title="edit product"
              onclick="showEditVersionModal({{$version}})">
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
           title: "Versions",
           messageTop: "The List Of Versions As Of {{date('d-m-Y')}}"
         },
          {
            extend: 'excel',
            exportOptions: {
              columns: ":not(:last-child)"
            },
            title: "Versions",
            messageTop: "The List Of Versions As Of {{date('d-m-Y')}}"
         },
          {
            extend: 'pdf',
            exportOptions: {
              columns: ":not(:last-child)"
            },
            title: "Versions",
            messageTop: "The List Of Versions As Of {{date('d-m-Y')}}"
         }
     ],
     iDisplayLength: 8,
     bLengthChange: false
   });

   $(":text").keydown(function() {
     $(this).next().fadeOut(0);
   });

   $("textarea").keydown(function() {
     $(this).next().fadeOut(0);
   });

   // Add event listener for opening and closing details
   $('#myTable tbody').on('click', 'td.details-control', function () {
     var tr = $(this).closest('tr');
     var row = table.row( tr );

     var version_id = row.data()[1];

     if ( row.child.isShown() ) {
         // This row is already open - close it
         row.child.hide();
         tr.removeClass('shown');
     }
     else {
       var link = "/versions/" + version_id + "/version_details";
            $.getJSON(link)
             .done( function (version) {
               row.child.hide();
               tr.removeClass('shown');
               row.child(format(version)).show();
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
