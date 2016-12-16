					<h2>Demo<?php echo ' '.$r.$s; ?>: Title Attribute Replacement</h2>
					<p>An element's <code>title</code> attribute is displayed by most browsers as a simple tooltip
						only available under specific conditions and only when the coursor is static. These tooltips
						are outside a web designer's styling ability.</p>
					<p>For elements that have a <code>title</code> attribute we store the <code>title</code> information
						and then remove the attribute from the element.</p>
					<p>Once we have the information we create a paragraph to contain it and attach the paragraph to
						the original element. This paragraph can be styled however we wish.</p>
					<div id="demo">
						<p class="fr"><img src="img/browsers/256/firefox.png" alt="Mozilla Firefox" title="Image: Hello, this is the title text. :)"/></p>
						<form action="" class="fl" title="Form: Hello, this is the title text. :)">
							<fieldset>
								<legend>Form Legend</legend>
								<label>Text Input <input type="text"/></label>
							</fieldset>
						</form>
						<table class="fl" title="Table: Hello, this is the title text. :)">
							<thead><tr>
								<td>Column A</td>
								<td>Column B</td>
								<td>Column C</td>
							</tr></thead>
							<tfoot><tr>
								<td colspan="3">footer text</td>
							</tr></tfoot>
							<tbody><tr>
								<td>cell 1</td>
								<td>cell 2</td>
								<td>cell 3</td>
							</tr>
							<tr>
								<td>cell 4</td>
								<td>cell 5</td>
								<td>cell 6</td>
							</tr>
							<tr>
								<td>cell 7</td>
								<td>cell 8</td>
								<td>cell 9</td>
							</tr></tbody>
						</table>
						<p class="fcl">This is a paragraph. The <a href="#" title="Anchor: Hello, this is the title text. :)">anchor</a> in this sentence has a title attribute.</p>
						<p class="fc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</p>
						<p>Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.</p>
						<p>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</p>
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
