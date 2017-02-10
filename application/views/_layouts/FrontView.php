<?php
echo doctype('html5') . "\n";
echo '<html lang="en">' . "\n";
echo open_head();
echo '<title>' . ucfirst($this->title) . ' ' . (! empty($this->page) ? '| ' . $this->page : null) . '</title>' . "\n";

if ($cssData): echo $cssData; endif;

echo link_js('assets/js/ace-extra.min.js');

echo close_head();

echo "<body class='no-skin'>\n";

if ($header): echo $header; endif;

echo '<div class="main-container ace-save-state" id="main-container">';
echo '<script type="text/javascript">
				try{ace.settings.loadState(\'main-container\')}catch(e){}
			</script>';

if ($leftMenu): echo $leftMenu; endif;

if ($breadcrumb): echo $breadcrumb; endif;

if ($content): echo $content; endif;

if ($footer): echo $footer; endif;

echo '</div>';

if ($jsData): echo $jsData; endif;

echo "</body>\n";
echo "</html>";
