<?php
// Load XML file
$xml = new DOMDocument;
$xml->load('./laborator_analize.xml');

// Load XSL file
$xsl = new DOMDocument;
$xsl->load('./laborator_analize.xsl');

// Configure the transformer
$proc = new XSLTProcessor;

// Attach the xsl rules
$proc->importStyleSheet($xsl);

echo $proc->transformToXML($xml);
?>