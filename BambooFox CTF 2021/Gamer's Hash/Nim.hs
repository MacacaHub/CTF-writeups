module Nim where

import Data.Bits
import Math.NumberTheory.Logarithms


nimSize = 64
maxNim  = (shiftL 1 nimSize) - 1

newtype Nim = Nim Integer deriving (Eq)


bitMask :: Int -> Nim
bitMask n = Nim $ (shiftL 1 n) - 1

nimLength :: Nim -> Int
nimLength (Nim a) = bit $ intLog2 $ integerLog2 a

nimSplit :: Nim -> Int -> (Nim, Nim)
nimSplit a n =
    let higher = shiftR a n
        lower  = a .&. bitMask n
    in (higher, lower)


fromNim :: Nim -> Integer
fromNim (Nim a) = a


instance Num Nim where
    Nim a + Nim b = Nim (xor a b)
    Nim a - Nim b = Nim (xor a b)

    0 * _ = 0
    _ * 0 = 0
    a * 1 = a
    1 * b = b
    a * b =
        let (a1, a0) = nimSplit a k
            (b1, b0) = nimSplit b k
        in a1 * b1 * p2 + (shiftL (a0 * b1 + a1 * b0) k) + a0 * b0
        where
            k  = max (nimLength a) (nimLength b)
            p  = Nim $ bit k
            p2 = Nim $ bit k + bit (k - 1)

    abs = id
    signum 0 = 0
    signum _ = 1
    negate = id
    fromInteger a
        | a > maxNim = error "Nim overflow"
        | a < 0      = error "Nim cannot be negative"
        | otherwise  = Nim a

instance Bits Nim where
    (Nim a) .&. (Nim b) = Nim (a .&. b)
    (Nim a) .|. (Nim b) = Nim (a .|. b)
    xor (Nim a) (Nim b) = Nim (xor a b)

    complement (Nim a) = Nim (complement a)

    shiftR (Nim a) b = Nim (shiftR a b)
    shiftL (Nim a) b
        | c <= maxNim = Nim c
        | otherwise   = error "Nim overflow"
        where c = shiftL a b

    rotateR = shiftR
    rotateL = shiftL

    bitSize _ = nimSize
    bitSizeMaybe _ = Just nimSize
    isSigned _ = False

    bit a = Nim $ bit a

    testBit  (Nim a) = testBit a
    popCount (Nim a) = popCount a

instance Show Nim where
    show (Nim a) = show a
