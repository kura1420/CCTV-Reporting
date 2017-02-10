<?php
// print_r($loadJs);
foreach ($loadJs as $v) {
  if (is_array($v)) {
    foreach ($v as $r) {
      if (is_array($r)) {
        foreach ($r as $a) { echo $a; }
      } else {
        echo link_js($r);
      }
    }
  }
}
