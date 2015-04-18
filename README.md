# GeoIP Country Lists #
Per Country IP lists useful for bash scripting/filter purpose.
> This product includes GeoLite2 data created by MaxMind, available from [http://www.maxmind.com(http://www.maxmind.com).

## Data-Structure ##
The `Build/` directory contains the per-country ip lists. One CIDR Range per line, separated by \\n.

### File Format ##
```text
xxx.xxx.xxx.xxx/yy\n
xxx.xxx.xxx.xxx/yy\n
xxx.xxx.xxx.xxx/yy\n
...
```

### Example DE.txt ###
```text
188.138.101.0/26
188.138.101.64/27
188.138.101.96/30
188.138.101.100/31
188.138.101.102/32
...
```

## Update ##
To update the dataset, just run the following command within a shell (PHP and ANT required!). THe script will automatically fetch the current GeoLite2 Database and transform the data in per-country lists.

```shell
ant build.xml
```

## License ##

### Data ###
The **GeoIP data** (`GeoLite2/` directory as well as the derived output data within `Build/`) is released under the Terms of [Creative Commons Attribution-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-sa/3.0/).
Following the [requirements](http://dev.maxmind.com/geoip/legacy/geolite/) of [MaxMind](http://dev.maxmind.com/geoip/legacy/geolite/) the "Attribution" has to be:

> The GeoLite2 databases are distributed under the [Creative Commons Attribution-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-sa/3.0/). The attribution requirement may be met by including the following in all advertising and documentation mentioning features of or use of this database

```html
This product includes GeoLite2 data created by MaxMind, available from
<a href="http://www.maxmind.com">http://www.maxmind.com</a>.
```

### Scripts ###
The **Scripts** as well as the **Documentation** is released under the Terms of [The MIT X11 License](http://opensource.org/licenses/MIT).