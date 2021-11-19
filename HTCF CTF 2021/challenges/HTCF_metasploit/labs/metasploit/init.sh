#!/bin/bash
groupadd mlineterm;
while read line; 
do 
    line="$(echo $line | tr -d '\r')";
    mkdir -m 777 /home/$line;
    chgrp mlineterm /home/$line;
    useradd $line -g mlineterm -d /home/$line -s /bin/sh;
    echo "$line:$line" | chpasswd;
done < $1
/usr/sbin/sshd -D;