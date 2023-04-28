#!/usr/bin/env python
import os
import json
import config


DB=None


def create_update_device(save_to_db, mac, ip, is_online=None, description=None, alert_down=None, hostname=None, vendor=None, is_new=None):
	if DB == None:
		DB=load_db()

	ip4 = None
	ip6 = None
	if (":" in ip):
		ip6 = ip
	else:
		ip4 = ip

	if (mac not in DB):
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
			ip4 = DB[mac]["ip"]
		if (ip6 == None):
			ip6 = DB[mac]["ip6"]
		if (is_new == None):
			isnew = DB[mac]["is_new"]
		if (description == None):
			description = DB[mac]["description"]
		if (hostname == None):
			hostname = DB[mac]["hostname"]
		if (alert_down == None):
			alert_down = DB[mac]["alert_down"]
		if (is_online == None):
			is_online = DB[mac]["is_online"]
		if (vendor == None):
			vendor = DB[mac]["vendor"]
		if (DB[mac]["alert_down"] and not is_online):
			_send_down_alert(mac)
		print("--- Updating Existing Device ---")
		print("--- --- " + mac + " | " + vendor + " | " + description + " | " + ip)
		
		if (DB[mac]["alert_down"] and not is_online):
			_down_devices.append(mac)


	DB[mac] = {"ip": ip4,
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
		save_db(DB)
	return

def load_db():
	global DB
	print("--- loading database ---")
	if (os.path.exists(config.APP_PATH + "/db.json")):
		with open(config.APP_PATH + '/db.json', 'r') as db_file:
			DB = json.load(db_file)
	else:
		DB = {}
		save_db(DB)
	return DB


def save_db(db):
	with open(config.APP_PATH + "/db.json", "w+") as db_file:
		db_file.write(json.dumps(db, indent=4))
	return

