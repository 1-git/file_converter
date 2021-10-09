File directories
========================

*files/input* - folder for input xml files

*files/output* - folder with generated json files

Steps:
==========

1. Container initiation

```
docker-compose build
docker-compose run app composer install
```

2. Get command description

```
docker-compose run app php ./application.php -h
```

3. Copy the file to the *files/input* folder

4. File generation

```
docker-compose run app php ./application.php silence1.xml
```
or
```
docker-compose run app php ./application.php silence1.xml output.json --chapter-silence-ms=3000 --part-silence-ms=1000 --silence-duration-min=10
```
