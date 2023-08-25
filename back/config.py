
import os

EMULATE=True

ALERT_NEW_DEVICE = False
ALERT_DOWN_DEVICE = False
ALERT_DOWN_THRESHOLD = 2
ALERT_FROM = 'lan.scanner alert'
ALERT_SUBJECT='lan.scanner report'
ALERT_TO =''
SMTP_SERVER = 'smtp.mailserver.com'
SMTP_PORT = 587
SMTP_USERNAME = 'user@example.com'
SMTP_PASSWORD = 'password'
WEB_ADMIN_DEVICE_URL = 'http://localhost:8000/ui/device.php?mac='