#!/usr/bin/env python
# -*- coding: utf-8 -*-

from pwn import *
from string import ascii_lowercase
from itertools import product

conn = remote("challs.xmas.htsp.ro", 13003)
conn.recvline()

conn.recvuntil("answer:")
conn.sendline("qubit")
conn.recvuntil("answer:")
conn.sendline("bloch sphere")
conn.recvuntil("answer:")
conn.sendline("superposition")
conn.recvuntil("answer:")
conn.sendline("entanglement")
conn.recvuntil("answer:")
conn.sendline("bra-ket")

conn.recvuntil("answer:")
conn.sendline("hadamard")
conn.recvuntil("answer:")
conn.sendline("cnot")
conn.recvuntil("answer:")
conn.sendline("pauli z")
conn.recvuntil("answer:")
conn.sendline("Wolfgang Pauli")
conn.recvuntil("answer:")
conn.sendline("unitary")

conn.recvuntil("answer:")
conn.sendline("|->")
conn.recvuntil("answer:")
conn.sendline("yes")
conn.recvuntil("answer:")
conn.sendline("yes")
conn.recvuntil("answer:")
conn.sendline("0.5")
conn.recvuntil("answer:")
conn.sendline("Schrodinger's Cat")

conn.recvuntil("answer:")
conn.sendline("no")
conn.recvuntil("answer:")
conn.sendline("yes")
conn.recvuntil("answer:")
conn.sendline("no")
conn.recvuntil("answer:")
conn.sendline("yes")
conn.recvuntil("answer:")
conn.sendline("yes")

line = conn.recvuntil('\n')
print(line)
conn.interactive()