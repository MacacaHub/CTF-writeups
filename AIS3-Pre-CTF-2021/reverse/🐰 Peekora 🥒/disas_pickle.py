import pickle
import pickletools

file = open('flag_checker.pkl', 'rb')

pickletools.dis( file.read() )

# FLAG: AIS3{dAmwjzphIj}