#!/usr/local/bin/ruby

# @package		IP Geolocation https://git.io/vi2RV
# @author		Cahyadi Triyansyah (https://sundi3yansyah.com)
# @license		MIT

require "net/http"
require "json" # gem install json
require "terminal-table" # gem install terminal-table

print "Enter the IP Address you want : "

input = gets.strip;

if input.empty?

	puts "Sorry, your search IP Address field is required. Please try again."

else

	api = JSON.parse(Net::HTTP.get(URI("http://ip-api.com/json/#{input}")))

	if api["status"] == "success"

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

	else

		array = [
		  ["Message", api["message"]],
		  ["Request", api["query"]],
		]

	end

	result = Terminal::Table.new :headings => ["String", "Value"], :rows => array

	puts "\n", result, "\n"

	puts "Get repository : https://git.io/vi2RV", "\n"

end
