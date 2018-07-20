<div id="{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{$title}}</h4>
        <button class="close" data-dismiss="modal">
          &times;
        </button>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="action_confirmation_form"
              id="action_confirmation_form">
              {{$text}}
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button class="btn btn-success"
                  type="button" onclick="{{$function}}">{{$action}}</button>
                @include('inline_loader')
              </div>
            </form>
          </div>
        </div>
    </div>
  </div>
</div>
