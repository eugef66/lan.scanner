#!/usr/bin/env python
import os
import json
import sys
import uuid
import requests
import subprocess
import re
from subprocess import Popen, PIPE




DB = None
APP_PATH = os.path.dirname(os.path.abspath(__file__))

if (sys.version_info > (3,0)):
    exec(open(APP_PATH + "/app.conf").read())
else:
    execfile(APP_PATH +"/app.conf")


#Scan Devices marked "Alert Down"
def scan_down():
    if (DB==None):
        _load_db()
    
#    for mac in DB:
#        print (mac + " -> " + DB[mac]["description"])
    
    return
#Scan for new devices
def scan_new():
    if (DB==None):
        _load_db()
    
    print ("--- Starting IP Scan --")
    
    for i in range(1,256):
        ip = IP_MASK +str(i)
        mac=""
        is_online = False
        
        pingResponse = os.system("ping -c1 -w1 "+ ip + " > /dev/null 2>&1")
        if pingResponse == 0:
            mac = get_mac_by_ip(ip)
            is_online=True
            if (mac not in DB):
                create_update_device(False,mac,ip,is_online,"",False,"")
            else:
                create_update_device(False,mac,ip,is_online,DB[mac]["description"],DB[mac]["alert_down"],DB[mac]["hostname"])


    _save_db()
    return

# Get Vendor Name by MAC
def get_vendor_by_mac(mac):
    vendor=""
    try:
        # https://api.macvendors.com/d8:eb:97:22:e6:4b
        url = "https://api.macvendors.com/" + mac
        mlr = requests.get(url)
        if mlr.status_code==200:
            vendor = mlr.content 
        return vendor.decode("utf-8")
    except:
        return "(Vendor Lookup Error)"

def get_mac_by_ip(ip):
     mac=""
     try:
         pid = Popen(["arp","-n", ip ],stdout=PIPE)
         mout = str(pid.communicate()[0])
         mac = re.search(r"(([a-f\d]{1,2}\:){5}[a-f\d]{1,2})", mout).groups()[0]
     except:
         #get current machine's MAC address
         mac=(':'.join(['{:02x}'.format((uuid.getnode() >> ele) & 0xff) for ele in range(0,8*6,8)][::-1])) 
     finally:
        return mac

def create_update_device(saveto_db, mac,ip,is_online,description, alert_down,hostname):
    if DB==None:
        _load_db()
    
    
    #TODO: if description or hostname is empty get from pihole
    vendor=""
    if (mac in DB):
        vendor = DB[mac]["vendor"]
    else:
        vendor = get_vendor_by_mac(mac)

    DB[mac]={"ip":ip,
            "is_online":is_online,
            "description":description,
            "vendor":vendor,
            "hostname":hostname,
            "alert_down":alert_down
            }
    print ("--- Creating New Device ---")
    print (DB[mac])
    if (saveto_db):
        _save_db()
    return

def _load_db():
    print ("--- loading database ---")
    global DB
    if (os.path.exists(APP_PATH + "/db.json")):
        with open(APP_PATH + '/db.json','r') as db_file:        
            DB=json.load(db_file)
    else:
        DB={}
        _save_db()

    return
def _save_db():
    with open (APP_PATH + "/db.json","w+") as db_file:
        db_file.write(json.dumps(DB,indent=4))
    return


#Default process when no method argument provides
def main():
    _load_db()
    scan_down()
    scan_new()

if __name__=='__main__':
    sys.exit(main())    
    