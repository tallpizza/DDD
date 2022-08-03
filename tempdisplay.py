import time

import Adafruit_GPIO.SPI as SPI
import Adafruit_SSD1306

from PIL import Image
from PIL import ImageDraw
from PIL import ImageFont

import socket
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
s.connect(("8.8.8.8", 80))

#SHT31
import smbus
bus = smbus.SMBus(1)



RST = None 

DC = 23
SPI_PORT = 0
SPI_DEVICE = 0

disp = Adafruit_SSD1306.SSD1306_128_32(rst=RST)


disp.begin()

# Clear display.
disp.clear()
disp.display()

# Create blank image for drawing.
# Make sure to create image with mode '1' for 1-bit color.
width = disp.width
height = disp.height
image = Image.new('1', (width, height))

# Get drawing object to draw on image.
draw = ImageDraw.Draw(image)

# Draw a black filled box to clear the image.
draw.rectangle((0,0,width,height), outline=0, fill=0)

# Draw some shapes.
# First define some constants to allow easy resizing of shapes.
padding = -1
top = padding
bottom = height-padding
# Move left to right keeping track of the current x position for drawing shapes.
x = 1


# Load default font.
font = ImageFont.load_default()
font = ImageFont.truetype('Minecraftia-Regular.ttf', 8)

# Alternatively load a TTF font.  Make sure the .ttf font file is in the same directory as the python script!
# Some other nice fonts to try: http://www.dafont.com/bitmap.php
# font = ImageFont.truetype('Minecraftia.ttf', 8)

while True:

    # SHT31 address, 0x44(68)
    bus.write_i2c_block_data(0x44, 0x2C, [0x06])
    
    time.sleep(0.1)
    
    # SHT31 address, 0x44(68)
    # Read data back from 0x00(00), 6 bytes
    # Temp MSB, Temp LSB, Temp CRC, Humididty MSB, Humidity LSB, Humidity CRC
    data = bus.read_i2c_block_data(0x44, 0x00, 6)

    # Convert the data()
    temp = data[0] * 256 + data[1]
    cTemp = -45 + (175 * temp / 65535.0)
    humidity = 100 * (data[3] * 256 + data[4]) / 65535.0

    # Draw a black filled box to clear the image.
    draw.rectangle((0,0,width,height), outline=0, fill=0)

    # Shell scripts for system monitoring from here : https://unix.stackexchange.com/questions/119126/command-to-display-memory-usage-disk-usage-and-cpu-load
    IP = str(s.getsockname()[0])
    TEMP = "%.2f" %cTemp
    HUMY = "%.2f" %humidity

    # Write two lines of text.

  
    draw.text((x, top+2),     " T :  " + str(TEMP) + " *C", font=font, fill=255)
    draw.text((x, top+12),    " H :  " + str(HUMY) + " %" , font=font, fill=255)
    draw.text((x, top+22),       " IP :  " + str(IP),  font=font, fill=255)
    
    # Display image
    disp.image(image)
    disp.display()
    time.sleep(.1)
    