# txt-archive

[![travis ci](https://travis-ci.org/wizardjedi/txt-archive.svg?branch=master)](https://travis-ci.org/wizardjedi/txt-archive.svg?branch=master)
[![codecov](https://codecov.io/gh/wizardjedi/txt-archive/branch/master/graph/badge.svg)](https://codecov.io/gh/wizardjedi/txt-archive)

# Specification

Archive file - human readable text with compression/repetition rules. Main idea - store data by columns instead of rows.

## Archive file format

```
archive:[SCHEMA]
bunch:[SIZE]
[bunch data]
bunch:[SIZE]
[bunch data]
...
bunch:[SIZE]
[bunch data]
```

## Common rules

 * value - value itself
 * [count]*value - duplicate value count times
 * \N - null-reference represent null value
 * '=' - separator for prefix and repetition group
 
 ## Example
 
 Archive contains 1 bunch of 3 rows. Archive contains fields:
  * transaction_id
  * sms_text
  * add_date
  * delivered_count
 
 ```
 archive:transaction_id=integer,sms_text=text,add_date=date,delivered_count=integer
 bunch:3
 1025456122=0;1;2
 3*"This is sms text"
 1506862923=0;10;20
 0=3*1
 ```
 equals to
  
 ```
 transaction_id;sms_text;add_date;delivered_count
 1025456122;"This is sms text";"2017-10-01 16:02:03";1
 1025456123;"This is sms text";"2017-10-01 16:02:13";1
 1025456124;"This is sms text";"2017-10-01 16:02:23";1
 ```
