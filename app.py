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
from datetime import datetime



DB = None
DHCP_RESERVATIONS={}
LOCAL_DNS={}

APP_PATH = os.path.dirname(os.path.abspath(__file__))

if (sys.version_info > (3,0)):
    exec(open(APP_PATH + "/app.conf").read())
else:
    execfile(APP_PATH +"/app.conf")


#Scan for new devices
def scan_network():
    if (DB==None):
        _load_db()

    
    #Step 1. Scan online devices using arp-scan

    online_devices = _load_arp_scan()
    #compare output with DB to find new and trigger "offline alert"
    for device in online_devices:
        mac = device["mac"]
        ip = device["ip"]
        vendor = device["vendor"]
        if (mac in DB):
            if (DB[mac]["alert_down"]):
                _send_down_alert(mac)
        create_update_device(False,mac=mac,ip=ip,is_online=True, vendor=vendor)

    #Step 2. Get current dhcp_lease from PIHOLE DHCP

    if (PIHOLE_DHCP_ENABLED):
        dhcp_leases = _load_DHCP_leases()
        for device in dhcp_leases:
            mac = device["mac"]
            ip = device["ip"]
            hostname = device["hostname"]
            create_update_device(False,mac=mac,ip=ip,hostname=hostname)
    # Step 3. Get current pihole network devices 
    if (PIHOLE_ENABLED):
        print ("--- Scanning PIHOLE Network ---")
        clients = _load_pihole_network()
        for device in clients:
            mac = device["mac"]
            ip = device["ip"]
            vendor = device["vendor"]
            create_update_device(False,mac=mac,ip=ip,vendor=vendor)


    _save_db()
    return
def get_default_device_name(mac,ip):
    mac = mac.upper()
    ip=_ip_last_number(ip)
    if (mac in DHCP_RESERVATIONS):
        return DHCP_RESERVATIONS[mac]["hostname"]
    elif (ip in LOCAL_DNS):
        return LOCAL_DNS[ip]
    return "(new device)"
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

"""
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
"""



def create_update_device(save_to_db, mac,ip,is_online=None,description=None, alert_down=None,hostname=None,vendor=None,is_new=None):
    if DB==None:
        _load_db()
    
    if (mac not in DB):
        default_device_name = get_default_device_name(mac,ip)
        if (is_new==None):
            isnew=True
        if (description == None):
            description=default_device_name
        if (hostname == None):
            hostname = get_default_device_name(mac,ip)
        if (alert_down == None):
            alert_down=False
        if (is_online==None):
            is_online=False
        if (vendor==None):
            vendor = get_vendor_by_mac(mac)
        print ("--- Creating New Device ---")
        print ("--- --- " + mac + " | " + vendor + " | " + description + " | " + ip )
    else:
        if (is_new==None):
            isnew=DB[mac]["is_new"]
        if (description == None):
            description=DB[mac]["description"]
        if (hostname == None):
            hostname = DB[mac]["hostname"]
        if (alert_down == None):
            alert_down=DB[mac]["alert_down"]
        if (is_online==None):
            is_online=DB[mac]["is_online"]
        if (vendor==None):
            vendor = DB[mac]["vendor"]
        print ("--- Updating Existing Device ---")
        print ("--- --- " + mac + " | " + vendor + " | " + description + " | " + ip )

    DB[mac]={"ip":ip,
            "is_online":is_online,
            "description":description,
            "vendor":vendor,
            "hostname":hostname,
            "alert_down":alert_down,
            "updateTS": datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
            "is_new":isnew
            }
    if (save_to_db):
        _save_db()
    return

def _load_arp_scan():
    devices =[]
    arpscan_output = subprocess.check_output (['sudo', 'arp-scan', '--localnet', '--ignoredups', '--retry=1'], universal_newlines=True)
    lineindex=1
    number_of_cleints = len(arpscan_output.splitlines())-2
    for line in arpscan_output.splitlines():
        lineindex+=1
        if lineindex<4 or lineindex>number_of_cleints:
            continue 
        device = line.split('\t')
        devices.append({"ip":device[0],
                        "mac": device[1],
                        "vendor":device[2]})
    return devices

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

    #Load MetaData

    global DHCP_RESERVATIONS
    global LOCAL_DNS
    if (PIHOLE_DHCP_ENABLED):
        #load DHCP Reservations 
        with open(PIHOLE_DHCP_RES_FILE,'r') as dres_file:
            for line in dres_file.readlines():
                device = line.split(",")
                if (len(device)>=3):
                    mac = device[0].replace("dhcp-host=","").upper()
                    ip = device[1]
                    hostname =device[2].replace("\n","")
                    DHCP_RESERVATIONS[mac]={"ip":ip,"hostname":hostname}


        
    #load Local DNS custom list
    with open(PIHOLE_LOCAL_DNS_FILE,'r') as dres_file:
        for line in dres_file.readlines():
            device=line.split(" ")
            if(len(device)>=2):
                ip = _ip_last_number(device[0])
                hostname = device[1].replace("\n","")
                LOCAL_DNS[ip]=hostname
    return

def _save_db():
    with open (APP_PATH + "/db.json","w+") as db_file:
        db_file.write(json.dumps(DB,indent=4))
    return

def _send_down_alert(mac):
    return
def _ip_last_number(ip):
    return int(ip.split(".")[3])
#Default process when no method argument provides
def main():
    _load_db()
    #scan_down()
    scan_network()

if __name__=='__main__':
    sys.exit(main())    
    