# Gamer's Cipher

Crypto

Writeup By: **arikoi0703**

## Description

I heard that Mr. Grundy is very famous for his knowledge in games.

nc chall.ctf.bamboofox.tw 10269

Author: toxicpie

## Solution

In 'Main.hs' and 'Nim.hs', we can learn how to encrypt the flag.

I use python to simulate the Nim, and test the encrypt steps.
Then, adjust the parameter and reverse the encrypt steps to decrypt it.
As in 'crack.py'.

The behavior of Nim and the encrypt scheme can be seen in 'crack.py', too.
If haskell is hard to read.

**flag{did_you_solve_with_dft_or_lagrange_polynomial}**