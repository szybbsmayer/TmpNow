For this to work you need to connect to your Influxdb and execute following command:
create database TmpNow
use TmpNow
insert data,device=device0 temperature=23.8,humidity=55,pressure=985
insert data,device=device0 temperature=23.8,humidity=55.7,pressure=985.1
insert data,device=device0 temperature=25.1,humidity=70.2,pressure=991.2

