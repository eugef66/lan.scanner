#!/usr/bin/env python
import os
import json
import sys
import uuid
import requests
import subprocess
import re
import time
import sqlite3
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
def scan_network():
    if (DB==None):
        _load_db()

    if (PIHOLE_DHCP_ENABLED):
        print ("--- Scanning PIHOLE DHCP Leases ---")
        dhcp_leases = _load_DHCP_leases()
        for device in dhcp_leases:
            mac = device["mac"]
            ip = device["ip"]
            hostname = device["hostname"]
            if (mac not in DB):    
                create_device(False,mac,ip,False,None,None,hostname,None)
            else:
                update_device(False,mac,ip,None,DB[mac]["description"],DB[mac]["alert_down"],hostname,DB[mac]["vendor"])

    if (PIHOLE_ENABLED):
        print ("--- Scanning PIHOLE Network ---")
        clients = _load_pihole_network()
        for device in clients:
            mac = device["mac"]
            ip = device["ip"]
            vendor = device["vendor"]
            if (mac not in DB):    
                create_device(False,mac,ip,True,None,None,None,vendor)
            else:
                update_device(False,mac,ip,True,DB[mac]["description"],DB[mac]["alert_down"],DB[mac]["hostname"],vendor)
    if (PING_ALL):
        print ("--- Pinging all IPs (1-255) ---")
        for i in range(1,256):
            ip = IP_MASK +str(i)
            mac=""
            is_online = False
            pingResponse = os.system("ping -c1 -w1 "+ ip + " > /dev/null 2>&1")
            print (ip + " online" if pingResponse == 0 else " offline")
            if pingResponse == 0:
                mac = get_mac_by_ip(ip)
                is_online=True
                if (mac not in DB):
                    create_device(False,mac,ip,is_online,None,False,None,None)
                else:
                    update_device(False,mac,ip,is_online,DB[mac]["description"],DB[mac]["alert_down"],DB[mac]["hostname"],DB[mac]["vendor"])
    


    _save_db()
    return

# Get Vendor Name by MAC
def get_vendor_by_mac(mac):
    vendor=""
    try:
        # https://api.macvendors.com/d8:eb:97:22:e6:4b
        time.sleep(1)
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

def create_device(save_to_db, mac,ip,is_online,description, alert_down,hostname,vendor):

    if (description == None):
        description="(from pihole)" #TODO: Get from pihole
    if (hostname == None):
        hostname = "(from pihole)" #TODO: Get from pihole
    if (alert_down == None):
        alert_down=False
    if (is_online==None):
        is_online=False
    if (vendor==None):
        vendor = get_vendor_by_mac(mac)
    _create_update_device(save_to_db,mac,ip,is_online,description,alert_down,hostname,vendor)
    return

def update_device(save_to_db, mac,ip,is_online,description, alert_down,hostname,vendor):
    _create_update_device(save_to_db,mac,ip,is_online,description,alert_down,hostname,vendor)
    return

# Private Util methods

def _create_update_device(save_to_db, mac,ip,is_online,description, alert_down,hostname,vendor):
    if DB==None:
        _load_db()
    DB[mac]={"ip":ip,
            "is_online":is_online,
            "description":description,
            "vendor":vendor,
            "hostname":hostname,
            "alert_down":alert_down
            }
    print ("--- Creating New Device ---")
    print (DB[mac])
    if (save_to_db):
        _save_db()
    return

def _load_pihole_network():
    clients =[]
    conn = sqlite3.connect(PIHOLE_NETWORK_DB)
    cur = conn.cursor()
    cur.execute("SELECT hwaddr, macVendor, ip FROM network n INNER JOIN network_addresses na ON n.id=na.network_id")
    rows = cur.fetchall()

    for row in rows:
        clients.append({"mac":row[0],"vendor":row[1],"ip": row[2]})
    
    conn.close()
    return clients

def _load_DHCP_leases():
    dhcp_leases = []
    with open (PIHOLE_DHCP_LEASE_FILE,"r") as dhcp_file:
       for line in dhcp_file.readlines():
           device = line.split(' ')
           dhcp_leases.append({"mac":device[1],"ip":device[2],"hostname":device[3]})
    
    return dhcp_leases



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
    #scan_down()
    scan_network()

if __name__=='__main__':
    sys.exit(main())    
    