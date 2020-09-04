<script src="{{ theme_url('assets/libs/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{ theme_url('assets/libs/jquery-validate/jquery.additional-methods.min.js')}}"></script>

<script>
  function validate(id, rules) {
    $(id).validate({
      rules: rules,
      submitHandler: function (form) {
        return false;
      },
      invalidHandler: function(event, validator) {
        $('.error').parent().css('postion')
      }
    });
  }
</script>
<script>
    $(function() {

    })
</script>
