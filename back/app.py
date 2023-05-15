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
import temp as temp

# Scan for online devices
def scan_online_devices():
	online_devices = _execute_arp_scan()
	new_devices = []
	for device in online_devices:
		mac = device["mac"]
		ip = device["ip"]
		vendor = device["vendor"]
		if (db.mac_exists(mac)):
			print("--- Updating Device ---")
			print("--- --- " + mac + " | " + vendor + " | " + ip)
			db.update_device(mac,ip,is_online=True)
		else:
			print("--- Creating New Device ---")
			print("--- --- " + mac + " | " + vendor + " | " + ip)
			db.create_device(mac,ip,vendor,True,is_new=True)
			alert.appent_new_device(mac)
	return

def check_alert_down_devices():
	alert_down_devices = db.get_alert_down_devices()
	down_devices=[]
	for mac in alert_down_devices:
		if not db.is_online(mac):
			alert.appent_down_device(mac)
	return


def _execute_arp_scan():
	devices = []
	#arpscan_output = subprocess.check_output(['sudo', 'arp-scan', '--localnet', '--ignoredups', '--retry=1'], universal_newlines=True)
	arpscan_output = temp.check_output()
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
	alert.send_alert()
	


if __name__ == '__main__':
	sys.exit(main())
