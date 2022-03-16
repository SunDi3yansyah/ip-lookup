# Internet Protocol Geolocation

### Basic use

- Fork this repository (optional)
- Open your SSH
- `git clone git@github.com:USERNAME/IP.git` if you not fork use `git@github.com:SunDi3yansyah/IP.git`
- Enjoy :neckbeard:

#### PHP and HTML

If use PHP required `schema/db.sql` import your database server, example i'am using MariaDB/MySQL

If you want to using other database server, you need schema like this:

```
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| network     | varchar(250) | NO   |     | NULL    |                |
| city        | varchar(250) | NO   |     | NULL    |                |
| country     | varchar(250) | NO   |     | NULL    |                |
| countryCode | varchar(250) | NO   |     | NULL    |                |
| isp         | varchar(250) | NO   |     | NULL    |                |
| lat         | varchar(250) | NO   |     | NULL    |                |
| lon         | varchar(250) | NO   |     | NULL    |                |
| org         | varchar(250) | NO   |     | NULL    |                |
| query       | varchar(250) | NO   |     | NULL    |                |
| region      | varchar(250) | NO   |     | NULL    |                |
| regionName  | varchar(250) | NO   |     | NULL    |                |
| status      | varchar(250) | NO   |     | NULL    |                |
| timezone    | varchar(250) | NO   |     | NULL    |                |
| zip         | bigint(20)   | NO   |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+
```

![screenshot from 2016-09-13 23 55 47](https://cloud.githubusercontent.com/assets/3952281/18483318/af29085a-7a0d-11e6-83b7-dd7380c0f8f3.png)

#### Ruby

You must install gem and dependency gems:
```
gem install json terminal-table
```

Then run file `api.rb`

``` sh
ruby api.rb
```

![screenshot from 2016-09-14 04 39 39](https://cloud.githubusercontent.com/assets/3952281/18492411/571719fe-7a35-11e6-9395-a573c626dbd0.png)


#### Bash

PR

#### Python

Run file `api.py`

```
python api.py
```
