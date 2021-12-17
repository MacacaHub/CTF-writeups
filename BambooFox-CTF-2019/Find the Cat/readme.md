# Find the Cat

MISC, 122 Points

Writeup By: **yctseng1227**

## Description

The cat is hiding somewhere. Where is the cat?

[cat.png](https://github.com/MacacaHub/CTF-writeups/blob/master/BambooFoxCTF2019/Find%20the%20Cat/cat.png)

## Solution

You can get `cat.png` from the Problem.

use command `binwalk` to get information from the header, then you will find out some "Zlib compressed data" inside.

use command `foremost` to recover the image , you will get other two images and also have zlib inside,  respectively.

use the command below to see the difference between two images in pixels.
```
compare 00000000.png 00000725.png -compose src diff.png
```

and you will get the QR code. (link: [https://imgur.com/download/Xrv86y](https://imgur.com/download/Xrv86y))

After scanning the QR code, you can get the final image, using any text editor or command `strings` to find the flag inside.


**BAMBOOFOX{Y0u_f1nd_th3_h1dd3n_c4t!!!}**
