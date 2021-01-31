#!/usr/bin/env python
import os
import json
import sys

DB = None
APP_PATH = os.path.dirname(os.path.abspath(__file__))

if (sys.version_info > (3,0)):
    exec(open(APP_PATH + "/app.conf").read())
else:
    execfile(APP_PATH +"/app.conf")


#Scan Devices marked "Alert Down"
def scan_down():
    return
#Scan for new devices
def scan_new():
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

def load_config():
    return

def load_db():
    with open(APP_PATH + '/db.json','r') as db_file:
        DB=json.load(db_file)
    return
def save_db():
    with open (APP_PATH + "/db.json","w+") as db_file:
        db_file.write(json.dumps(DB,indent=4))
    return


#Default process when no method argument provides
def main():
    scan_down()
    scan_new()

if __name__=='__main__':
    sys.exit(main())    
    