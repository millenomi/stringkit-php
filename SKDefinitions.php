<?php

// Encoding names
define ('kSKEncoding_ISOLatin1', 'ISO-8895-1');
define ('kSKEncoding_ASCII', 'ASCII');
define ('kSKEncoding_UTF8', 'UTF-8');

// This option says that the string is assumed to contain no character
// above 127 when constructing a SKISOLatin1ConstantString().
define ('kSKConstantStringIsASCII', 1 << 0);

// Produces an ASCII constant string.
// Constant = we don't check it for correctness.
function SKStr($a) {
	return new SKISOLatin1ConstantString($a, kSKConstantStringIsASCII);
}

// Produces a Latin 1 constant string.
// Constant = we don't check it for correctness.
function SKStr_Latin1($a) {
	return new SKISOLatin1ConstantString($a, 0);
}

function _SKDebugCodePointsAsArray($s) {
	$cp = array();
	$x = $s->iterator();
	while ($x->hasNext())
		$cp[] = $x->next();
	return $cp;
}

function _SKDebugDumpCodePoints($s) {
	var_dump(_SKDebugCodePointsAsArray($s));
}