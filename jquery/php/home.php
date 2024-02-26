					<h2>Common Structure</h2>
					<p>Each demo section contains three subdemos that share similarities. Every demo is contained
						inside a <code>&lt;div&gt;</code> with an ID of <code>demo</code>.</p>
					<p>The majority of general styling is done by the site wide style sheets, however where demo specific
						styles are needed they will be linked from an external <code>css</code> file. Some demos use third-party
						jQuery plugins that have their own <code>css</code> files. When used they will be linked in the demo description.</p>
					<p>jQuery relies on triggered events to run, when a button or element is required to trigger an
						event and serves no other purpose it will be included in the code using jQuery, applied a class of <code>insert</code>,
						and styled in <span class="insert">green</span> for identification.</p>
					<div id="code">
						<h2>Code</h2>
						<p>All demo specific code will be displayed in this section. Each part exists in an external with a file name that corrisponds to the demo.</p>
						<div id="jquery">
							<h3 class="label">jQuery</h3>
							<pre>
// select all anchors, add a click event listener
$('#demo a').click(function() {
	// do something
});
							</pre>
						</div><!-- #jquery -->
						<div id="xhtml">
							<h3 class="label">XHTML</h3>
							<pre>
<?php echo htmlentities('<div id="demo">
	<h2>demo 1a</h2>
	<p>[demo content]</p>
</div><-- #demo -->
'); ?>
							</pre>
						</div><!-- #xhtml -->
						<div id="css">
							<h3 class="label">CSS</h3>
							<pre>
#demo a {
	text-decoration: none;
	color: #ccc;
	}
#demo a:hover,
#demo a:active {
	text-decoration: none;
	color: #bf7326;
	}
							</pre>
						</div><!-- #css -->
					</div><!-- #code -->
