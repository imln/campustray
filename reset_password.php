<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Makes "field" required having at least 3 characters.</title>
<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
 
</head>
<body>
<form id="myform">
<label for="field">Required, minimum length 3: </label>
<input type="text" class="left" id="field" name="field">
<br/>
<input type="submit" value="Validate!">
</form>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
$( "#myform" ).validate({
  rules: {
    field: {
      required: true,
      minlength: 3
    }
  }
});
</script>
</body>
</html>