<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="heading"> Disclaimer</h4>
    </div>
    <div class="modal-body">
      <p> <?php $options = get_option('disclaimer_settings');
                echo $options['textarea_field'];
      ?></p>
      
    </div>
    <div class="modal-footer">
          <button type="button" class="disclamier-button">Accepts</button>
          <button type="button" class="disclamier-decline">Decline</button>
    </div>
  </div>

</div>
</body>
</html>
