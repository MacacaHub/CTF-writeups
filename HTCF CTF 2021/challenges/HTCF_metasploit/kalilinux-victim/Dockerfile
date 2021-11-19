From tleemcjr/metasploitable2

# RUN apt install -y \
#     wget \
#     build-essential

# RUN wget https://ftp.osuosl.org/pub/blfs/conglomeration/proftpd/proftpd-1.3.0.tar.bz2 && \
#     tar xf proftpd-1.3.0.tar.bz2 && \
#     cd proftpd-1.3.0 && \
#     ./configure --prefix=/var/proftpd --sysconfdir=/etc --enable-ctrls && \
#     make && \
#     make install

# RUN groupadd proftpd && \
#     useradd ftpmeow -g proftpd -d /var/ftp -s /sbin/nologin && \
#     echo '/sbin/nologin' >> /etc/shells && \
#     mkdir /var/ftp && \
#     chgrp proftpd /var/ftp && \
#     echo 'ftpmeow:fttmoow' | chpasswd

# RUN sed -i 's/21/2211/' /etc/proftpd.conf

# CMD ["/bin/sh", "/var/proftpd/sbin/proftpd"]
