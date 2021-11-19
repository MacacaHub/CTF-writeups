# Hacker And Forensic Midterm CTF Writeup

[toc]

## First

### [50] welcome
:::info
駭客貓貓歡迎你，餵食駭客貓貓flag，駭客貓貓就會給你滿滿的點數喔

flag{happy_meow_hacker}
:::
:::success
繳交即可獲得50點
請注意flag格式，只有flag{*}的東西是正確的flag，其他東西都只是過程而已。
:::

## metasploit

### [40] lost food
:::info
駭客貓貓在攻擊目標 (172.63.0.21) 中途把食物弄丟了！

回來的駭客貓貓又餓又累，看起來是不能親自取回食物了，請進入駭客貓貓的家，入侵目標，幫駭客貓貓找回他的食物！

>s...am...b...a...
>2...0...07...24...4...7...
>by 駭客貓貓

註記：
請利用ssh連線至主機後在主機上操作。
ssh帳號與密碼都是學號，可登入後自行修改
ssh mid.macacahub.tw -p 22000 -l "帳號"
:::
:::warning
hint
> CVE
:::
:::success
駭客貓貓留下兩句話，一句話透漏主機有 samba 的弱點，而另一句話則是暗示 CVE-2007-2447。
連入主機後先用 nmap 掃描靶機確認漏洞。
> ![](https://i.imgur.com/jbZybi3.png)

開的 port 不多，samba 預設的 port 就是 445。

使用 msfconsole 進入 metasploit 後搜尋 samba 的模組。
```shell=
msf> search samba
```
> ![](https://i.imgur.com/uWPMfOf.png)

根據題意，搜尋 [20072447](https://bfy.tw/S2vX) 後應可查到唯一的 Samba Usermap Script 漏洞，請使用對應的 module。

```shell=
msf> use exploit/multi/samba/usermap_script
msf> show options
```
> ![](https://i.imgur.com/5pAXJbj.png)

照選項填完 RHOST 以及 RPORT 即可，因不是考點，該題不需修改其他東西。
取得 shell 後應可看到 hacker_meow 留下的flag
:::

## hash

### [40] hash meow
:::info
駭客貓貓不小心把晚餐鎖起來了，都是密碼被hash的錯，成為hash meow hacker，幫駭客貓貓找回root密碼！

請利用找到的密碼連入mid.macacahub.tw:20000，取得hacker_meow的晚餐。

對了，為了方便鎖匠作業，駭客貓貓的密碼好像都從10k-most-common.txt裡面選的樣子。

ssh mid.macacahub.tw -p 20000 -l root
:::
:::warning
hint
> [hashcat tutorial](https://resources.infosecinstitute.com/topic/hashcat-tutorial-beginners/)
> [check the hash type](https://hashes.com/en/tools/hash_identifier)
:::
:::success
根據題意敘述，我們需要先幫駭客貓貓找到正確的密碼。
可以使用 hashcat 或是 john the ripper，不過駭客貓貓比較喜歡 hashcat。

跟據題意 shadow 內只有 root 是需要處理的。
> root:$1$InVghphs$she/yWspL6ZLxW.gss2r00:0:0:root:/root:/bin/bash

關於 shadow 可以上[這裡](https://blog.gtwang.org/linux/linux-etc-shadow-file-format/)看看，不過其實不用太在意，整串丟給 hashcat 即可。
[10k-most-common.txt](https://github.com/danielmiessler/SecLists/blob/master/Passwords/Common-Credentials/10k-most-common.txt)
如果執行有誤，記得確認 hash type。
再結合題目提供的字典檔，可以完成以下的指令。
```shell=
hashcat -m 500 -a 0 shadow 10k-most-common.txt
hashcat -m 500 -a 0 shadow 10k-most-common.txt --show
> ![](https://i.imgur.com/Q6weUZL.png)
```

之後利用 root:jojojo 連入主機應可看到 hacker_meow 留下的flag
:::

## port scan

### [40] monkeys' island
:::info
駭客貓貓在猴子島觀光時被猴子打跑了，flag也被猴子搶走了！

好不容易跑出猴子島的駭客貓貓也忘記如何前往猴子島了，依稀記得島上 (mid.macacahub.tw) 的50000號港口到60000號港口間有船隻前往

請幫駭客貓貓找到猴子島入口，搶回flag！
:::
:::warning
hint
> nmap -p XXXX-XXXX
> the monkeys' name?
:::
:::success
依據題意需先掃描 port 找到正確的港口。
> ![](https://i.imgur.com/EJTcFEC.png) 

之後上[島](mid.macacahub.tw:55555)抓猴子。
> ![](https://i.imgur.com/ZDglyh7.png)
島上有五隻猴子，除了正確的猴子，其他猴子都只會亂叫。
> > oo oa aa ao aaa a oooo oa aoao aoa o oao aa aaa ao aoa o aoaa
> > [name=monkey]

抓猴子有幾種作法。
縮小視窗關猴子，或是利用f12觀察每個猴子手上的flag。
從 flag.php 到 flllllag.php 都點過後應可取得flag


> 小彩蛋，把猴子說的話，o視作短音，a視作長音，可以解開摩斯密碼
> iamnothackermonkey
> [name=normal monkey]
:::

## forensic

### [40] packet 1
:::info
駭客貓貓想要這個網站的flag

駭客貓貓發現有人嘗試登入這個網站，駭客貓貓很聰明，他偷偷的錄下登入的封包，只是封包太多了

請幫駭客貓貓找出正確的帳號及密碼，把網站內的flag送給駭客貓貓！

http://mid.macacahub.tw:10110
:::
:::warning
hint
> 目標主機IP？
> 協定？
:::
:::success
該題為封包分析。目的為取得帳號及密碼。
在忽略少許封包後，第一筆HTTP封包便可以看出一些資訊。
> ![](https://i.imgur.com/dmuiDgu.png)

但嘗試後該組帳號密碼是錯誤的。
可以直接尋找下一筆 HTTP 封包，或是利用 filter 過濾。
可使用 ip.addr == 140.117.176.121 或是 http。
過濾後會簡潔許多，嘗試每組帳號密碼後應可取得flag。
:::

### [30] packet 2
:::info
哦哦，駭客貓貓似乎嗅到flag的味道了！

可是網站管理員很聰明，他們似乎打算用圖片把密碼傳出去！

請幫駭客貓貓還原圖片，找出密碼，取出flag！

http://mid.macacahub.tw:10120

對了，密碼似乎是個四位數的樣子！
:::
:::warning
hint
> https://hexed.it/
> 這裡可以寫16進制資料唷
:::
:::success
先致歉，這題其實不需要使用 hex editor，但是出題者只會 hex editor 才會把 hint 寫成這樣。

一樣觀察封包，應可發現有 GET /01.png 的流量，呼應題目所說用圖片傳送密碼。
> ![](https://i.imgur.com/0dfeGf0.png)

此處可以使用 wireshark 的功能將圖片 dump 出來。
> ![](https://i.imgur.com/Slqonou.png)
> File > Export Objects > HTTP

應可看到該封包內所有的圖片。
> ![](https://i.imgur.com/WeLJ55n.png)

儲存後利用密碼登入題目敘述的網站即可取得flag


> 其他解法：
> 1. 親手利用 hex editor 把圖片取出
> 2. 密碼只有一萬種可能，可以用腳本暴力猜測
:::

## sql

### [40] let cat in 1
:::info
駭客貓貓找到一個神奇的登入頁面，裡面貌似傳出flag的香味，請幫駭客貓貓取得flag！

但聽說flag只有admin可以取得？

http://mid.macacahub.tw:10210
:::
:::warning
hint
> https://en.wikipedia.org/wiki/SQL_injection
:::
:::success
直接連入網站後，可以發現網站有提供Magic，是檢查payload完整的好工具。
會告訴你帳號密碼輸入後的sql語法長什麼樣子。
> ![](https://i.imgur.com/iNWshGV.png)



因為是第一題，設定上沒有擋任何字元，只需要基本的 SQL Injection 語法即可。
1. admin' ; -- 
> 利用註解讓與法變成下面的形式，註解後的東西( ' ADN password = ''; )不執行。
> SELECT * FROM Users WHERE username = 'admin' ; -- ' AND password = '';
> 帳號：admin' ; -- 
> 密碼：隨意輸入
2. ' OR '1' = '1
> 使where判斷恆為True以繞過，因為判斷順序的關係，須放在密碼欄位才有效。
> 帳號：admim
> 密碼：' OR '1'='1

登入後即可取得flag
:::

### [30] let cat in 2
:::info
meow~ meow~ 這裡面似乎有更香的flag，可是防護看起來更嚴密了，請幫駭客貓貓取得flag！

註記：帳號請登入admin

http://mid.macacahub.tw:10220
:::
:::warning
hint
>1 > 1 ?
1 < 1 ?
1 <> 1 ?
1 = 1 !!
:::
:::success
這次提供網頁原始碼，不提供Magic，觀察原始碼發現網站會驗證輸入。
不得使用 ';' 、 '--' 、 '#' 及 '=' 這四種輸入
因此第一題適用的註解法在第二題理論上行不通。
利用OR使判斷條件恆為True也會卡在=不能輸入。
但是並沒有擋OR，根據hint，修改 1=1 為 2>1 或是 1<3 都可以使得條件判斷為 True。
登入後即可取得flag

範例payload：
>帳號：admin
>密碼：' OR '2' > '1
>注意需要加上單引號使查詢語句完整。
:::

### [20] let cat in 3
:::info
大駭客貓貓用hacker_meow的身分，把flag悄悄的放在別人的伺服器上，但是hacker_meow帳號似乎被刪除了？

沒有帳號要怎麼登入呢？

請幫幫苦惱的駭客貓貓找回師傅留下的flag！

http://mid.macacahub.tw:10230
:::
:::warning
hint
> UNION...好像可以做出任意的資料...的樣子？
:::
:::success
根據題意，此次須使用帳號hacker_meow登入，但是hacker_meow帳號並不存在於資料庫中。
因此我們需要能產生資料的語法，而不能單純利用註解或是修改判斷條件繞過。

>SELECT username, password FROM Users 會產生以下資料
> |username|passwrod|
> |---|---|
> |xxx|ooo|
> |...|...|
>
> SELECT username, password FROM Users UNION SELECT 1,2 會產生以下資料
> |username|passwrod|
> |---|---|
> |xxx|ooo|
> |...|...|
> |1|2|
>
> 最後一筆的 1,2 其實就是 union select 出來的假資料。
> 但是使用 union 有一點限制，欄位數必須與前面取出的資料相等。
> 因此在嘗試 union 時需要先猜測欄位數。
> 此處可以暴力使用 union select 1,2,3,...
> 持續增加欄位數直到網頁正常為止。
> 範例payload：
> > 帳號：任意輸入
> > 密碼：' union select '1
> > 密碼：' union select 1,'2
> > 密碼：' union select 1,2,'3
> > ...
> > 須注意最後一位強制要求單引號，以使得sql語法完整。

在猜測欄位正常登入後，應會顯示如下：
![](https://i.imgur.com/jjInXJ9.png)
因此猜測上面payload放2的位置會對應到username，修改 2 為 hacker_meow 應可正常登入取得flag。

範例payload：
> 帳號：任意輸入
> 密碼：' union select 1,'hacker_meow
> 密碼：' union select 1,'hacker_meow','3
> 密碼：' union select 1,'hacker_meow',3,'4
> ...
:::