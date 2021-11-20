# forensic

## [40] packet 1
### **topic**
駭客貓貓想要這個網站的flag

駭客貓貓發現有人嘗試登入這個網站，駭客貓貓很聰明，他偷偷的錄下登入的封包，只是封包太多了

請幫駭客貓貓找出正確的帳號及密碼，把網站內的flag送給駭客貓貓！

http://mid.macacahub.tw:10110

### **hint**
> 目標主機IP？
> 
> 協定？

### **solution**
該題為封包分析。目的為取得帳號及密碼。

在忽略少許封包後，第一筆HTTP封包便可以看出一些資訊。

> ![](../img/packet1_http.png)

但嘗試後該組帳號密碼是錯誤的。

可以直接尋找下一筆 HTTP 封包，或是利用 filter 過濾。

可使用 ip.addr == 140.117.176.121 或是 http。

過濾後會簡潔許多，嘗試每組帳號密碼後應可取得flag。

## [30] packet 2
### **topic**
哦哦，駭客貓貓似乎嗅到flag的味道了！

可是網站管理員很聰明，他們似乎打算用圖片把密碼傳出去！

請幫駭客貓貓還原圖片，找出密碼，取出flag！

http://mid.macacahub.tw:10120

對了，密碼似乎是個四位數的樣子！

### **hint**
> https://hexed.it/
> 
> 這裡可以寫16進制資料唷

### **solution**
先致歉，這題其實不需要使用 hex editor，但是出題者只會 hex editor 才會把 hint 寫成這樣。

一樣觀察封包，應可發現有 GET /01.png 的流量，呼應題目所說用圖片傳送密碼。
> ![](../img/packet2_png.png)

此處可以使用 wireshark 的功能將圖片 dump 出來。
> ![](../img/packet2_export_step.png)
> 
> File > Export Objects > HTTP

匯出後應可看到該封包內所有的圖片。
> ![](../img/packet2_export.png)

儲存後利用密碼登入題目敘述的網站即可取得flag

> 其他解法：
> 
> 1. 親手利用 hex editor 把圖片取出
> 
> 2. 密碼只有一萬種可能，可以用腳本暴力猜測
