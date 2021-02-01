from bottle import route, run, template, jinja2_template as template, static_file, redirect, request

@route('/')
def index():
	return template('index.html')
