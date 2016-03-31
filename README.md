# Basic PHP Site

A basic PHP site built by myself, following [a course on Team TreeHouse](https://teamtreehouse.com/library/build-a-basic-php-website), to demonstrate a basic understanding of PHP. Code are slightly optimized with better structure and variable namings.

The site is live on this [AWS server](http://52.37.51.157).

## What Does This Site Do?
This website contains some data entries for some famous books, movies, and music, and display them according to the category you choose; you can click on any media entry to see its detail.

You can also use the suggestion form on the website to leave some suggestions. You will get a confirmation email.

## PHP Features Used
- Validate user input validation, such as `trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));`, and gracefully handle input errors
- Generate and send email to users using [PHP Mailer](https://github.com/PHPMailer/PHPMailer)
- [`_$GET`](http://php.net/manual/en/reserved.variables.get.php) in URL queries such as `href="catalog.php?cat=books"`
- [`_$POST`](http://php.net/manual/en/reserved.variables.post.php) to correctly handle form submission without URL queries as the case in `_$GET`
- Header redirection to avoid form re-submission, such as in `header("location:suggest.php?status=thanks");`
- Enable [output buffer](http://php.net/manual/en/book.outcontrol.php) with `ob_start()` or changing `php.ini` to enable header redirection
- Prevent spam by using "Spam Honey Pot Field", which is an invisible input field to trick spam robot to fill it in thus expose itself as a robot
- Multidimentional associative array, and various built-in array functions such as [`array_rand`](http://php.net/manual/en/function.array-rand.php), [`asort`](http://php.net/manual/en/function.asort.php), [`implode`](http://php.net/manual/en/function.implode.php), [`count`](http://php.net/manual/en/function.count.php), etc.
- Code factoring with separate header and footer files for all pages with `<?php include(); ?>`
- String interpolation and interpretation
- Blending PHP together with plain HTML
- [`echo`](http://php.net/manual/en/function.echo.php), [`var_dump`](http://php.net/manual/en/function.var-dump.php), and [`print_r`](http://php.net/manual/en/function.print-r.php)