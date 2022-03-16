#!/usr/bin/env python
# -*- coding: utf-8 -*-

# Python version:
# @author		Bytez (https://github.com/Bytezz)
# @license		GPLv3
#
# Original ruby version:
# @package		IP Geolocation https://git.io/vi2RV
# @author		Cahyadi Triyansyah (https://sundi3yansyah.com)
# @license		MIT

# This program is free software: you can redistribute it and/or modify it
# under the terms of the GNU General Public License as published by the
# Free Software Foundation, either version 3 of the License, or (at your
# option) any later version.
# 
# This program is distributed in the hope that it will be useful, but
# WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General
# Public License for more details.
# 
# You should have received a copy of the GNU General Public License along
# with this program. If not, see <https://www.gnu.org/licenses/>. 

import json
import sys

# Cross python support
if sys.version_info[0]>2:
	from urllib.request import urlopen
	def raw_input(txt):
		return(input(txt))
else:
	from urllib import urlopen

def table(data):
	stringTitle = "String"
	valueTitle = "Value"
	
	longestString = 0
	longestValue = 0
	for info in data:
		info[0] = str(info[0])
		info[1] = str(info[1])
		if len(info[0]) > longestString:
			longestString = len(info[0])
		if len(info[1]) > longestValue:
			longestValue = len(info[1])
	
	print("┌" + "─"*(longestString+2) + "┬" + "─"*(longestValue+2) + "┐")
	print("│" + " "+stringTitle+" "*(longestString-len(stringTitle))+" " + "│" + " "+valueTitle+" "*(longestValue-len(valueTitle))+" " + "│")
	print("├" + "─"*(longestString+2) + "┼" + "─"*(longestValue+2) + "┤")
	for info in data:
		info[0] = str(info[0])
		info[1] = str(info[1])
		print("│" + " "+info[0]+" "*(longestString-len(info[0]))+" " + "│" + " "+info[1]+" "*(longestValue-len(info[1]))+" " + "│")
	print("└" + "─"*(longestString+2) + "┴" + "─"*(longestValue+2) + "┘")



ip = raw_input("Enter the IP Address : ")
ip = ip.strip()
if ip == "":
	print("Sorry, your search IP Address field is required. Please try again.")
else:
	api = json.loads(urlopen("http://ip-api.com/json/{}".format(ip)).read())
	if api["status"] == "success":
		array = [
			["Network", api["as"]],
			["City", api["city"]],
			["Country", api["country"]],
			["CountryCode", api["countryCode"]],
			["Isp", api["isp"]],
			["Lat", api["lat"]],
			["Lon", api["lon"]],
			["Org", api["org"]],
			["IP", api["query"]],
			["Region", api["region"]],
			["RegionName", api["regionName"]],
			["Timezone", api["timezone"]],
			["Zip", api["zip"]],
		]
	else:
		array = [
			["Message", api["message"]],
			["Request", api["query"]],
		]
	
	table(array)
