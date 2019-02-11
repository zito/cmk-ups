<?php
# Template:	check_mk-ups_batt.php
# Author:	vaclav.ovsik@gmail.com
#
# DS
# 	SecondsOnBattery
# 	EstimatedMinutesRemaining
# 	EstimatedChargeRemaining
# 	BatteryVoltage
# 	BatteryCurrent
# 	BatteryTemperature
#
$_WARNRULE = '#FFFF00';
$_CRITRULE = '#FF0000';
#
#

# The number of data source various based on settings.
# We rather work with names than with numbers.
$RRD = array();
foreach ($NAME as $i => $n) {
    $RRD[$n] = "$RRDFILE[$i]:$DS[$i]";
    $WARN[$n] = $WARN[$i];
    $WARN_MIN[$n] = $WARN_MIN[$i];
    $WARN_MAX[$n] = $WARN_MAX[$i];
    $CRIT[$n] = $CRIT[$i];
    $CRIT_MIN[$n] = $CRIT_MIN[$i];
    $CRIT_MAX[$n] = $CRIT_MAX[$i];
    $MIN[$n]  = $MIN[$i];
    $MAX[$n]  = $MAX[$i];
}


$ds_name[1] = "Time on battery power";
$opt[1] = "--vertical-label 'min' --title \"$hostname / $servicedesc\" --lower-limit 0 ";

$def[1] = "DEF:times=$RRD[SecondsOnBattery]:MAX ";
$def[1] .= "CDEF:timem=times,60,/ ";
$def[1] .= "LINE1:timem#FF66FF:\"battery time\" ";
$def[1] .= "GPRINT:timem:LAST:\"%4.0lfmin last\" ";
$def[1] .= "GPRINT:timem:MAX:\"%4.0lfmin max\" ";


$ds_name[2] = "Est. time remaining";
$opt[2] = "--vertical-label 'min' --title \"$hostname / $servicedesc\" --lower-limit 0 ";

$def[2] = "DEF:etrem=$RRD[EstimatedMinutesRemaining]:AVERAGE ";
$def[2] .= "LINE1:etrem#050:\"est. time remaining\" ";
$def[2] .= "GPRINT:etrem:LAST:\"%4.0lfmin last\" ";
$def[2] .= "GPRINT:etrem:MIN:\"%4.0lfmin min\" ";
if ( $WARN['EstimatedMinutesRemaining'] != "" )
	$def[2] .= "HRULE:$WARN[EstimatedMinutesRemaining]$_WARNRULE ";
if ( $CRIT['EstimatedMinutesRemaining'] != "" )
	$def[2] .= "HRULE:$CRIT[EstimatedMinutesRemaining]$_CRITRULE ";


$ds_name[3] = "Est. charge remaining";
$opt[3] = "--vertical-label '%' --title \"$hostname / $servicedesc\" --lower-limit 0 --upper-limit 101 ";

$def[3] = "DEF:echrem=$RRD[EstimatedChargeRemaining]:AVERAGE ";
$def[3] .= "LINE1:echrem#050:\"est. charge remaining\" ";
$def[3] .= "GPRINT:echrem:LAST:\"%4.0lf%% last\" ";
$def[3] .= "GPRINT:echrem:MIN:\"%4.0lf%% min\" ";
if ( $WARN['EstimatedChargeRemaining'] != "" )
	$def[3] .= "HRULE:$WARN[EstimatedChargeRemaining]$_WARNRULE ";
if ( $CRIT['EstimatedChargeRemaining'] != "" )
	$def[3] .= "HRULE:$CRIT[EstimatedChargeRemaining]$_CRITRULE ";


$ds_name[4] = "Battery voltage";
$opt[4] = "--vertical-label 'V' --title \"$hostname / $servicedesc\" ";

$def[4] = "DEF:u=$RRD[BatteryVoltage]:AVERAGE ";
$def[4] .= "LINE1:u#050:\"battery voltage\" ";
$def[4] .= "GPRINT:u:LAST:\"%4.1lfV last\" ";
$def[4] .= "GPRINT:u:MIN:\"%4.1lfV min\" ";
$def[4] .= "GPRINT:u:MAX:\"%4.1lfV max\" ";
if ( $WARN['BatteryVoltage'] != "" )
	$def[4] .= "HRULE:$WARN[BatteryVoltage]$_WARNRULE ";
if ( $CRIT['BatteryVoltage'] != "" )
	$def[4] .= "HRULE:$CRIT[BatteryVoltage]$_CRITRULE ";


$ds_name[5] = "Battery current";
$opt[5] = "--vertical-label 'A' --title \"$hostname / $servicedesc\" ";

$def[5] = "DEF:i=$RRD[BatteryCurrent]:AVERAGE ";
$def[5] .= "LINE1:i#050:\"battery current\" ";
$def[5] .= "GPRINT:i:LAST:\"%4.1lfA last\" ";
$def[5] .= "GPRINT:i:MIN:\"%4.1lfA min\" ";
$def[5] .= "GPRINT:i:MAX:\"%4.1lfA max\" ";
if ( $WARN['BatteryCurrent'] != "" )
	$def[5] .= "HRULE:$WARN[BatteryCurrent]$_WARNRULE ";
if ( $CRIT['BatteryCurrent'] != "" )
	$def[5] .= "HRULE:$CRIT[BatteryCurrent]$_CRITRULE ";


$ds_name[6] = "Battery temperature";
$opt[6] = "--vertical-label '°C' --title \"$hostname / $servicedesc\" ";

$def[6] = "DEF:temp=$RRD[BatteryTemperature]:AVERAGE ";
$def[6] .= "LINE1:temp#050:\"battery temperature\" ";
$def[6] .= "GPRINT:temp:LAST:\"%4.1lf°C last\" ";
$def[6] .= "GPRINT:temp:MIN:\"%4.1lf°C min\" ";
$def[6] .= "GPRINT:temp:MAX:\"%4.1lf°C max\" ";
if ( $WARN['BatteryTemperature'] != "" )
	$def[6] .= "HRULE:$WARN[BatteryTemperature]$_WARNRULE ";
if ( $CRIT['BatteryTemperature'] != "" )
	$def[6] .= "HRULE:$CRIT[BatteryTemperature]$_CRITRULE ";

?>
