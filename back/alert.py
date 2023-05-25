import datetime
import socket
import sys, os
# append root folder
sys.path.append (os.path.dirname(os.path.dirname(os.path.abspath(__file__))))

import config as config
import smtplib
from utils import formatTS
import db.db as db
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

_new_devices=[]
_down_devices=[]

# Open html Template
_template_file = open(os.path.dirname(os.path.abspath(__file__)) + '/alert_template.html', 'r') 
_mail_html = _template_file.read() 
_template_file.close() 


def _create_down_alert_report():
	global _mail_html
	message =""
	for mac in _down_devices:
		device = db.get_device(mac)
		message += "<tr>"
		message += "<td width=140> " + mac +" </td>"
		message += "<td width=130> " + device["updateTS"] + " </td>"
		message += "<td width=100> "+ device["ip"] +" </td>"
		message += "<td width=140> "+ device["description"] +" </td>"
		message += "<td> "+ device["vendor"] +" </td>"
		message += "</tr>"
	_mail_html=_mail_html.replace('<TABLE_DEVICES_DOWN>',message)
	return


def _create_new_alert_report():
	global _mail_html
	
	message = ""
	for mac in _new_devices:
		device = db.get_device(mac)
		message += "<tr>"
		message += "<td width=140> " + mac +" </td>"
		message += "<td width=100> "+ device["ip"] +" </td>"
		message += "<td> "+ device["vendor"] +" </td>"
		message += "</tr>"
	_mail_html=_mail_html.replace('<TABLE_NEW_DEVICES>',message)
	return

def appent_new_device(mac):
	_new_devices.append(mac)
	return

def appent_down_device(mac):
	#skip if ALERT DOWN THRESHOLD is not met
	if (db.get_device_down_count(mac) == config.ALERT_DOWN_THRESHOLD-1):
		_down_devices.append(mac)
		db.reset_device_down(mac)
	else:
		db.mark_device_down(mac)
	return

def send_alerts():
	global _mail_html
	_send_alert=False
	if (config.ALERT_NEW_DEVICE and len(_new_devices)>0):
		print (" -- Sending New Device Alert --")
		_create_new_alert_report()
		_send_alert=True
	if (config.ALERT_DOWN_DEVICE and len(_down_devices)>0):
		print (" -- Sending Down Alert --")
		_create_down_alert_report()
		_send_alert=True
	
	if (_send_alert): 
		_mail_html = _mail_html.replace ('<SERVER_NAME>', socket.gethostname() )
		_mail_html = _mail_html.replace ('<REPORT_DATE>', formatTS(datetime.datetime.now()))
		_send_email(config.ALERT_SUBJECT,_mail_html)
	return


def _send_email (subject, HTML_message):
	# Compose email
	msg = MIMEMultipart('alternative')
	msg['Subject'] = subject
	msg['From'] = config.ALERT_FROM
	msg['To'] = config.ALERT_TO
	msg.attach (MIMEText (HTML_message, 'html'))

	# Send mail
	if (config.EMULATE):
		print("Emulate Send Email")
	else:
		smtp_connection = smtplib.SMTP (config.SMTP_SERVER, config.SMTP_PORT)
		smtp_connection.ehlo()
		smtp_connection.starttls()
		smtp_connection.ehlo()
		smtp_connection.login (config.SMTP_USERNAME, config.SMTP_PASSWORD)
		smtp_connection.sendmail (config.ALERT_FROM, config.ALERT_TO, msg.as_string())
		smtp_connection.quit()


