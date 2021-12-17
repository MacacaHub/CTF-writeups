#!/usr/bin/python3
# -*- coding: utf-8 -*-
import string

payload = list(string.ascii_letters + string.digits)
ans = [0] * 20
for i in payload:
    ans[0] = ord(i)
    ans[1] = 185 - ans[0]
    ans[2] = 212 - ans[1]
    ans[3] = 172 - ans[2]
    ans[4] = 145 - ans[3]
    ans[5] = 185 - ans[4]
    ans[6] = 212 - ans[5]
    ans[7] = 172 - ans[6]
    ans[8] = 177 - ans[7]
    ans[9] = 217 - ans[8]
    ans[10] = 212 - ans[9]
    ans[11] = 204 - ans[10]
    ans[12] = 177 - ans[11]
    ans[13] = 185 - ans[12]
    ans[14] = 212 - ans[13]
    ans[15] = 204 - ans[14]
    ans[16] = 209 - ans[15]
    ans[17] = 161 - ans[16]
    ans[18] = 124 - ans[17]
    ans[19] = 172 - ans[18]
    if 177 - ans[19] == ans[0]:
        print("".join(map(chr, ans)))