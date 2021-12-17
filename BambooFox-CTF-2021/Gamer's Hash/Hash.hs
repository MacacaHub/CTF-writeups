module Hash where

import Nim
import Data.Bits (shiftL, shiftR, (.&.))
import Data.Char (ord)
import Numeric   (showHex)


mix1 :: Nim -> Nim
mix1 a0 =
    let a1 = addShiftR 37 a0
        a2 = addShiftL 18 a1
        a3 = addShiftR 43 a2
        a4 = addShiftL 26 a3
    in a4
    where
        nimShiftL n = \x -> shiftL (x .&. bitMask (nimSize - n)) n
        addShiftL n = \x -> x + (nimShiftL n x)
        addShiftR n = \x -> x + (shiftR x n)

mix2 :: Nim -> Nim
mix2 a = mix nimSize a
    where
        mix 1 = id
        mix n = \x ->
            let (x1, x0) = nimSplit x hn
                y1 = halfMix x1
                y0 = halfMix x0
            in (shiftL y1 hn) + y1 + y0
            where
                hn = div n 2
                halfMix = mix hn

smash :: Nim -> Nim -> Nim
smash a b = mix2 $ a * a + mix1 b

hash :: [Nim] -> Nim
hash a = foldl smash start (transform a)
    where
        start     = 0x8b0857dbcaf45964
        magic     = 0x9e3779b97f4a7c15
        transform = \x -> zipWith (*) x [ magic ^ i | i <- [1..] ]

hashStr :: [Char] -> [Char]
hashStr a =
    let hashed = hash $ nimList a
    in hexStr (fromNim hashed)
    where
        nimList  = map (fromIntegral . ord)
        hexStr x = padStr (div nimSize 4) $ showHex x ""
        padStr n = \s -> (replicate (n - length s) '0') ++ s
