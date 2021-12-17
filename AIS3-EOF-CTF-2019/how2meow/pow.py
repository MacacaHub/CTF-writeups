#!/usr/bin/env python3
import itertools
import string
from hashlib import *
from pwn import *

cond = "kaibro"
#cond = r.recvuntil("'").decode('ascii').rstrip("'")
ans = ''
alphanumeric = string.ascii_uppercase + string.ascii_lowercase + string.digits
for s in itertools.product(alphanumeric, repeat=4):
    if md5(('%s%s'%(cond, ''.join(s))).encode('utf-8')).hexdigest().startswith('6b509'):
        ans = cond + ''.join(s)
        break

print(ans)
