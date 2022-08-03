import datetime

now = datetime.datetime.now()
date = now.strftime("%Y%m%d")

with open('/home/pi/gps/GPS/RPi-lite_' +date+'.csv', 'r') as f:
    last_line = f.readlines()[-1]
    lines = last_line.split(",")
    lat = lines[1]
    lng = lines[2]
print(lat, lng)


