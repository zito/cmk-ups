<?php
# Template:	check_mk-ups_output.freq.php
# Author:	vaclav.ovsik@gmail.com
#
# DS
# 	1	Frequency
#
$_WARNRULE = '#FFFF00';
$_CRITRULE = '#FFA0A0';
#
#

$ds_name[1] = "Output Frequency";
$opt[1] = "--vertical-label 'Hz' --title \"$hostname / $servicedesc\" ";

$def[1] = "DEF:f=$RRDFILE[1]:$DS[1]:AVERAGE ";
$def[1] .= "LINE:f#050:\"output frequency\" ";
$def[1] .= "GPRINT:f:LAST:\"%2.1lfHz last\" ";
$def[1] .= "GPRINT:f:MIN:\"%2.1lfHz min\" ";
$def[1] .= "GPRINT:f:MAX:\"%2.1lfHz max\" ";
foreach ( array($WARN[1], $WARN_MIN[1], $WARN_MAX[1]) as $warn )
    if ( $warn != "" )
	$def[1] .= "HRULE:$warn$_WARNRULE ";
foreach ( array($CRIT[1], $CRIT_MIN[1], $CRIT_MAX[1]) as $crit )
    if ( $crit != "" )
	$def[1] .= "HRULE:$crit$_CRITRULE ";

if ( $CRIT_MIN[1] != "" and $CRIT_MAX[1] != "" ) {
    $base = ($CRIT_MIN[1] + $CRIT_MAX[1]) / 2;
    $ll = $base - 1.5 * ($base - $CRIT_MIN[1]);
    $ul = $base + 1.5 * ($CRIT_MAX[1] - $base);
    $opt[1] .= "-l $ll -u $ul -r ";
} else {
    $opt[1] .= "-A ";
}

?>
