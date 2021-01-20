from math import log

def nimSplit(a,k):
    bitmask = (1<<k) - 1
    return a>>k, a&bitmask

def nimLength(a):
    return 1 << int(log(log(a,2),2))

def nimSum(arr):
    result = 0
    for i in arr:
        result = result ^ i
    return result

def nimMul(a,b):
    if a == 0 or b == 0:
        return 0
    elif a == 1 or b == 1:
        return a * b
    k = int( max( nimLength(a), nimLength(b) ) )
    p = (1 << k)
    p2 = (1 << k) ^ (1 << k-1)
    a1, a0 = nimSplit(a,k)
    b1, b0 = nimSplit(b,k)
    #print(k, a, a1, a0, b, b1, b0, p, p2, sep='\t')
    return ( nimMul( nimMul(a1,b1),p2 ) ^ ( ( nimMul(a0,b1) ^ nimMul(a1,b0) ) << k ) ^ nimMul(a0,b0) )
    
def nimExp(a,e):
    tmp = a
    result = 1
    while e:
        if e & 1:
            result = nimMul(result, tmp)
        tmp = nimMul(tmp,tmp)
        e = e >> 1
    return result

def nimPow(val, n):
    return [nimExp(val, i) for i in range(n)]

def encode(msg):
    return [ord(c) for c in msg]

def decode(msg):
    return ''.join([chr(i) for i in msg])

def zipWithAdd(arr1, arr2):
    return [ i ^ j  for i, j in zip(arr1, arr2)]
    
def zipWithMul(arr1, arr2):
    return [ nimMul(i,j) for i, j in zip(arr1, arr2)]

def getInv(k, keys):
    return nimExp(keys[1], len(keys) - keys.index(k))

    
def encrypt(msg, key):
    n = len(msg)
    keys = nimPow(key, n)
    coef = (zipWithMul( msg, keys ))[::-1]
    calc = [ nimSum(zipWithMul(coef, nimPow(k,n))) for k in keys ]
    cipher = zipWithAdd( keys, calc )    
    return cipher

def decrypt(cipher, key):
    n = len(cipher)
    keys = nimPow(key, n)
    keysInv = [getInv(k, keys) for k in keys]
    c1 = zipWithAdd(cipher, keys) # calc
    cT = [ nimSum(zipWithMul(c1, nimPow(k,n))) for k in keys ]
    c2 = cT[1:]
    c2.append(cT[0])
    return decode(zipWithMul(c2,keysInv))

def isValidKey(key, n):
    return (nimExp(key,n) == 1) & (not 1 in [nimExp(key, i) for i in range(1,n)])

if __name__ == '__main__':
    cipher = [13,1,114,230,244,145,218,78,204,36,81,48,148,35,40,50,78,40,88,43,122,39,41,149,208,208,191,68,65,61,224,140,18,239,104,210,110,119,178,27,173,253,15,237,85,192,82,74,148,15,250]    
    n = len(cipher)
    for k in range(256):
        if isValidKey(k,n):
            plain = decrypt(cipher,k)
            if 'flag' in plain:
                print(plain)