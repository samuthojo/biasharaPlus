<div id="add_price_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close"
          data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Add Price</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form name="add_price_form"
            id="add_price_form">
            <div class="form-group">
              <label for="price_list_id">PriceList:</label>
              <select class="form-control" name="price_list_id"
                id="price_list_id" style="width: 180px">
                <option value="" selected disabled>choose pricelist</option>
                @foreach($pricelists as $pricelist)
                  <option value="{{$pricelist->id}}">{{$pricelist->name}}</option>
                @endforeach
              </select>
              <span id="pricelist_id_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="tanzania">Tanzania-Price:</label>
              <input type="text" class="form-control" name="tanzania"
                id="tanzania" placeholder="Tanzania Price">
              <span id="tanzania_price_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="kenya">Kenya-Price:</label>
              <input type="text" class="form-control" name="kenya"
                id="kenya" placeholder="Kenya Price">
              <span id="kenya_price_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="uganda">Uganda-Price:</label>
              <input type="text" class="form-control" name="uganda"
                id="uganda" placeholder="Uganda Price">
              <span id="uganda_price_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">Cancel</button>
              <button class="btn btn-success"
                type="button" onclick="addPrice()">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
