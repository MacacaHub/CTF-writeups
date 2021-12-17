import Hash
import Random
import Flag
import System.IO     (hFlush, stdout)
import System.Exit   (exitSuccess)
import Control.Monad (forM)


main :: IO ()
main = do
    forM [1..5] $ \_ -> do
        answer <- randomStr 8
        putStrLn $ "Find a string that hashes to " ++ hashStr answer
        hFlush stdout
        input <- getLine
        -- length limit: 32 chars
        if hashStr (take 32 input) == hashStr answer
            then putStrLn "That's correct!"
            else do
                putStrLn "Not even close."
                exitSuccess
    putStrLn "Well done! Here's the flag:"
    putStrLn flag
