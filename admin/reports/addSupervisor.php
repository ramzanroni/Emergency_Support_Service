<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Compose New Message</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control" type="email" placeholder="To:" id="receiver_email">
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Subject:" id="subject">
                </div>
                <div class="mb-2 mt-2">
                  <a href="#" onclick="supervisorRegistrationLinkGenerate()" class="btn btn-info">Link Generate</a>
                </div>
                <div class="form-group">
                    <textarea id="message_body" class="form-control" style="height: 500px" placeholder="Describe your text here..."></textarea>   
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  <button type="submit" onclick="sendEmailForNewUser()"  class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>

<script>
  $(function () {
    // Summernote
    $('#message_body').summernote();
});
</script>