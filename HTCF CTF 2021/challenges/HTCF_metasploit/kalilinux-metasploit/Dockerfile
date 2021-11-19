From kalilinux/kali-rolling

RUN apt update \
    && apt install -y openssh-server \
    && mkdir /var/run/sshd \
    && sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config \
    && sed -i 's/#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config \
    && sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config \
    && echo 'root:r00t' | chpasswd

RUN apt install -y \
    nmap \
    metasploit-framework \
    postgresql \
    postgresql-contrib

RUN service postgresql start

EXPOSE 22
