import os
import config
import json

_db=None

def _load_db(force_reload=False):
	global _db
	# Check is already loaded
	if (_db != None and force_reload==False):
		return _db

	print("--- loading metadata ---")
	if (os.path.exists(config.APP_PATH + "/db/metadata.json")):
		with open(config.APP_PATH + '/db/metadata.json', 'r') as _db_file:
			_db = json.load(_db_file)
	else:
		_db = {}
		_save_db(_db)
	return _db

def _save_db(_db):
	with open(config.APP_PATH + "/db/metadata.json", "w+") as _db_file:
		_db_file.write(json.dumps(_db, indent=4))
	return

def get_locations(self):
	#_load_db()
	return _db["location"]

def get_device_types(self):
	#_load_db()
	return _db["device-type"]

def get_owners(self):
	#_load_db()
	return _db["owner"]


def __init__(self):
	self._load_db()