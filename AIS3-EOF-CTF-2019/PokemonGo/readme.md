# PokemonGo

Reverse, 183/500 Points

Auther: **Terrynini**

Writeup By: **yctseng1227**

## Description

> 由於官方題目網站已關閉，以下只能簡述題目

故事描述某人把信用卡號透過程式加密，卻把卡號給忘了。
給出 [log file](./log) 請你分析後找出flag。

## Solution

打開log後發現該log檔行數長達近19000行，想想也知道不太可能花時間看每一行。

從題目PokemonGo可以猜一下source code是用[Golang](https://en.wikipedia.org/wiki/Go_(programming_language))編寫再透過軟體生出來的log，因此也包含一些系統執行函式的過程，例如`init`、`print`、`scanf`，把這些不需要的資訊去除後留下我們真正要trace的關鍵部分即可。

舉例來說，下方code第一行表明`entering main.init`區塊，那只要找出對應的`leaving main.init`將這些不需要的初始化資訊去除即可。

```
Entering main.init.
...
    Entering fmt.init.
    ...
    Leaving fmt.init, resuming main.init.
...
Leaving main.init.
Entering main.main at /home/terrynini38514/Desktop/PokemonV2.go:38:6.
...
Leaving main.main.
```

相關的Golang trace log題目可以參考[0CTF/TCTF 2018 Quals](https://ctftime.org/event/557)的[g0g0g0](http://blog.terrynini.tw/en/2018-0CTF-Quals-g0g0g0/)，老實說我也是找到這題題解才有頭緒XD


最後東拆西拆，整理出兩個關鍵部分： [main](./main) & [PikaCheck](./Pikacheck)

`main`的部分是輸入密碼(string)然後呼叫`PikaCheck`進行`True/False`，因此我們把重點放在`PikaCheck`。

從`PikaCheck`來看雖然450行也不算少，但仔細看其實前半部有重複出現很多次，也就是下方code。

```=
.3:
    t92 = phi [0: 0:int, 1: t10] #i
    t93 = len(input)
    t94 = t92 < t93
    if t94 goto 1 else 2
.1:
    t1 = &t0[t92]
    t2 = input[t92]
    t3 = convert int <- uint8 (t2)
    t4 = t92 + 1:int
    t5 = len(input)
    t6 = t4 % t5
    t7 = input[t6]
    t8 = convert int <- uint8 (t7)
    t9 = t3 + t8
    *t1 = t9
    t10 = t92 + 1:int ==>t10=1
    jump 3
```

trace log有個很重要的部分，就是code只會顯示有執行的部分，因此面`line 5`的`t94`必定為`True`，才會進入`labe 1`。

再來就是上面code出現的關鍵字`phi`，簡單翻譯成pseudocode

```python
if program from label 0
    t92 = (int)0
else program from label 1
    t92 = t10
```

綜合以上描述，可以發現程式先建立`int a[20]`，然後執行for loop 20次，每次都計算`a[i] = input[i] + inpit[(i+1)%20]`，之後才開始進入許多加減的Compare階段。

還原`PikaCheck`的code就會像下方code，從main的後半段來看目標是compare為`True`，也就`是a[0] = input[0] + input[1] = 185`，以此類推。

```go
var a[20]int
for (i=0;i<len(input);i++) 
    a[i] = ascii(input[i]) + ascii(input[(i+1)%20])

if (a[0]-185+a1[1]-212+a[2]-172+a[3]-145+a[4]-185+a[5]-212+a[6]-172+a[7]-177+a[8]-217+a[9]-212+a[10]-204+a[0]-177+a[11]-185+a[12]-212+a[13]-204+a[14]-209+a[15]-161+a[6]-124+a[17]-172+a[18]-177==0){   
    return true
else
    return false
}
```

找出規則後就是寫個對拍code [solve.py](./solve.py)，找出看起來最有可能的就是Flag～

```
IpdHIpdHipdhIpdhi8Dh
JoeGJoeGjoegJoegj7Eg
KnfFKnfFknffKnffk6Ff
LmgELmgElmgeLmgel5Ge
MlhDMlhDmlhdMlhdm4Hd
NkiCNkiCnkicNkicn3Ic
OjjBOjjBojjbOjjbo2Jb
PikAPikApikaPikap1Ka  <-- Flag
Qhl@Qhl@qhl`Qhl`q0L`
Rgm?Rgm?rgm_Rgm_r/M_
Sfn>Sfn>sfn^Sfn^s.N^
Teo=Teo=teo]Teo]t-O]
Udp<Udp<udp\Udp\u,P\
Vcq;Vcq;vcq[Vcq[v+Q[
Wbr:Wbr:wbrZWbrZw*RZ
Xas9Xas9xasYXasYx)SY
Y`t8Y`t8y`tXY`tXy(TX
Z_u7Z_u7z_uWZ_uWz'UW
```

**`Flag{PikAPikApikaPikap1Ka}`**

> 附件: 賽後找出題者ㄠ到 [source code](./source.go) 3w3