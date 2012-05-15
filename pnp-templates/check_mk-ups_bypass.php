<?php
# Template:	check_mk-ups_bypass.php
# Author:	vaclav.ovsik@gmail.com
#
# DS
# 	1	Voltage
#
$_WARNRULE = '#FFFF00';
$_CRITRULE = '#FFA0A0';
#
#


$ds_name[1] = "Bypass voltage";
$opt[1] = "--vertical-label 'V' --title \"$hostname / $servicedesc\" ";

$def[1] = "DEF:u=$RRDFILE[1]:$DS[1]:MAX ";
$def[1] .= "LINE:u#050:\"bypass voltage\" ";
$def[1] .= "GPRINT:u:LAST:\"%3.1lfV last\" ";
$def[1] .= "GPRINT:u:MIN:\"%3.1lfV min\" ";
$def[1] .= "GPRINT:u:MAX:\"%3.1lfV max\" ";
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
