<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php echo $example['name']; ?> Example</title>
  <base href="<?php echo BASE_URL; ?>" />
  <link type="text/css" rel="stylesheet/less" href="css/autocomplete.less" />
  <script src="css/less-1.3.0.min.js"></script>
</head>
<body>
<p><a href="examples#<?php echo $example['number']; ?>">&larr; Back to all examples.</a></p>
<p><a href="examples/<?php echo $example['number']; ?>.js">See the code for this example.</a></p>

<!--- start example code --->
<?php echo $example['html'] . "\n"; ?>
<!--- end example code --->

<script src="js/json3.min.js"></script>
<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/autocomplete.js"></script>
<script>
var init = function() {

//--- start example code ---
<?php echo $example['js'] . "\n"; ?>
//--- end example code ---

}; // end init()
$(document).ready(init);
</script>
</body>
</html>