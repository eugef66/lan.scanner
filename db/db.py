#!/usr/bin/env python
from datetime import datetime
import os
import json
from utils import get_default_device_name, get_vendor_by_mac

_db_path = os.path.dirname(os.path.abspath(__file__))

_db=None
_down_devices=[]
_new_devices=[]

def get_device(mac):
	load()
	return _db[mac]

def reset_online_flag():
	load()
	for mac in _db:
		_db[mac]["is_online"]=False
	return

def mac_exists(mac):
	load()
	return mac in _db

def get_alert_down_devices():
	load()
	return dict(filter(lambda device: device[1]["alert_down"]==True,_db.items()))

def is_online(mac):
	load()
	return _db[mac]["is_online"]

def create_device(mac, 
					ip, 
					vendor=None, 
					is_online=False, 
					description=None, 
					alert_down=None, 
					is_new=None,
					location=None, 
					device_type=None, 
					owner=None,
					comments=None):
	load()

	vendor_name = get_vendor_by_mac(mac) if vendor == None else vendor
	default_device_name = (vendor_name + ' device') if description == None else description

	_db[mac] = {"ip": ip if ":" not in ip else None,
		   "ip6": ip if ":" in ip else None,
		   "is_online": is_online,
		   "description": default_device_name, 
		   "vendor": vendor_name,
		   "alert_down": False if alert_down == None else alert_down,
		   "location": location,
		   "device-type": device_type,
		   "owner": owner,
		   "updateTS": datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
		   "is_new": True if is_new == None else is_new,
		   "down_count" : 0,
		   "comments" : comments
		   }
	return

def update_device(mac,
					ip,
					vendor=None,
					is_online=False,
					description=None,
					alert_down=None,
					is_new=None,
					location=None,
					device_type=None,
					owner=None,
					comments=None):
	load()
	_db[mac] = {"ip": ip if ":" not in ip else None,
		   "ip6": ip if ":" in ip else None,
		   "is_online": is_online,
		   "description": _db[mac]["description"] if description == None else description,
		   "vendor": _db[mac]["vendor"] if vendor == None else vendor,
		   "alert_down": _db[mac]["alert_down"] if alert_down == None else alert_down,
		   "location": _db[mac]["location"]  if location == None else location,
		   "device-type": _db[mac]["device-type"]  if device_type == None else device_type ,
		   "owner": _db[mac]["owner"]  if owner == None else owner,
		   "updateTS": datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
		   "is_new": _db[mac]["is_new"] if is_new == None else is_new,
		   "comments": _db[mac]["comments"] if comments == None else comments,
		   "down_count": 0 if is_online else _db[mac]["down_count"]
		   }
	return

def get_device_down_count(mac):
	load()
	return _db[mac]["down_count"]

def mark_device_down(mac):
	load()
	_db[mac]["down_count"] +=1
	return

def reset_device_down(mac):
	load()
	_db[mac]["down_count"] = 0
	return


def load(force_reload=False):
	global _db
	# Check is already loaded
	if (_db != None and force_reload==False):
		return _db

	print("--- loading database ---")
	if (os.path.exists(_db_path + "/db.json")):
		with open(_db_path + '/db.json', 'r') as _db_file:
			_db = json.load(_db_file)
	else:
		_db = {}
		save()
	return


def save():
	load()
	print("--- saving database ---")
	#print(_db_path + "/db.json")
	with open(_db_path + "/db.json", "w+") as _db_file:
		_db_file.write(json.dumps(_db, indent=4))
	return

def __init__():
	load()
