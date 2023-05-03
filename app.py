#!/usr/bin/env python
import sys
import subprocess
from subprocess import Popen, PIPE
from datetime import datetime
import config as config
import db.db as db
import db.metadata as metadata
import alert
import temp


# Scan for new devices
def scan_online_devices():
	online_devices = _execute_arp_scan()
	# compare output with DB to find new and trigger "offline alert"
	for device in online_devices:
		mac = device["mac"]
		ip = device["ip"]
		vendor = device["vendor"]
		if (db.mac_exists(mac)):
			print("--- Updating Device ---")
			print("--- --- " + mac + " | " + vendor + " | " + ip)
			db.update_device(mac,ip,vendor,is_online=True)
			#update MAC
		else:
			print("--- Creating New Device ---")
			print("--- --- " + mac + " | " + vendor + " | " + ip)
			db.create_device(mac,ip,vendor,True,is_new=True,is_online=True)
	#alert.send_down_alert()
	#alert.send_new_alert()
	return

def scan_offline_devices():
	devices = db.get_alert_down_devices()
	for mac in devices:
		if not db.is_online(mac):
			alert.send_down_alert()
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
	scan_online_devices()
	scan_offline_devices()
	db.save_db()


if __name__ == '__main__':
	sys.exit(main())
