import requests, time, os, subprocess, re, json,getmac, sys, signal
from subprocess import Popen, PIPE
from getmac import get_mac_address

def exit_app(sig, frame):
    print ("Exiting application")
    sys.exit(0)

def get_mac(ip):
    try:
        mac=getmac.get_mac_address(ip=ip, network_request=True)
        mac=mac.upper()
        return mac
    except:
        return getmac.get_mac_address()
    #mac=""
    #try:
        #pid = Popen(["arp","-n", ip ],stdout=PIPE)
        #mout = str(pid.communicate()[0])
        #mac = re.search(r"(([a-f\d]{1,2}\:){5}[a-f\d]{1,2})", mout).groups()[0]
    #finally:
    #    return mac

def get_vendor(mac):
    vendor=""
    try:
        # https://api.macvendors.com/d8:eb:97:22:e6:4b
        url = "https://api.macvendors.com/" + mac
        mlr = requests.get(url)
        if mlr.status_code==200:
            vendor = mlr.content 
        time.sleep(1)
        return vendor.decode("utf-8")
    except:
        return "(Vendor Lookup Error)"

def refresh_vendors():
    with open('db.json','r') as db_file:
        db=json.load(db_file)
        for mac in db:
            device = db[mac]
            device["vendor"]=get_vendor(mac)
    with open ("db.json","w") as db_file:
    json.dump(db,db_file)
    print ("Vendors refreshed")
    

signal.signal(signal.SIGINT,exit_app)

startIP = 1
endIP = 255
if len(sys.argv)>1:
    startIP=int(sys.argv[1])
if len(sys.argv)>2:
    endIP=int(sys.argv[2])
#print (str(sys.argv))

odevices = {}
print ("Scan Started 192.168.1." + str(startIP) + " - 192.168.1."+ str(endIP) +"\n=========================\n")
for i in range(startIP,(endIP+1)):
    ip = "192.168.1." +str(i)
    mac=""
    status = 0
    pingResponse = os.system("ping -c1 "+ ip + " > /dev/null 2>&1")
    if pingResponse == 0:
        mac = get_mac(ip)
        odevices[mac.upper()]=ip
        status=1
    print (ip + " " + (mac if status==1 else "offline"))

with open('db.json','r') as db_file:
    db=json.load(db_file)


    #insert missing
    print ("Scan Finished\nOnline Devices")
    for mac in odevices:
        print (mac + " @ " + odevices[mac])
        if mac not in db:
            db[mac]={"ip":odevices[mac],"description":"","vendor":"","status":1,"host":""}
            print("creating new " + mac + ":" + odevices[mac])
    
    # Update
    for mac in db:
        device=db[mac]
        if mac in odevices:
            device["status"]=1
            device["ip"]=odevices[mac]
            if device["vendor"]=="":
                device["vendor"]=get_vendor(mac)
        else:
            device["status"]=0
with open ("db.json","w") as db_file:
    json.dump(db,db_file)
print("db.json updated")
    
