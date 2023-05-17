import os

# Uncomment the line below to use RPI emulator and change path to emulators module
# sys.path.append("../pi.emulators")

# Emulate some functionality(not supported by DEV environment) for development only. Set to False in PROD
EMULATE=True

ALERT_NEW_DEVICE = True
ALERT_DOWN_DEVICE = True

ALERT_FROM = "pi.scanner alert"
ALERT_TO =""
ALERT_SUBJECT="pi.scanner report"

SMTP_SERVER = 'smtp.gmail.com'
SMTP_PORT = 587
SMTP_USERNAME = 'user@example.com'
SMTP_PASSWORD = 'password'
EMAIL_TO = "user@gmail.com"

