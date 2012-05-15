<?php
# Template:	check_mk-ups_input.freq.php
# Author:	vaclav.ovsik@gmail.com
#
# DS
# 	Voltage
# 	Current
# 	Frequency
#
$_WARNRULE = '#FFFF00';
$_CRITRULE = '#FFA0A0';
#
#

# The number of data source various due to different
# settings (such as averaging). We rather work with names
# than with numbers.
$RRD = array();
foreach ($NAME as $i => $n) {
    $RRD[$n] = "$RRDFILE[$i]:$DS[$i]:AVERAGE";
    $WARN[$n] = $WARN[$i];
    $WARN_MIN[$n] = $WARN_MIN[$i];
    $WARN_MAX[$n] = $WARN_MAX[$i];
    $CRIT[$n] = $CRIT[$i];
    $CRIT_MIN[$n] = $CRIT_MIN[$i];
    $CRIT_MAX[$n] = $CRIT_MAX[$i];
    $MIN[$n]  = $MIN[$i];
    $MAX[$n]  = $MAX[$i];
}


$ds_name[1] = "Input voltage";
$opt[1] = "--vertical-label 'V' --title \"$hostname / $servicedesc\" ";

$def[1] = "DEF:u=$RRD[Voltage] ";
$def[1] .= "LINE:u#050:\"input voltage\" ";
$def[1] .= "GPRINT:u:LAST:\"%3.1lfV last\" ";
$def[1] .= "GPRINT:u:MIN:\"%3.1lfV min\" ";
$def[1] .= "GPRINT:u:MAX:\"%3.1lfV max\" ";
foreach ( array($WARN['Voltage'], $WARN_MIN['Voltage'], $WARN_MAX['Voltage']) as $warn )
    if ( $warn != "" )
	$def[1] .= "HRULE:$warn$_WARNRULE ";
foreach ( array($CRIT['Voltage'], $CRIT_MIN['Voltage'], $CRIT_MAX['Voltage']) as $crit )
    if ( $crit != "" )
	$def[1] .= "HRULE:$crit$_CRITRULE ";

if ( $CRIT_MIN['Voltage'] != "" and $CRIT_MAX['Voltage'] != "" ) {
    $base = ($CRIT_MIN['Voltage'] + $CRIT_MAX['Voltage']) / 2;
    $ll = $base - 1.5 * ($base - $CRIT_MIN['Voltage']);
    $ul = $base + 1.5 * ($CRIT_MAX['Voltage'] - $base);
    $opt[1] .= "-l $ll -u $ul -r ";
} else {
    $opt[1] .= "-A ";
}


$ds_name[2] = "Input current";
$opt[2] = "--vertical-label 'A' --title \"$hostname / $servicedesc\" ";

$def[2] = "DEF:i=$RRD[Current] ";
$def[2] .= "LINE:i#050:\"input current\" ";
$def[2] .= "GPRINT:i:LAST:\"%3.1lfA last\" ";
$def[2] .= "GPRINT:i:MIN:\"%3.1lfA min\" ";
$def[2] .= "GPRINT:i:MAX:\"%3.1lfA max\" ";
foreach ( array($WARN['Current'], $WARN_MIN['Current'], $WARN_MAX['Current']) as $warn )
    if ( $warn != "" )
	$def[2] .= "HRULE:$warn$_WARNRULE ";
foreach ( array($CRIT['Current'], $CRIT_MIN['Current'], $CRIT_MAX['Current']) as $crit )
    if ( $crit != "" )
	$def[2] .= "HRULE:$crit$_CRITRULE ";

if ( $CRIT_MIN['Current'] != "" and $CRIT_MAX['Current'] != "" ) {
    $base = ($CRIT_MIN['Current'] + $CRIT_MAX['Current']) / 2;
    $ll = $base - 1.5 * ($base - $CRIT_MIN['Current']);
    $ul = $base + 1.5 * ($CRIT_MAX['Current'] - $base);
    $opt[2] .= "-l $ll -u $ul -r ";
} else {
    $opt[2] .= "-A ";
}


$ds_name[3] = "Input frequency";
$opt[3] = "--vertical-label 'Hz' --title \"$hostname / $servicedesc\" ";

$def[3] = "DEF:f=$RRD[Frequency] ";
$def[3] .= "LINE:f#050:\"input frequency\" ";
$def[3] .= "GPRINT:f:LAST:\"%2.1lfHz last\" ";
$def[3] .= "GPRINT:f:MIN:\"%2.1lfHz min\" ";
$def[3] .= "GPRINT:f:MAX:\"%2.1lfHz max\" ";
foreach ( array($WARN['Frequency'], $WARN_MIN['Frequency'], $WARN_MAX['Frequency']) as $warn )
    if ( $warn != "" )
	$def[3] .= "HRULE:$warn$_WARNRULE ";
foreach ( array($CRIT['Frequency'], $CRIT_MIN['Frequency'], $CRIT_MAX['Frequency']) as $crit )
    if ( $crit != "" )
	$def[3] .= "HRULE:$crit$_CRITRULE ";

if ( $CRIT_MIN['Frequency'] != "" and $CRIT_MAX['Frequency'] != "" ) {
    $base = ($CRIT_MIN['Frequency'] + $CRIT_MAX['Frequency']) / 2;
    $ll = $base - 1.5 * ($base - $CRIT_MIN['Frequency']);
    $ul = $base + 1.5 * ($CRIT_MAX['Frequency'] - $base);
    $opt[3] .= "-l $ll -u $ul -r ";
} else {
    $opt[3] .= "-A ";
}


?>
