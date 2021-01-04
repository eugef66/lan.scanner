import requests, time, os, subprocess, re, json
from subprocess import Popen, PIPE



def get_mac(ip):
    mac=""
    try:
        pid = Popen(["arp","-n", ip ],stdout=PIPE)
        mout = str(pid.communicate()[0])
        mac = re.search(r"(([a-f\d]{1,2}\:){5}[a-f\d]{1,2})", mout).groups()[0]
    finally:
        return mac

def get_vendor(mac):
    vendor=""
    # https://api.macvendors.com/d8:eb:97:22:e6:4b
    url = "https://api.macvendors.com/" + mac
    mlr = requests.get(url)
    if mlr.status_code==200:
        vendor = mlr.content 
    time.sleep(1)
    return vendor.decode("utf-8") 

startIP = 1
odevices = {}

print ("Online Devices\n=========================\n")
for i in range(startIP,256):
    ip = "192.168.1." +str(i)
    mac=""
    pingResponse = os.system("ping -c1 -w2 "+ ip + " > /dev/null 2>&1")
    if pingResponse == 0:
        mac = get_mac(ip)
        odevices[mac]=ip
    print (ip + " " + mac + " ")

with open('db.json','w') as db_file:
    db=json.load(db_file)


    #insert missing
    for mac in odevices:
        print(mac + ":" + odevices[mac])
    
    # Update
    for device in db:
        mac = device["mac"]
        if odevices[mac]!=null:
            device["status"]=1
            device["ip"]=odevices[mac]
            if device["vendor"]=="":
                device["vendor"]=get_vendor(mac)
        else
            device["status"]=0
    #json.dump(db,db_file)
    print("Finished")
    
