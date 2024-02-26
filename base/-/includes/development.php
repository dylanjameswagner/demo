<?php /* development.php */

/*
	switch ($_SERVER['HTTP_HOST']):
		case 'domain.tld': // lIVE
			define('HOST_NAME'	,'live');
			define('HOST_URL'	,'domain.tld');
			define('DOC_ROOT'	,$_SERVER['DOCUMENT_ROOT']);
			break;
		case 'dev.domain.tld': // dev
			define('HOST_NAME'	,'dev');
			define('HOST_URL'	,'dev.domain.tld');
			define('DOC_ROOT'	,$_SERVER['DOCUMENT_ROOT']);
			break;
		default: // local
			define('HOST_NAME'	,'local');
			define('HOST_URL'	,'localhost');
			define('HOST_URL'	,'/Library/WebServer/');
			define('DOC_ROOT'	,__DIR__); // $_SERVER['DOCUMENT_ROOT'].substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'/')));
			break;
	endswitch;
*/

	$host = $_SERVER['HTTP_HOST'];

?>
	<div id="development">

		<p class="actions">
			<span class="fl">
				<a class="toggle" href="javascript:;">[<span>+</span><span>-</span>]</a>
				<a class="button reload" href="<?php echo $base.$path; ?>/">Reload</a>
				<a class="button switch" href="//<?php echo (strpos($host,'dev.') !== false ? str_replace('dev.','',$host) : 'dev.'.$host).$base.$path; ?>/">Switch</a>
			</span>
			<span class="fr">
				<span<?php active('kitchen-sink'); ?>><a class="button" href="<?php base(); ?>/kitchen-sink/">Kitchen Sink</a></span>
				<span<?php active('admin'); ?>><a class="button" href="<?php base(); ?>/admin/">Admin</a></span>
				<span<?php active('error'); ?>><a class="button" href="<?php base(); ?>/test/">Error</a></span>
			</span>
		</p><!--.actions-->

		<div class="information">

			<table class="jc"><tr>
				<td>W <span class="width">0</span></td>
				<td>H <span class="height">0</span></td>
				<td>V <span class="viewport">0</span></td>
				<td>S <span class="scroll">0</span></td>
			</tr></table>

			<table>
				<tr><th>root</th>		<td><?php echo $_SERVER['DOCUMENT_ROOT']; ?></td></tr>
				<tr><th>real</th>		<td><?php echo realpath($_SERVER['DOCUMENT_ROOT']); ?></td></tr>
				<tr><th>self</th>		<td><?php echo $_SERVER['PHP_SELF']; ?></td></tr>
				<tr><th>dir</th>		<td><?php echo dirname($_SERVER['PHP_SELF']); ?></td></tr>
				<tr><th>base</th>		<td><?php base(); ?></td></tr>
				<tr><th>file 1</th>		<td><?php echo basename($_SERVER['PHP_SELF']); ?></td></tr>
				<tr><th>file 2</th>		<td><?php echo basename($_SERVER['PHP_SELF'],'.php'); ?></td></tr>
			</table>

			<table>
				<tr><th>path</th>			<td><?php echo $path; ?></td></tr>
				<tr><th>pageID</th>			<td><?php echo pageID(); ?></td></tr>
				<tr><th>pageClass</th>		<td><?php echo pageClass(); ?></td></tr>
				<tr><th>pageTitle</th>		<td><?php echo pageTitle($pageTitle); ?></td></tr>
				<tr><th>pageName</th>		<td><?php echo pageName($pageTitle); ?></td></tr>
				<tr><th>pageAncestors</th>	<td><?php echo implode(',',$pageAncestors); ?></td></tr>
			</table>

			<table>
				<tr><th>userID</th>			<td><?php echo $_SESSION['userID']; ?></td></tr>
				<tr><th>userRole</th>		<td><?php echo $_SESSION['userRole']; ?></td></tr>
				<tr><th>userName</th>		<td><?php echo $_SESSION['userName']; ?></td></tr>
				<tr><th>userURL</th>		<td><?php echo $_SESSION['userURL']; ?></td></tr>
				<tr><th>userMessage</th>	<td><?php echo $_SESSION['userMessage']; ?></td></tr>
			</table>

		</div><!--.information-->

	</div><!--#development-->
