# Basic PHP Site

A basic PHP site built by myself, following [a course on Team TreeHouse](https://teamtreehouse.com/library/build-a-basic-php-website), to demonstrate a basic understanding of PHP. Code are slightly optimized with better structure and variable namings.

The site is live on this [AWS server](http://52.37.51.157).

## What Does This Site Do?
This website contains some data entries for some famous books, movies, and music, and display them according to the category you choose; you can click on any media entry to see its detail.

## PHP Features Used
- Code factoring with separate header and footer files for all pages with [`<?php include(); ?>`](http://php.net/manual/en/function.include.php)
- [`_$GET`](http://php.net/manual/en/reserved.variables.get.php) in URLs such as `href="catalog.php?cat=books"`
- Multidimentional associative array, and various built-in array functions such as [`array_rand`](http://php.net/manual/en/function.array-rand.php), [`asort`](http://php.net/manual/en/function.asort.php), [`implode`](http://php.net/manual/en/function.implode.php), [`count`](http://php.net/manual/en/function.count.php), etc.
- String interpolation and interpretation
- Blending PHP together with plain HTML
- [`echo`](http://php.net/manual/en/function.echo.php), [`var_dump`](http://php.net/manual/en/function.var-dump.php), and [`print_r`](http://php.net/manual/en/function.print-r.php)