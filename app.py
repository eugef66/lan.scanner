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


odevices = []
for i in range(148,256):
    
    ip = "192.168.1." +str(i)
    mac=""
    vendor=""
    online = "offline"
    pingResponse = os.system("ping -c1 -w2 "+ ip + " > /dev/null 2>&1")
    if pingResponse == 0:
        online="online"
        mac = get_mac(ip)
        if mac!="":
            vendor = get_vendor(mac)
        device={"ip":ip,"MAC":mac,"vendor":vendor}
        odevices.append(device)
    print (ip + " " + mac + " " + vendor + " " + online)

with open('cache.json','w') as cache_file:
    # Replace with loop through cache file and update attributes or create new - DO NOT OVERWRITE
    json.dump(odevices,cache_file)
    print("Finished")
    
