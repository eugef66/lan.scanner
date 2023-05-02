#!/usr/bin/env python
import datetime
import os
import json
from alert import send_down_alert
import config
from utils import get_default_device_name, get_vendor_by_mac


_db=None
_down_devices=[]
_new_devices=[]

def mac_exists(mac):
	load_db()
	return mac in _db


def create_update_device(save_to_db, mac, ip, is_online=None, description=None, alert_down=None, hostname=None, vendor=None, is_new=None):
	load_db()

	ip4 = None
	ip6 = None
	if (":" in ip):
		ip6 = ip
	else:
		ip4 = ip

	if (mac not in _db):
		default_device_name = get_default_device_name(mac, ip)
		if (is_new == None):
			isnew = True
		if (description == None):
			description = default_device_name
		if (hostname == None):
			hostname = get_default_device_name(mac, ip)
		if (alert_down == None):
			alert_down = False
		if (is_online == None):
			is_online = False
		if (vendor == None):
			vendor = get_vendor_by_mac(mac)
		print("--- Creating New Device ---")
		print("--- --- " + mac + " | " + vendor + " | " + description + " | " + ip)
		if (config.ALERT_NEW_DEVICE):
			_new_devices.append(mac)
	else:
		if (ip4 == None):
			ip4 = _db[mac]["ip"]
		if (ip6 == None):
			ip6 = _db[mac]["ip6"]
		if (is_new == None):
			isnew = _db[mac]["is_new"]
		if (description == None):
			description = _db[mac]["description"]
		if (hostname == None):
			hostname = _db[mac]["hostname"]
		if (alert_down == None):
			alert_down = _db[mac]["alert_down"]
		if (is_online == None):
			is_online = _db[mac]["is_online"]
		if (vendor == None):
			vendor = _db[mac]["vendor"]
		if (_db[mac]["alert_down"] and not is_online):
			send_down_alert(mac)
		print("--- Updating Existing Device ---")
		print("--- --- " + mac + " | " + vendor + " | " + description + " | " + ip)
		
		if (_db[mac]["alert_down"] and not is_online):
			_down_devices.append(mac)


	_db[mac] = {"ip": ip4,
			   "ip6": ip6,
			   "is_online": is_online,
			   "description": description,
			   "vendor": vendor,
			   "hostname": hostname,
			   "alert_down": alert_down,
			   "updateTS": datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
			   "is_new": isnew
			   }
	if (save_to_db):
		save_db(_db)
	return

def load_db(force_reload=False):
	global _db
	# Check is already loaded
	if (_db != None and force_reload==False):
		return _db

	print("--- loading database ---")
	if (os.path.exists(config.APP_PATH + "/db/db.json")):
		with open(config.APP_PATH + '/db/db.json', 'r') as _db_file:
			_db = json.load(_db_file)
	else:
		_db = {}
		save_db(_db)
	return _db


def save_db(_db):
	with open(config.APP_PATH + "/db/db.json", "w+") as _db_file:
		_db_file.write(json.dumps(_db, indent=4))
	return

def __init__(self):
	self.load_db()
