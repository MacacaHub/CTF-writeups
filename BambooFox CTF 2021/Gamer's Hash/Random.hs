module Random where

import Crypto.Random.DRBG
import Control.Monad   (replicateM)
import Data.ByteString (ByteString, unpack)
import Data.Char       (ord, chr)


fromByte :: ByteString -> Int
fromByte x = fromIntegral $ head (unpack x)

randomInt :: IO Int
randomInt = do
    g <- newGenIO :: IO CtrDRBG
    case genBytes 1 g of
        Left err       -> error  $ "Oh no! " ++ show err
        Right (res, _) -> return $ fromByte res

-- charset is "abcdefghijklmnopqrstuvwxyz012345"
randomChr32 :: IO Char
randomChr32 = do
    r <- randomInt
    let rm = mod r 32 in
        if rm < 26
            then return $ chr (rm + ord 'a')
            else return $ chr (rm + ord '0' - 26)

randomStr :: Int -> IO [Char]
randomStr n = replicateM n (randomChr32)
