
# Uncomment the line below to use RPI emulator and change path to emulators module
# sys.path.append("../pi.emulators")


PIHOLE_ENABLED = True
PIHOLE_NETWORK_DB="/etc/pihole/pihole-FTL.db"

PIHOLE_DHCP_ENABLED = True 
PIHOLE_DHCP_LEASE_FILE="/etc/pihole/dhcp.leases"
PIHOLE_DHCP_RES_FILE = "/etc/dnsmasq.d/04-pihole-static-dhcp.conf"

PIHOLE_LOCAL_DNS_FILE = "/etc/pihole/custom.list"

ALERT_NEW_DEVICE = True

SMTP_SERVER = 'smtp.gmail.com'
SMTP_PORT = 587
SMTP_USERNAME = 'user@gmail.com'
SMTP_PASSWORD = 'password'
EMAIL_TO = "user@gmail.com"
