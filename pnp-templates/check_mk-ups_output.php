<?php
# Template:	check_mk-ups_output.freq.php
# Author:	vaclav.ovsik@gmail.com
#
# DS
# 	Voltage
# 	Current
# 	Power
# 	PercentLoad
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


$ds_name[1] = "Output voltage";
$opt[1] = "--vertical-label 'V' --title \"$hostname / $servicedesc\" ";

$def[1] = "DEF:u=$RRD[Voltage] ";
$def[1] .= "LINE:u#050:\"output voltage\" ";
$def[1] .= "GPRINT:u:LAST:\"%3.1lfV last\" ";
$def[1] .= "GPRINT:u:MIN:\"%3.1lfV min\" ";
$def[1] .= "GPRINT:u:MAX:\"%3.1lfV max\" ";
foreach ( array($WARN["Voltage"], $WARN_MIN["Voltage"], $WARN_MAX["Voltage"]) as $warn )
if ( $warn != "" )
    $def[1] .= "HRULE:$warn$_WARNRULE ";
foreach ( array($CRIT["Voltage"], $CRIT_MIN["Voltage"], $CRIT_MAX["Voltage"]) as $crit )
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


$ds_name[2] = "Output current";
$opt[2] = "--vertical-label 'A' --title \"$hostname / $servicedesc\" ";

$def[2] = "DEF:i=$RRD[Current] ";
$def[2] .= "LINE:i#050:\"output current\" ";
$def[2] .= "GPRINT:i:LAST:\"%3.1lfA last\" ";
$def[2] .= "GPRINT:i:MIN:\"%3.1lfA min\" ";
$def[2] .= "GPRINT:i:MAX:\"%3.1lfA max\" ";
foreach ( array($WARN["Current"], $WARN_MIN["Current"], $WARN_MAX["Current"]) as $warn )
if ( $warn != "" )
    $def[2] .= "HRULE:$warn$_WARNRULE ";
foreach ( array($CRIT["Current"], $CRIT_MIN["Current"], $CRIT_MAX["Current"]) as $crit )
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


$ds_name[3] = "Output power";
$opt[3] = "--vertical-label 'W' --title \"$hostname / $servicedesc\" ";

$def[3] = "DEF:p=$RRD[Power] ";
$def[3] .= "LINE:p#050:\"output power\" ";
$def[3] .= "GPRINT:p:LAST:\"%4.1lfW last\" ";
$def[3] .= "GPRINT:p:MIN:\"%4.1lfW min\" ";
$def[3] .= "GPRINT:p:MAX:\"%4.1lfW max\" ";
foreach ( array($WARN["Power"], $WARN_MIN["Power"], $WARN_MAX["Power"]) as $warn )
if ( $warn != "" )
    $def[3] .= "HRULE:$warn$_WARNRULE ";
foreach ( array($CRIT["Power"], $CRIT_MIN["Power"], $CRIT_MAX["Power"]) as $crit )
if ( $crit != "" )
    $def[3] .= "HRULE:$crit$_CRITRULE ";

if ( $CRIT_MIN['Power'] != "" and $CRIT_MAX['Power'] != "" ) {
    $base = ($CRIT_MIN['Power'] + $CRIT_MAX['Power']) / 2;
    $ll = $base - 1.5 * ($base - $CRIT_MIN['Power']);
    $ul = $base + 1.5 * ($CRIT_MAX['Power'] - $base);
    $opt[3] .= "-l $ll -u $ul -r ";
} else {
    $opt[3] .= "-A ";
}


$ds_name[4] = "Output load";
$opt[4] = "--vertical-label '%' --title \"$hostname / $servicedesc\" ";

$def[4] = "DEF:p=$RRD[PercentLoad] ";
$def[4] .= "LINE:p#050:\"output load\" ";
$def[4] .= "GPRINT:p:LAST:\"%2.1lf%% last\" ";
$def[4] .= "GPRINT:p:MIN:\"%2.1lf%% min\" ";
$def[4] .= "GPRINT:p:MAX:\"%2.1lf%% max\" ";
foreach ( array($WARN["PercentLoad"], $WARN_MIN["PercentLoad"], $WARN_MAX["PercentLoad"]) as $warn )
if ( $warn != "" )
    $def[4] .= "HRULE:$warn$_WARNRULE ";
foreach ( array($CRIT["PercentLoad"], $CRIT_MIN["PercentLoad"], $CRIT_MAX["PercentLoad"]) as $crit )
if ( $crit != "" )
    $def[4] .= "HRULE:$crit$_CRITRULE ";

if ( $CRIT_MIN['PercentLoad'] != "" and $CRIT_MAX['PercentLoad'] != "" ) {
    $base = ($CRIT_MIN['PercentLoad'] + $CRIT_MAX['PercentLoad']) / 2;
    $ll = $base - 1.5 * ($base - $CRIT_MIN['PercentLoad']);
    $ul = $base + 1.5 * ($CRIT_MAX['PercentLoad'] - $base);
    $opt[4] .= "-l $ll -u $ul -r ";
} else {
    $opt[4] .= "-A ";
}


?>
