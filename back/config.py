import os

# Emulate some functionality(not supported by DEV environment) for development only (such as Sending Email and arp-scan on Windows dev machine). Set to False in PROD
EMULATE=True

ALERT_NEW_DEVICE = True
ALERT_DOWN_DEVICE = True
ALERT_DOWN_THRESHOLD = 2  # Number of consecutive down indications before sending alert e.g. run 1 - device down no alert, run 2 - device down send alert

ALERT_FROM = "lan.scanner alert"
ALERT_SUBJECT="lan.scanner report"
ALERT_TO =""

SMTP_SERVER = 'smtp.mailserver.com'
SMTP_PORT = 587
SMTP_USERNAME = 'user@example.com'
SMTP_PASSWORD = 'password'


WEB_ADMIN_DEVICE_URL = "http://192.168.1.31/lanscanner/ui/device.php?mac="

