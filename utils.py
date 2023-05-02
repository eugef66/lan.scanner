import config
import time
import requests


def get_default_device_name(mac, ip):
	mac = mac.upper()
	ip = _ip_last_number(ip)
	return "(new device)"

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

def _ip_last_number(ip):
	return int(ip.split(".")[3])
# Default process when no method argument provides