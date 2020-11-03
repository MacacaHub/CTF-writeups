from scapy.all import *

pkts = rdpcap('reverse_shell.pcap')

with open('out.raw', 'w') as f:
    for p in pkts:
        if 'IP' in p and ( p['IP'].src == '45.79.159.73' or p['IP'].dst == '45.79.159.73' ):
            if 'Raw' in p and ( p['TCP'].sport==39637 or p['TCP'].dport==39637 ):
                #f.write(p['Raw'].load)
                raw = p['Raw'].load
                xor_passwd = "x0R_"
                res = ""
                for idx, word in enumerate(raw):
                    res += chr(word ^ ord(xor_passwd[idx%4]))
                    #print(chr(res), end="")
                print(res, end="")
                f.write(res)
