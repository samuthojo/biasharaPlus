<div id="edit_product_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close"
          data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          @include('errors')
          <form name="edit_product_form" 
            id="edit_product_form">
            <div class="form-group">
              <label for="edit_category_id">Category</label>
              <select class="form-control" name="category_id"
                id="edit_category_id" style="width: 180px">
                <option value="" selected disabled>choose category</option>
                @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="edit_product_name">Name:</label>
              <input type="text" class="form-control" name="name"
                id="edit_product_name" placeholder="product name">
            </div>
            <div class="form-group">
              <label for="edit_product_code">Code:</label>
              <input type="text" class="form-control" name="code"
                id="edit_product_code" placeholder="product code">
            </div>
            <div class="form-group">
              <label for="edit_product_cc">CC:</label>
              <input type="text" class="form-control" name="cc"
                id="edit_product_cc" placeholder="product cc">
            </div>
            <div class="form-group">
              <label for="edit_product_description">Description:</label>
              <textarea name="description" id="edit_product_description"
                class="form-control" placeholder="product description"
                rows="3" style="width: 180px"></textarea>
            </div>
            <div class="form-group">
              <label for="edit_product_image">Replace Picture:</label>
              <input type="file" name="image" id="edit_product_image">
            </div>
            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">Cancel</button>
              <button class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
