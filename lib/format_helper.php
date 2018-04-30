<?php

/*
 * Format The Date
 */
function format_date($date){
	return date('G:i M/d/Y', strtotime($date));
}

function format_date_day($date){
	return date('j', strtotime($date));
}

function format_date_year($date){
	return date('m/Y', strtotime($date));
}

/*
 *
 */
function shortenText($text, $chars = 1600){
	$text = $text." ";
	$text = substr($text, 0, $chars);
	$text = substr($text, 0, strrpos($text, ' '));
	$text = $text."...";
	return $text;
}

function shortenTitle($text, $chars = 86){
	$text = $text." ";
	$text = substr($text, 0, $chars);
	$text = substr($text, 0, strrpos($text, ' '));
	return $text;
}