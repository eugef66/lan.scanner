#!/usr/bin/env python
import sys
import subprocess
from subprocess import Popen, PIPE
from datetime import datetime
import config as config
import db.db
import db.metadata
import alert



# Scan for new devices
def scan_network():
	# Step 1. Scan online devices using arp-scan

	online_devices = _execute_arp_scan()
	# compare output with DB to find new and trigger "offline alert"
	for device in online_devices:
		mac = device["mac"]
		ip = device["ip"]
		vendor = device["vendor"]
		db.create_update_device(False, mac=mac, ip=ip, is_online=True, vendor=vendor)

	db.save_db(DB)
	alert.send_down_alert()
	alert.send_new_alert()
	return



# Get Vendor Name by MAC




def _execute_arp_scan():
	devices = []
	arpscan_output = subprocess.check_output(
		['sudo', 'arp-scan', '--localnet', '--ignoredups', '--retry=1'], universal_newlines=True)
	lineindex = 1
	number_of_cleints = len(arpscan_output.splitlines())-2
	for line in arpscan_output.splitlines():
		lineindex += 1
		if lineindex < 4 or lineindex > number_of_cleints:
			continue
		device = line.split('\t')
		devices.append({"ip": device[0],
						"mac": device[1],
						"vendor": device[2]})
	return devices


def main():
	DB = db.load_db()
	scan_network()


if __name__ == '__main__':
	sys.exit(main())
