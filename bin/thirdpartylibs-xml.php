#!/usr/bin/env php
<?php
/**
 * Commandline utility to output a Moodle 'thirdpartylibs.xml' file.
 *
 * @copyright Nick Freear, 15-March-2018.
 *
 * USAGE:
 *    thirdpartylibs-xml.php -L vendor node_modules another_file.php
 */

if ($argc < 2 || '-h' === $argv[ 1 ]) {
  echo "Usage:\n\tthirdpartylibs-xml.php -- vendor node_modules another_file.php\n";
  exit( 1 );
}

$template = <<<EOT
<?xml version="1.0"?>
<libraries>
%s
</libraries>
<!-- Auto-generated: %s -->

EOT;

$libraries = [];

for ($idx = 1; $idx < $argc; $idx++) {
    $param = $argv[ $idx ];
    if (preg_match('/^-/', $param)) {
        continue;
    }
    $libraries[] = sprintf('    <library><location>%s</location></library>', $param);
}

printf($template, implode("\n", $libraries), date('c'));

# End.
