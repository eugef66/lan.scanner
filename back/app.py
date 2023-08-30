#!/usr/bin/env python
import datetime
import sys, os
# append root folder
sys.path.append (os.path.dirname(os.path.dirname(os.path.abspath(__file__))))

import subprocess
from subprocess import Popen, PIPE

import db.db as db
import db.metadata as metadata
import alert
import emulator as temp
import config
from utils import formatTS

# Scan for online devices
def scan_online_devices(cycle):
	online_devices = _execute_arp_scan(cycle)
	for device in online_devices:
		mac = device["mac"]
		ip = device["ip"]
		vendor = device["vendor"]
		if (db.mac_exists(mac)):
			db.update_device(mac,ip,is_online=True)
		else:
			db.create_device(mac,ip,vendor,True,is_new=True)
			alert.appent_new_device(mac)
			device = db.get_device(mac)
			print("NEW -- " + device["ip"] + " : " + device["vendor"])
	return

def check_alert_down_devices():
	alert_down_devices = db.get_alert_down_devices()
	for mac in alert_down_devices:
		if not db.is_online(mac):
			alert.appent_down_device(mac)
			device = db.get_device(mac)
			print("DOWN -- " + device["ip"] + " : " + device["description"])
			
	return


def _execute_arp_scan(retry):
	devices = []
	retry = {"1":"9","15":"16"}[retry]
	arp_scan_arguments = ['sudo', 'arp-scan', '192.168.1.1-192.168.1.254', '--ignoredups', '--retry=' + retry ]
	print ("Executing: " + ' '.join(arp_scan_arguments))
	if (config.EMULATE):
		print("Emulating arp-scan")
		arpscan_output = temp.check_output()
	else:
		arpscan_output = subprocess.check_output(arp_scan_arguments, universal_newlines=True)
	
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
	print (" -- Process Started [" + formatTS(datetime.datetime.now()) + "] --")
	db.reset_online_flag()
	print ("-- Scaning Online Devices --")
	
	if(len(sys.argv) > 1):
		cycle = str(sys.argv[1]) 
	else:
		cycle = "1"
	
	scan_online_devices(cycle)
	print ("-- Scaning Down Devices --")
	check_alert_down_devices()
	db.save()
	alert.send_alerts()
	print (" -- Process Finished [" + formatTS(datetime.datetime.now()) + "] --")
	


if __name__ == '__main__':
	sys.exit(main())
