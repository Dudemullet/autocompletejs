<?php
$page_title = 'Home';
$active_nav_tab = 'Home';
include(APP_PATH . 'pages/header.php');
?>

<div class="row section">
  <div class="ten columns">
    <div id="awesome"></div>
  </div>
  <div class="two columns">
    <input type="button" class="button radius demo-btn" id="runAgainBtn" value="Run Again" style="display:none" />
  </div>
</div>

<div class="section">
<h2>Usage</h2>
<h4>Code:</h4>
<pre class="prettyprint">
&lt;div id="search_bar"&gt;&lt;/div&gt;
&lt;script src="jquery.js"&gt;&lt;/script&gt;
&lt;script src="autocomplete.js"&gt;&lt;/script&gt;
&lt;script&gt;
var widget = new AutoComplete('search_bar', ['Apple', 'Banana', 'Orange']);
&lt;/script&gt;
</pre>
<h4>Result:</h4>
<div id="search_bar"></div>
</div>

<div class="section">
<h2>Get It</h2>
<a class="button large radius" href="releases/0.1.0/autocomplete-0.1.0.zip">Download Most Recent Version</a>
</div>

<script src="js/json3.min.js"></script>
<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/prettify.js"></script>
<script src="js/autocomplete.js"></script>
<script>
var init = function() {

var options1 = [
  'the best!',
  'so sweet.',
  'wonderful!!!',
  {
    children: 'options2',
    value: 'better than'
  }
];

var options2 = [
  'your middle school dance.',
  'sliced bread.',
  'your grammy, your aunty, your momma, your mammy.',
  'Ezra.',
  'a cupcake!'
];

var config = {
  tokenSeparatorHTML: '',
  initialList: 'subject',
  lists: {
    subject: [{
      children: 'options1',
      value: 'AutoCompleteJS is'
    }],
    options1: options1,
    options2: options2
  }
};
var awesome = new AutoComplete('awesome', config);

var getRandomInt = function(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

var createRandomPath = function() {
  var actions = [
    function() { $('#runAgainBtn').css('display', 'none'); },
    function() { awesome.setInput('a'); },
    function() { awesome.setInput('au'); },
    function() { awesome.setInput('aut'); },
    function() { awesome.setInput('auto'); },
    function() { awesome.pressEnter(); }
  ];

  // give it a slightly higher chance of hitting the last option
  var opt1Index = getRandomInt(0, options1.length + 1);
  if (opt1Index >= options1.length) {
    opt1Index = options1.length - 1;
  }
  if (opt1Index === 0) {
    actions.push(function() {});
  }
  for (var i = 0; i < opt1Index; i++) {
    actions.push(function() { awesome.pressDown(); });
  }

  if (options1[opt1Index].hasOwnProperty('children') === true) {
    actions.push(function() { awesome.pressEnter(); });

    var opt2Index = getRandomInt(0, options2.length - 1);
    for (var i = 0; i < opt2Index; i++) {
      actions.push(function() { awesome.pressDown(); });
    }
  }

  actions.push(
    function() {
      awesome.pressEnter();
      awesome.blur();
    },
    function() { $('#runAgainBtn').fadeIn('fast'); }
  );

  return actions;
};

var go = function() {
  var actions = createRandomPath();
  var interval = 500;
  for (var i = 0; i < actions.length; i++) {
    setTimeout(actions[i], i * interval);
  }
};

$('#runAgainBtn').on('click', go);
setTimeout(go, 500);
prettyPrint();
var widget = new AutoComplete('search_bar', ['Apple', 'Banana', 'Orange']);

}; // end init()
$(document).ready(init);
</script>
<?php
include(APP_PATH . 'pages/footer.php');
?>