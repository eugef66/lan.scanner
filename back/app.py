#!/usr/bin/env python
import sys, os
# append root folder
sys.path.append (os.path.dirname(os.path.dirname(os.path.abspath(__file__))))

import subprocess
from subprocess import Popen, PIPE
from datetime import datetime
import db.db as db
import db.metadata as metadata
import alert
import emulator as temp
import config

# Scan for online devices
def scan_online_devices():
	online_devices = _execute_arp_scan()
	new_devices_count = 0
	for device in online_devices:
		mac = device["mac"]
		ip = device["ip"]
		vendor = device["vendor"]
		if (db.mac_exists(mac)):
			db.update_device(mac,ip,is_online=True)
		else:
			new_devices_count += 1
			db.create_device(mac,ip,vendor,True,is_new=True)
			alert.appent_new_device(mac)
	print(str(new_devices_count) + " new devices")
	return

def check_alert_down_devices():
	alert_down_devices = db.get_alert_down_devices()
	down_devices_count=0
	for mac in alert_down_devices:
		if not db.is_online(mac):
			down_devices_count += 1
			alert.appent_down_device(mac)
	print(str(down_devices_count) + " down devices")
	return


def _execute_arp_scan():
	devices = []
	if (config.EMULATE):
		print("Emulating arp-scan")
		arpscan_output = temp.check_output()
	else:
		arpscan_output = subprocess.check_output(['sudo', 'arp-scan', '--localnet', '--ignoredups', '--retry=1'], universal_newlines=True)
	
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
	db.reset_online_flag()
	scan_online_devices()
	check_alert_down_devices()
	db.save()
	alert.send_alerts()
	


if __name__ == '__main__':
	sys.exit(main())
