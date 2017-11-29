<div id="edit_price_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close"
          data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit Price</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form name="edit_price_form"
            id="edit_price_form">
            <div class="form-group">
              <label for="edit_price_list_id">PriceList:</label>
              <input type="text" class="form-control"
                id="edit_price_list_id" readonly>
              <!-- <span id="edit_pricelist_id_error"
                class="text-danger" style="display: none;"></span> -->
            </div>
            <div class="form-group">
              <label for="edit_price">Price:</label>
              <input type="text" class="form-control" name="price"
                id="edit_price" placeholder="Price">
              <span id="edit_price_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="edit_tanzania">Tanzania-Price:</label>
              <input type="text" class="form-control" name="tanzania"
                id="edit_tanzania" placeholder="Tanzania Price">
              <span id="edit_tanzania_price_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="edit_kenya">Kenya-Price:</label>
              <input type="text" class="form-control" name="kenya"
                id="edit_kenya" placeholder="Kenya Price">
              <span id="edit_kenya_price_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="edit_uganda">Uganda-Price:</label>
              <input type="text" class="form-control" name="uganda"
                id="edit_uganda" placeholder="Uganda Price">
              <span id="edit_uganda_price_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">Cancel</button>
              <button class="btn btn-success"
                type="button" onclick="attemptUpdatePrice()">Save</button>
              @include('inline_loader')
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
