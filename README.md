# hackaton-2017-hopeit
hopeit

https://hopeit-43bb7.firebaseio.com/

http://noszkurwa.com/hakaton/braintree/processCard.php



postowanie w pythonie:

import httplib, urllib
params = urllib.urlencode({'amount': 12524, "payment_method_nonce": "3a874757-ac7d-0ef5-7471-39bfe02b9516"})
headers = {"Content-type": "application/x-www-form-urlencoded",
            "Accept": "text/plain"}
conn = httplib.HTTPConnection("nice-idea.org")
conn.request("POST", "/hakaton/braintree/processCard.php", params, headers)
response = conn.getresponse()
print response.status, response.reason
data = response.read()
conn.close()


