#!/usr/bin/env python
import os
import json
import sys
import uuid
import requests
import subprocess
import re
import time
import smtplib
import sqlite3
from subprocess import Popen, PIPE
from datetime import datetime
import config as config
import db


DB = None
_down_devices=[]
_new_devices=[]




# Scan for new devices
def scan_network():
	if (DB == None):
		DB = db._load_db()
		
	# Step 1. Scan online devices using arp-scan
	if (config.USE_ARP_SCAN):
		online_devices = _load_arp_scan()
		# compare output with DB to find new and trigger "offline alert"
		for device in online_devices:
			mac = device["mac"]
			ip = device["ip"]
			vendor = device["vendor"]
			db.create_update_device(False, mac=mac, ip=ip, is_online=True, vendor=vendor)

	db.save_db(DB)
	_send_down_alert()
	_send_new_alert()
	return


def get_default_device_name(mac, ip):
	mac = mac.upper()
	ip = _ip_last_number(ip)
	if (mac in DHCP_RESERVATIONS):
		return DHCP_RESERVATIONS[mac]["hostname"]
	elif (ip in LOCAL_DNS):
		return LOCAL_DNS[ip]
	return "(new device)"
# Get Vendor Name by MAC


def get_vendor_by_mac(mac):
	vendor = ""
	try:
		# https://api.macvendors.com/d8:eb:97:22:e6:4b
		time.sleep(1)
		url = "https://api.macvendors.com/" + mac
		mlr = requests.get(url)
		if mlr.status_code == 200:
			vendor = mlr.content
		return vendor.decode("utf-8")
	except:
		return "(Vendor Lookup Error)"



def _load_arp_scan():
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


def _send_down_alert():
	print ("Sending Down Alert")
	return


def _send_new_alert():
	print ("Sending New Device Alert")
	return


def _ip_last_number(ip):
	return int(ip.split(".")[3])
# Default process when no method argument provides


def send_email(subject, text):

	#msg = MIMEMultipart('alternative')
	#msg['Subject'] = 'Pi.Alert Report'
	#msg['From'] = REPORT_FROM
	#msg['To'] = REPORT_TO
	#msg.attach (MIMEText (pText, 'plain'))
	#msg.attach (MIMEText (pHTML, 'html'))

	header = "To: " + config.EMAIL_TO + "\nFrom: " + \
		config.SMTP_USERNAME + "\n" + "Subject: " + subject
	body = text

	s = smtplib.SMTP(config.SMTP_SERVER, config.SMTP_PORT)
	s.ehlo()
	s.starttls()
	s.ehlo()
	s.login(config.SMTP_USERNAME, config.SMTP_PASSWORD)
	# print body + "\n==================================="
	s.sendmail(config.SMTP_USERNAME, config.EMAIL_TO, header + '\n\n' + body)
	s.quit()


def main():
	DB = db.load_db()
	scan_network()


if __name__ == '__main__':
	sys.exit(main())
