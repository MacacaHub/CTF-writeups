package main
import (
    "fmt"
)

func PikaCheck(input string) bool{
    var a [20]int
    for i:= 0 ; i<len(input) ; i++{
        a[i] = int(input[i]) + int(input[(i+1)%len(input)])
    }
    var sum = 0
    sum += (a[0] - 185)
    sum += (a[1] - 212)
    sum += (a[2] - 172)
    sum += (a[3] - 145)
    sum += (a[4] - 185)
    sum += (a[5] - 212)
    sum += (a[6] - 172)
    sum += (a[7] - 177)
    sum += (a[8] - 217)
    sum += (a[9] - 212)
    sum += (a[10] - 204)
    sum += (a[11] - 177)
    sum += (a[12] - 185)
    sum += (a[13] - 212)
    sum += (a[14] - 204)
    sum += (a[15] - 209)
    sum += (a[16] - 161)
    sum += (a[17] - 124)
    sum += (a[18] - 172)
    sum += (a[19] - 177)
    if sum == 0{
        return true
    }
    return false
}

func main() {
    var input string
    fmt.Scanf("%s", &input)
    if PikaCheck(input){
        fmt.Println("You are me!!")
        fmt.Println("Credit card: 4777225666027772")
        fmt.Println("CVV: 375")
    }else{
        fmt.Println("Nothing here my darling...")
    }
}