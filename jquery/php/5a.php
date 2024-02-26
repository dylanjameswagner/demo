					<h2>Demo<?php echo ' '.$r.$s; ?>: Loading External Content</h2>
					<p>The initial content in <code>#demo</code> is simply instructions to use the navigation above
						to load more content.</p>
					<p>When a navigation item is clicked jQuery uses the local path from the anchor <code>href</code> and reaches out
						to that file and grabs only the portion we are looking for using the selector <code>#content > *</code>
						to get all of the children of <code>#content</code>.</p>
					<div id="demo">
						<ul id="demo_nav" class="navigation">
							<li><a href="php/5a1.php">content 1</a></li>
							<li><a href="php/5a2.php">content 2</a></li>
							<li><a href="php/5a3.php">content 3</a></li>
						</ul><!-- #demo_nav -->
						<div id="demo_content">
							<p>Select an item from the nav above to load its content.</p>
						</div><!-- #demo_content -->
					</div><!-- #demo -->
					<div id="code">
						<h2>Code</h2>
						<div id="jquery">
							<h3 class="label">jQuery</h3>
							<pre>
<em>External jQuery file not found.</em>
							</pre>
						</div><!-- #jquery -->
						<div id="xhtml">
							<h3 class="label">XHTML</h3>
							<pre>
<em>External XHTML file not found.</em>
							</pre>
						</div><!-- #xhtml -->
						<div id="css">
							<h3 class="label">CSS</h3>
							<pre>
<em>External CSS file not found.</em>
							</pre>
						</div><!-- #css -->
					</div><!-- #code -->
