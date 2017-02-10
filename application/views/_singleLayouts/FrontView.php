<?php
echo doctype('html5') . "\n";

echo '<html lang="en">' . "\n";

echo open_head();

echo '<title>' . ucfirst($this->title) . ' ' . (! empty($this->page) ? '| ' . $this->page : null) . '</title>' . "\n";

if ($cssData): echo $cssData; endif;

echo close_head();

echo "<body class='login-layout'>\n";

if ($content): echo $content; endif;

if ($jsData): echo $jsData; endif;

echo "</body>\n";
echo "</html>";
