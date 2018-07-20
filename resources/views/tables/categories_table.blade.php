<table id="myTable" class="table table-hover">
  <thead>
    <th>No.</th>
    <th>Name</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($categories as $category)
    <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
      <td>{{$loop->iteration}}</td>
      <td id="{{'category_' . $category->id}}">{{$category->name}}</td>
      <td>
        <div class="btn-group" title="edit category">
          <a class="btn btn-dark" title="view products"
           href="{{url('/categories/' . $category->id . '/products')}}">
            <span class="fa fa-eye"></span>
          </a>
          <button class="btn btn-warning"
            onclick="showEditCategoryModal({{$category->id}})">
            <span class="fa fa-pencil"></span>
          </button>
          <button class="btn btn-danger" title="delete category"
            onclick="showDeleteConfirmationModal({{$category->id}})">
            <span class="fa fa-trash"></span>
          </button>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
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
              title: "Categories",
              messageTop: "The List Of Product Categories As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Categories",
               messageTop: "The List Of Product Categories As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Categories",
               messageTop: "The List Of Product Categories As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });
  });
</script>
