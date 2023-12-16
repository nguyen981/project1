<?php
/**
 * index.php
 *
 
 
 *
 * This file is part of tc-lib-pdf software library.
 */

// autoloader when using Composer
require ('../vendor/autoload.php');

// autoloader when using RPM or DEB package installation
//require ('/usr/share/php/Com/Tecnick/Pdf/autoload.php');

$pdf = new \Com\Tecnick\Pdf\Tcpdf();

$pdf->page->add();

$doc = $pdf->getOutPDFString();

//var_export($doc);

file_put_contents('../target/example.pdf', $doc);
