#!/usr/bin/env python
import os
import json

_db=None

_db_path = os.path.dirname(os.path.abspath(__file__))

def load(force_reload=False):
	global _db
	# Check is already loaded
	if (_db != None and force_reload==False):
		return _db

	print("--- loading metadata ---")
	if (os.path.exists(_db_path + "\\metadata.json")):
		with open(_db_path + '\\metadata.json', 'r') as _db_file:
			_db = json.load(_db_file)
	else:
		_db = {}
		save(_db)
	return _db

def save():
	with open(_db_path + "\\metadata.json", "w+") as _db_file:
		_db_file.write(json.dumps(_db, indent=4))
	return

def get_locations():
	load()
	return _db["location"]

def get_device_types():
	load()
	return _db["device-type"]

def get_owners():
	load()
	return _db["owner"]


def __init__(self):
	self._load_db()