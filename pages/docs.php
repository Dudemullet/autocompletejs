<?php
$page_title = 'Documentation';
$active_nav_tab = 'Docs';
include(APP_PATH . 'pages/header.php');
$examples = AC::getExamples();
$docs = AC::getDocs();
?>

<div class="section">
<h2 id="config_object">AutoComplete Config Object</h2>
<p>The Config Object initializes the AutoComplete widget.</p>
<table cellspacing="0">
<thead>
<tr>
  <th>Property / Type</th>
  <th>Required</th>
  <th>Default</th>
  <th>Description</th>
  <th>Example</th>
</tr>
</thead>
<tbody>
<?php
foreach($docs['Config Object'] as $prop) {
  if (is_array($prop) !== true) continue;
  echo buildPropRow('config_object', $prop, $examples);
}
?>
</tbody>
</table>
</div><!-- end div.section -->

<hr class="divider" />

<div class="section">
<h2 id="list_object">List Object</h2>
<div class="panel etymology">
  <div class="word">list</div>
  <div class="part-of-speech">Noun</div>
  <div class="definition">A number of connected items or names written or printed consecutively, typically one below the other.</div>
</div>
<p>List Objects are the heart and soul of the AutoComplete widget. They define the options available to the user when they are typing.</p>
<p>The options for a List Object can be sourced directly in the JavaScript or externally with AJAX.</p>
<p>You can define the list workflow using the <code class='js plain'>children</code> property on List Objects.</p>
<table cellspacing="0">
<thead>
<tr>
  <th>Property / Type</th>
  <th>Required</th>
  <th>Default</th>
  <th>Description</th>
  <th>Example</th>
</tr>
</thead>
<tbody>
<?php
foreach($docs['List Object'] as $prop) {
  if (is_array($prop) !== true) continue;
  echo buildPropRow('list_object', $prop, $examples);
}
?>
</tbody>
</table>
</div><!-- end div.section -->

<hr class="divider" />

<div class="section">
<h2 id="option_object">Option Object</h2>
<div class="panel etymology">
  <div class="word">option</div>
  <div class="part-of-speech">Noun</div>
  <div class="definition">A thing that is or may be chosen.</div>
</div>
<p>Option Objects are the "meat" of the AutoComplete widget. They are the options displayed to the user as they type.</p>
<p>You can define the list workflow using the <code class='js plain'>children</code> property on Option Objects.</p>
<table cellspacing="0">
<thead>
<tr>
  <th>Property / Type</th>
  <th>Required</th>
  <th>Default</th>
  <th>Description</th>
  <th>Example</th>
</tr>
</thead>
<tbody>
<?php
  foreach($docs['Option Object'] as $prop) {
  if (is_array($prop) !== true) continue;
  echo buildPropRow('option_object', $prop, $examples);
}
?>
</tbody>
</table>
</div><!-- end div.section -->

<hr class="divider" />

<div class="section">
<h2 id="token_object">Token Object</h2>
<div class="panel etymology">
  <div class="word">token</div>
  <div class="part-of-speech">Noun</div>
  <div class="definition">A thing serving as a visible or tangible representation of something abstract.</div>
</div>
<p>Token Objects are what is stored on the search bar when a user selects an option from the dropdown menu.</p>
<p>A Token Group is an array of Token Objects.</p>
<p>The value of the search bar is an array of Token Groups.</p>
<p>Token Objects are not explicitly defined in the AutoComplete config; they are created from an Option Object using the <a href="docs#option_object:value"><code class="js plain">option.value</code></a> and <a href="docs#option_object:tokenHTML"><code class="js plain">option.tokenHTML</code></a> properties.</p>
<p>You can use a string as shorthand for a Token Object when using the <a href="docs#methods:setValue"><code class="js plain">setValue</code></a> method.</p>
<table cellspacing="0">
<thead>
<tr>
  <th>Property / Type</th>
  <th>Required</th>
  <th>Default</th>
  <th>Description</th>
  <th>Example</th>
</tr>
</thead>
<tbody>
<?php
foreach($docs['Token Object'] as $prop) {
  if (is_array($prop) !== true) continue;
  echo buildPropRow('token_object', $prop, $examples);
}
?>
</tbody>
</table>
</div><!-- end div.section -->

<hr class="divider" />

<div class="section">
<h2 id="methods">AutoComplete Methods</h2>
<p>Each AutoComplete object has methods you can use to interact with the widget.</p>
<table cellspacing="0">
<thead>
<tr>
  <th>Method</th>
  <th>Args</th>
  <th>Description</th>
  <th>Example</th>
</tr>
</thead>
<tbody>
<?php
foreach($docs['Methods'] as $method) {
  if (is_array($method) !== true) continue;
  echo buildMethodRow($method, $examples);
}
?>
</tbody>
</table>
</div><!-- end div.section -->

