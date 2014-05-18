import requests

url='http://localhost/daumenkivy/public/submitZip'

files = {'file': open('test.zip', 'rb')}
params = {
	'caption': 'test_caption',
	'username': 'test_username',
	'email': 'test_email'}

r = requests.post(url, files=files, params=params)

print r.status_code
print r.text
