					<h2>Demo<?php echo ' '.$r.$s; ?>: Forms - maxlength &amp; validate</h2>
					<p>Also see <a href="http://dylanjameswagner.com/jquery/?p=contact">Contact</a> page.</p>
					<div id="demo">
						<h3 class="labels">Contact Form</h3>
						<form id="contact_form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
							<p id="contact_name"><label for="name">Name <small>Required</small></label> <input type="text" id="name" name="name" class="name required clear"/></p>
							<p id="contact_email"><label for="email">E-mail <small>Required</small></label> <input type="text" id="email" name="email" class="email required clear"/></p>
							<p id="contact_phone"><label for="phone">Phone</label> <input type="text" id="phone" name="phone" class="phone clear"/></p>
							<p id="contact_subject"><label for="subject">Area of Inquiry</label>
								<select id="subject" name="subject">
									<option value="General Inquiry">General Inquiry</option>
									<option value="Web Design">Web Design</option>
									<option value="Graphic Design">Graphic Design</option>
									<option value="Identity Design">Identity Design</option>
								</select></p>
							<p id="contact_message"><label for="message">Message <small>Required</small></label> <textarea id="message" name="message" class="message maxlength required clear" cols="40" rows="12"></textarea></p>
							<p id="contact_submit"><input type="submit" name="submit" value="Send"/></p>
						</form><!-- #contact_form -->
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