<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery.color.min.js"></script>
<script>
var flashRow = function(id) {
  var el = $(document.getElementById(id));
  var bgColor = el.css('background-color');
  el.css('background-color', '#ffff99')
    .animate({backgroundColor: bgColor}, 2000);
};

var isRow = function(id) {
  return id.search(/\:/) !== -1;
};

var clickAnchor = function(e) {
  var id = $(this).attr('href').replace(/docs#/, '');
  if (isRow(id) === true) {
    flashRow(id);
  }
};

var init = function() {
  $('body').on('click', 'a', clickAnchor);

  // give it just a smidge more time to load
  setTimeout(function() {
    if (isRow(window.location.hash) === true) {
      flashRow(window.location.hash.replace('#', ''));
    }
  }, 150);
};

$(document).ready(init);
</script>

<?php
include(APP_PATH . 'pages/footer.php');

//------------------------------------------------------------------------------
// Functions
//------------------------------------------------------------------------------

// NOTE: I know the spaces and linebreaks here are annoying and unnecessary
//       I'm optimizing for "View Source"

function buildPropRow($propType, $prop, $examples) {
  $html = '';

  // table row
  $html .= '<tr id="'.$propType.':'.$prop['name'].'">'."\n";

  // property and type
  $html .= '  <td>'."\n";
  $html .= buildPropertyAndType($prop['name'], $prop['type']);
  $html .= '  </td>'."\n";

  // required
  $html .= '  <td class="center">'.buildReq($prop['req']).'</td>'."\n";

  // default
  if (array_key_exists('leftAlignDefault', $prop) === true) {
    $html .= '  <td>'.buildDefault($prop['default']).'</td>'."\n";
  }
  else {
    $html .= '  <td class="center">'.buildDefault($prop['default']).'</td>'."\n";
  }

  // description
  $html .= '  <td>'."\n";
  $html .= buildDesc($prop['desc']);
  $html .= '  </td>'."\n";

  // examples
  $html .= '  <td>'."\n";
  $html .= buildExample($prop['examples'], $examples);
  $html .= '  </td>'."\n";

  $html .= '</tr>'."\n";

  return $html;
}

function buildMethodRow($method, $examples) {
  $nameNoParens = preg_replace('/\(.+$/', '', $method['name']);

  $html = '';

  // table row
  if (array_key_exists('noId', $method) === true) {
    $html .= "<tr>\n";
  }
  else {
    $html .= '<tr id="methods:'.$nameNoParens.'">'."\n";
  }

  // name
  $html .= '  <td><code class="js plain">'.$method['name'].'</code></td>'."\n";

  // args
  if (array_key_exists('args', $method) === true) {
    $html .= '  <td>'."\n";
    foreach ($method['args'] as $arg) {
      $html .= '    <p><code class="js plain">'.$arg[0].'</code> - '.$arg[1].'</p>'."\n";
    }
    $html .= '  </td>'."\n";
  }
  else {
    $html .= '  <td><small>none</small></td>'."\n";
  }

  // description
  $html .= '  <td>'."\n";
  $html .= buildDesc($method['desc']);
  $html .= '  </td>'."\n";

  // examples
  $html .= '  <td>'."\n";
  $html .= buildExample($method['examples'], $examples);
  $html .= '  </td>'."\n";

  $html .= "</tr>\n";

  return $html;
}

function getExampleByNumber($number, $examples) {
  $number = (int) $number;
  foreach ($examples as $ex) {
    if (intval($ex['number'], 10) === $number &&
        $ex['js'] !== '') {
      return $ex;
    }
  }
  return false;
}

function buildPropertyAndType($name, $type) {
  $html  = '    <p><code class="js plain">'.$name.'</code></p>'."\n";
  $html .= '    <p>'.buildType($type).'</p>'."\n";
  return $html;
}

function buildType($type) {
  if (is_array($type) !== true) {
    $type = array($type);
  }

  $html = '';
  for ($i = 0; $i < count($type); $i++) {
    if ($i !== 0) {
      $html .= ' <small>or</small><br />';
    }
    $html .= $type[$i];
  }

  return $html;
}

function buildReq($req) {
  if ($req === false) {
    return 'no';
  }
  if ($req === true) {
    return 'yes';
  }
  return $req;
}

function buildDesc($desc) {
  if (is_array($desc) !== true) {
    $desc = array($desc);
  }
  $html = '';
  foreach ($desc as $d) {
    $html .= '    <p>'.$d.'</p>'."\n";
  }
  return $html;
}

function buildDefault($default) {
  if ($default === false) {
    return '<small>n/a</small>';
  }
  return $default;
}

function buildExample($ex, $allExamples) {
  if (is_array($ex) !== true) {
    $ex = array($ex);
  }

  $html = '';
  foreach ($ex as $exNum) {
    $example = getExampleByNumber($exNum, $allExamples);
    if ($example === false) continue;

    $html .= '    <p><a href="examples#'.$exNum.'">'.$example['name'].'</a></p>'."\n";
  }
  return $html;
}

?>