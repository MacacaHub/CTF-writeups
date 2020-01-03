# Web Newbie

Web, 39 Points

Writeup By: **yctseng1227**

## Description

http://34.82.101.212:8005/ 

http://bamboofox.cs.nctu.edu.tw:8005/ (Backup Server)

Hey, I just learned how to make a web application!

Even though I might create some vulnerabilities, but I bet you'll never get the flag!

The submitted files will be deleted every hour.

## Solution

It seems like you need to create a file and write some code for server.
If you lookup with web source code, you can find somthing below:
```
<!--
	<li class="nav-item">
		<a class="nav-link" href="/myfirstweb/index.php?op=nav&link=hint">Hint</a>
	</li>
-->
```

Then you can try to link "http://bamboofox.cs.nctu.edu.tw:8005/myfirstweb/index.php?op=nav&link=hint", and find out the hint "Flag is in ../flag.txt".

That's all, see "http://bamboofox.cs.nctu.edu.tw:8005/flag.txt" to get the flag. ^_^

**BAMBOOFOX{0hhh_n0_s7up1d_li77l3_8ug}**
