#!/usr/bin/python
# -*- encoding: utf-8; py-indent-offset: 4 -*-
# +------------------------------------------------------------------+
# |             ____ _               _        __  __ _  __           |
# |            / ___| |__   ___  ___| | __   |  \/  | |/ /           |
# |           | |   | '_ \ / _ \/ __| |/ /   | |\/| | ' /            |
# |           | |___| | | |  __/ (__|   <    | |  | | . \            |
# |            \____|_| |_|\___|\___|_|\_\___|_|  |_|_|\_\           |
# |                                                                  |
# | Copyright Mathias Kettner 2012             mk@mathias-kettner.de |
# +------------------------------------------------------------------+
#
# This file is part of Check_MK.
# The official homepage is at http://mathias-kettner.de/check_mk.
#
# check_mk is free software;  you can redistribute it and/or modify it
# under the  terms of the  GNU General Public License  as published by
# the Free Software Foundation in version 2.  check_mk is  distributed
# in the hope that it will be useful, but WITHOUT ANY WARRANTY;  with-
# out even the implied warranty of  MERCHANTABILITY  or  FITNESS FOR A
# PARTICULAR PURPOSE. See the  GNU General Public License for more de-
# ails.  You should have  received  a copy of the  GNU  General Public
# License along with GNU Make; see the file  COPYING.  If  not,  write
# to the Free Software Foundation, Inc., 51 Franklin St,  Fifth Floor,
# Boston, MA 02110-1301 USA.

# Check has been developed using an UPS Emerson/Liebert NX and General
# Electric NetPro 3000
#
# +------------------------------------------------------------------+
# | This file has been contributed by:                               |
# |                                                                  |
# | Václav Ovsík <vaclav.ovsik@gmail.com>             Copyright 2012 |
# +------------------------------------------------------------------+


def perfometer_check_mk_ups_output(row, check_command, perf_data):
    info = row["service_plugin_output"]
    label='PercentLoad:'
    try:
        beg = info.index(label) + len(label)
        end = info.index('%', beg)
        load = info[beg:end].strip()
        load = int(load)
    except:
        load = None
    color = '#00ff00'
    if info.startswith('WARN'):
        color = '#ffff00'
    if info.startswith('CRIT'):
        color = '#ff0000'
    return (str(load) + '%'), perfometer_linear(load, color)

perfometers['check_mk-ups_output'] = perfometer_check_mk_ups_output
