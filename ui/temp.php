<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="css/bootstrap-colorpicker.css" rel="stylesheet">
</head>
<body>
  <div class="demo">
      <h1>Bootstrap Colorpicker Demo (with Bootstrap)</h1>
      <input id="demo-input" type="text" value="rgb(255, 128, 0)" />
  </div>

  <script src="//code.jquery.com/jquery-3.4.1.js"></script>
  <script src="//unpkg.com/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/bootstrap-colorpicker.js"></script>
  <script>
    $(function () {
      // Basic instantiation:
      $('#demo-input').colorpicker();
      
      // Example using an event, to change the color of the #demo div background:
      $('#demo-input').on('colorpickerChange', function(event) {
        $('#demo').css('background-color', event.color.toString());
      });
    });
  </script>
</body>