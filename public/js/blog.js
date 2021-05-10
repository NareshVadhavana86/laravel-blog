$(document).ready(function () {

  $('#addBlogForm').bootstrapValidator({
      message: 'This value is not valid',
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          title: {
              message: 'The title is not valid',
              validators: {
                  notEmpty: {
                      message: 'The title is required and cannot be empty'
                  },
                  stringLength: {
                      max: 255,
                      message: 'The title must be less than 255 characters long'
                  }
              }
          },
          description: {
              message: 'The description is not valid',
              validators: {
                  notEmpty: {
                      message: 'The description is required and cannot be empty'
                  },
                  stringLength: {
                      max: 65535,
                      message: 'The description must be less than 65535 characters long'
                  }
              }
          },
          image: {
              validators: {
                  notEmpty: {
                      message: 'The image is required and cannot be empty'
                  },
                  file: {
                      maxSize: 100 * 1024,
                      message: 'The image must be less than 100 kb.'
                  }
              }
          },
      }
  });

    $('#saveBtn').click(function (event) {
          event.preventDefault();
          var bootstrapValidator = $('#addBlogForm').data('bootstrapValidator');
          bootstrapValidator.validate();

          if(bootstrapValidator.isValid()) {
            var form = $('#addBlogForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: "/storeBlog",
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {
                    alert(data.message);
                    $('#addBlogForm').trigger("reset");
                },
                error: function (data) {
                    var result = JSON.parse(data.responseText);
                    alert(result.message);
                }
            });
          }
    });

});
