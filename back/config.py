
import os

EMULATE = True

ALERT_NEW_DEVICE = True
ALERT_DOWN_DEVICE = True
ALERT_DOWN_THRESHOLD = 8
ALERT_FROM = 'lan.scanner alert'
ALERT_SUBJECT = 'lan.scanner report'
ALERT_TO = 'user@example.com'
SMTP_SERVER = 'smtp.mailserver.com'
SMTP_PORT = 587
SMTP_USERNAME = 'user@example.com'
SMTP_PASSWORD = 'password2'
WEB_ADMIN_DEVICE_URL = 'http://192.168.1.31/lanscanner/ui/device.php?mac='