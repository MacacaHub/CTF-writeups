from scapy.all import *
import re
import base64

pkts = rdpcap('images_0x2.pcap')
for p in pkts:
    if IP in p and p[IP].dst == '140.117.169.219':
        if Raw in p and b'filename' in p[Raw].load:
            raw = p[Raw].load

            filename = re.search(b'filename="(\w*.\w*)"', raw)
            filename = filename.group(1).decode('utf-8')
            
            xor_key = base64.b64decode(raw.split(b'\r\n')[3])
            ciphertext = raw.split(b'\r\n')[7]
            res = []

            res = [ word ^ xor_key[idx % len(xor_key)] for idx, word in enumerate(ciphertext) ]
            img = open(filename, 'wb')
            img.write(bytes(res))
            img.close()
