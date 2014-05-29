name: intro
class: center, middle

Writing testable code
=====================

---
template: intro
name: intro

And then testing it
-------------------

---
name: whoami

Who am I?
---------
- PHP developer for > 3 years

---
template: whoami
name: whoami

- Open source contributor

---
template: whoami
name: whoami

- Testing advocate

---
template: whoami
name: whoami

- Unprofessional professional

---
template: whoami
name: whoami

- Iron Man?

---

So first, some terms
====================
And concepts too
----------------

---

Application
-----------
The project you work on. It has **requirements** and your job is to write
enough code that it fulfills those requirements.

Testing
-------
That's when you prove your application does what you want it to do.

>Note: You probably (hopefully?) do this all the time

---

Manual testing
--------------
That's when you (or some other human being) tests your application.

Automated testing
-----------------
That's when you use another script or utility to test your application.

>Note: Computers are usually much faster at testing than humans.

---

Unit tests
----------
These are tests that only check one small piece (a unit) of your application.

>Note: Only computers can really do this type of test.

Integration tests
-----------------
These are tests that check the whole application all at once.

>Note: This is the type of test most people usually do themselves.

---
name: integrationtestssuck

Integration tests are the most realistic
----------------------------------------

---
template: integrationtestssuck
name: integrationtestssuck

They're also the worst
----------------------

---
template: integrationtestssuck
name: integrationtestssuck

Why?

---
template: integrationtestssuck
name: integrationtestssuck

- Could have failed anywhere in the stack

---
template: integrationtestssuck
name: integrationtestssuck

- Huge potential number of conditions (logged in, cold cache, etc)

---
template: integrationtestssuck
name: integrationtestssuck

- Can be hard to reproduce

---
name: unittestsrock

Unit tests are the best for debugging
-------------------------------------

Why?

---
template: unittestsrock
name: unittestsrock

- Known, limited number of inputs

---
template: unittestsrock
name: unittestsrock

- Drop into a REPL

---
template: unittestsrock
name: unittestsrock

- Easy to see where the problem is

---

Test suite
----------
A set of tests that you run for your application.

Can be:

- Unit

- Integration

- Both

---

Test coverage
-------------
A percent that tells you how much of your application is being tested when
you run your test suite.

- High numbers are good!

- 100% is sometimes cited as a goal

- **100% is a stupid goal**

---

Wait, what?
-----------
- 100% doesn't mean there aren't any bugs

    - Could be "testing" a line without checking all possible input types

- Our goal isn't lots of tests, our goal is reliable software

- Tests help that, but there's diminishing returns in coverage percent

---
class: center middle

Still, try to keep it > 80%
===========================

(Don't worry if it's low, just keep increasing it over time)

---
name: tdd

Test-last development
---------------------
Write your code first, then go back and write tests for it.

>Most people do this

---
template: tdd
name: tdd

Test-first development (TDD)
----------------------------
Write your tests first, then write the code that makes them pass.

---
name: tddbenefits

Test-first development produces higher quality code
---------------------------------------------------

---
template: tddbenefits
name: tddbenefits

- Changes the way you think about a task

---
template: tddbenefits
name: tddbenefits

- Forces you to craft an API before writing internals (big picture)

---
template: tddbenefits
name: tddbenefits

- Keeps your code lean

---
template: tddbenefits
name: tddbenefits

- Less likely to miss a possible test case

---
name: redgreenrefactor

"Red, green, refactor"
----------------------

The TDD process in a nutshell:

---
name: redgreenrefactor
template: redgreenrefactor

- Write failing tests

---
name: redgreenrefactor
template: redgreenrefactor


- Make those tests pass

---
template: redgreenrefactor

- Fix your code

---
name: redgreenrefactor
template: redgreenrefactor

- **Fix your code**

---
name: redgreenrefactor
template: redgreenrefactor

"Break early, break often"

---

Continuous integration
----------------------
A process that means your tests should always pass, and that you automatically
run them every time you change the code.

- Need to be able to run them locally

- Some services will run your tests for you

- Sometimes you have to pay for those services

- Travis.ci, drone.io, Jenkins, etc.

---

Breaking the build
------------------
That's when your project uses continuous integration but someone's latest
change made the tests fail.

![keep calm and don't break the build](../img/you-broke-the-build.png)

---

Deployment
----------
When you update the version of the application your customers are seeing.

>For us that mostly means putting it on the server.

---

Continuous deployment
---------------------
A natural extension of continuous integration. The application gets deployed
after any code change that doesn't break the build.

- This means that you're super confident in your test suite

- It also means you've got the deployment process automated

![witchcraft](../img/witchcraft.gif)
---

Case study: Github
------------------
>"Aug. 23, saw 563 builds and 175 deploys"

![](../img/github_deploys.png)

---

Case study: Etsy
----------------
>"At Etsy about 150 engineers deploy a single monolithic application more than
>60 times a day"

![](../img/etsy_deployment.png)

---

Benefits
--------
- Deploying quickly often keeps your changes small

- You can be confident in your changes because you know they're correct

- You know the moment something breaks, hopefully before a customer sees it

---
name: testingstrats
class: center, middle

Testing strategies
==================
The quick tip version
---------------------

---
class: center, middle

Things that **do things**
-------------------------
...Should not **create** those things
-------------------------------------

---
class: center, middle

Things should make do with the resources provided
-------------------------------------------------

---
class: center, middle

Global state is bad
-------------------

---
class: center, middle

"Static" classes are global state
---------------------------------

---
class: center, middle

Methods longer than 10 lines are probably wrong
-----------------------------------------------

---
class: center, middle

Classes with more than 10 methods are probably doing too much
-------------------------------------------------------------

---
class: center, middle

Don't try and be clever
-----------------------

---
class: center, middle

**__get**, **__set,** and other magic methods are you trying to be clever
-------------------------------------------------------------------------

---
class: center, middle

You're probably putting too much functionality into one class
-------------------------------------------------------------

---
class: center, middle

Testable code is code that's provably correct
---------------------------------------------

---
class: center, middle

If your tests are > 10 lines of code each...
--------------------------------------------
...try again
------------

---
class: center, middle

The more typehinting you do...
------------------------------
...the smaller the chance your code is wrong
--------------------------------------------

---
name: dangeroustogoalone

It's dangerous to go alone
==========================

---
template: dangeroustogoalone
name: dangeroustogoalone

![](../img/morpheous_take_this.gif)

---

PHPUnit
-------

- De facto unit testing framework in PHP

- Fantastic tooling support

- A little verbose

---

We're testing this class
------------------------

```php
<?php # src/Calculator.php

class Calculator
{
    /**
     * Adds two numbers together
     *
     * @param int|float $x
     * @param int|float $y
     *
     * @return int|float
     */
    public function add($x, $y)
    {
        return $x + $y;
    }
}
```

---

An example PHPUnit test

```php
<?php # tests/CalculatorTest.php

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    public function testAddWorks()
    {
        $calc = new Calculator();

        $this->assertEquals($calc->add(2, 2), 4);
    }
}
```

---
How do we run it?
-----------------

- Need to require it (require-dev) with composer

    ```bash
    composer require --dev phpunit/phpunit ~4.1
    ```

    ```json
    "require-dev": {
        "phpunit/phpunit": "~4.1"
    }
    ```

- And write a phpunit.xml file

    ```xml
    <phpunit bootstrap="./vendor/autoload.php">
        <testsuite name="Calculator testsuite">
            <directory>./test</directory>
        </testsuite>
    </phpunit>
    ```
---
Running it:

```
PHPUnit 4.1.1 by Sebastian Bergmann.

Configuration read from path/to/project/phpunit.xml

.

Time: 4 ms, Memory: 5.50Mb

OK (1 tests, 1 assertions)
```

---
class: center, middle

We can do better
================

---

Give it a better name with the `@test` annotation

```php
<?php # tests/CalculatorTest.php

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_adds_2_and_2_together_correctly()
    {
        $calc = new Calculator();

        $this->assertEquals($calc->add(2, 2), 4);
    }
}
```

---

Checking multiple conditions? Use a `@dataProvider`

```php
<?php # tests/CalculatorTest.php

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider additionDataProvider
     * @test
     */
    public function it_adds_2_numbers_together_correctly($x, $y, $result)
    {
        $calc = new Calculator();

        $this->assertEquals($calc->add($x, $y), $result);
    }

    public function additionDataProvider()
    {
        return [
            "2 and 2" => [2, 2, 4],
            "3 and 1" => [3, 1, 4],
            "6 and 2" => [6, 2, 8],
        ];
    }
}
```
---

```php
PHPUnit 4.1.1 by Sebastian Bergmann.

Configuration read from /home/ciarand/presentations/writing-testable-code/code/phpunit.xml

...

Time: 41 ms, Memory: 3.75Mb

OK (3 tests, 3 assertions)
```

---
class: middle, center

How do we test units without touching the database?
---------------------------------------------------

---
Mocking!
--------

Our code under test:
```php
class Temperature
{

    public function __construct($service)
    {
        $this->_service = $service;
    }

    public function average()
    {
        $total = 0;
        for ($i = 0; $i < 3; $i++) {
            $total += $this->_service->readTemp();
        }
        return $total / 3;
    }

}
```

---
We need to test it responds to different inputs. Let's use Mockery.

```php
use \Mockery as m;

class TemperatureTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        m::close();
    }

    public function testGetsAverageTemperatureFromThreeServiceReadings()
    {
        $service = m::mock('service');
        $service->shouldReceive('readTemp')->times(3)->andReturn(10, 12, 14);

        $temperature = new Temperature($service);

        $this->assertEquals(12, $temperature->average());
    }

}
```

---
Benefits
--------

- Mocking lets us test units in isolation

- Mocking lets us avoid time intensive tasks like DB and filesystem access

- Mocking means you can pinpoint exactly where your code is broken

---
name: aboutphpunit

PHPUnit is a detail-oriented testing framework
----------------------------------------------

---
name: aboutphpunit
template: aboutphpunit

- Have to understand PHP to understand PHPUnit

---
name: aboutphpunit
template: aboutphpunit

- Typically need some familiarity with the codebase

---
name: aboutphpunit
template: aboutphpunit

- Hard for managers and project owners to grok

---
name: behatintro

Behat
-----

---
name: behatintro
template: behatintro

- Human readable tests

---
name: behatintro
template: behatintro

- Optimized for legibility

---
name: behatintro
template: behatintro

- Great for integration tests

---
name: behatintro
template: behatintro

```gherkin
Feature: Your first feature
  In order to start using Behat
  As a manager or developer
  I need to try

  Scenario: Successfully describing scenario
    Given there is something
    When I do something
    Then I should see something

```

---
name: minkintro

Mink
----

---
template: minkintro
name: minkintro

- Web acceptance testing for PHP

---
template: minkintro
name: minkintro

- Can connect to Selenium, PhantomJS, Goutte, or others

---
template: minkintro
name: minkintro

- Either controls a browser or pretends to be one

---
template: minkintro
name: minkintro

- Useful tool for full-stack integration testing

---
template: minkintro
name: minkintro

```php
// open some page in browser:
$session->visit('http://my_project.dev/some_page.php');

// reload the page
$session->reload();

// check the status code
$code = $session->getStatusCode();
```

---

An example Behat and Mink test, taken from their homepage:

```gherkin
# features/search.feature
Feature: Search
    In order to see a word definition
    As a website user
    I need to be able to search for a word

    Scenario: Searching for a page that does exist
        Given I am on "/wiki/Main_Page"
        When I fill in "search" with "Behavior Driven Development"
        And I press "searchButton"
        Then I should see "agile software development"

    Scenario: Searching for a page that does NOT exist
        Given I am on "/wiki/Main_Page"
        When I fill in "search" with "Glory Driven Development"
        And I press "searchButton"
        Then I should see "Search results"
```

---

How do we define the testing behaviors?
---------------------------------------

```gherkin
Given I am on "/wiki/Main_Page"
```

```php
/**
 * Opens specified page.
 *
 * @Given /^(?:|I )am on "(?P<page>[^"]+)"$/
 * @When /^(?:|I )go to "(?P<page>[^"]+)"$/
 */
public function visit($page)
{
    $this->getSession()->visit($this->locatePath($page));
}
```

---
class: center, middle

Tools
=====

![](../img/devops_tools.gif)

---
class: center, middle

Continuous integration
======================

---
name: idetools

Your IDE / editor
-----------------

---
template: idetools
name: idetools

- Have it run tests when you save a file

---
template: idetools
name: idetools

- Create a keyboard shortcut to run your tests

---
template: idetools
name: idetools

- Investigate better testing integration (PHPStorm does this well)

---

tdd.sh
------

>Requires: Linux, inotify-tools, a neckbeard

```bash
#!/bin/bash

while true; do
    inotifywait -e modify,close_write,moved_to,move,create,delete -qq **/*.php \
        && clear \
        && ./vendor/bin/phpunit

    if [ $? -eq 0 ]
    then
        true
        #notify-send -i non-starred "Test status" "All tests passed"
    else
        notify-send -i stop "Test status" "Some tests failed"
    fi
done
```

---

[Reflex](https://github.com/cespare/reflex)
-------------------------------------------

>Requires: Linux or Mac OS X

```bash
reflex -r "\.php$" -- phpunit
```

---

[Watchman](https://github.com/facebook/watchman)
------------------------------------------------

>Requires: Linux or Mac OS X

```bash
watchman watch ./src

watchman -- trigger ./src phpunittrigger '*.php' -- phpunit
```

---
name: windows

Windows
-------

---
template: windows

.

---
template: windows

..

---
template: windows

...

---
template: windows

![](../img/idk.gif)

---
template: windows

Maybe try Grunt or something?
-----------------------------

---

class: center, middle

Continuous integration services
===============================

---
name: hostedandfree

Hosted and free
---------------
- Travis.ci
    - Free for open source projects (GitHub)
    - Very popular
    - Supports PHP 5.3 through 5.6 + HHVM

---
template: hostedandfree
name: hostedandfree

- Drone.io
    - Free for open source projects
    - Less popular, has robots on the front page
    - Supports PHP 5.4

---
template: hostedandfree
name: hostedandfree

- Shippable.com
    - Up to 5 free private repos
    - Runs on Docker
    - Supports PHP 5.3 - 5.5

---

Self-hosted (enterprisey)
-------------------------
- Jenkins
    - Very popular among enterprises
    - Rock solid core (runs on Java)
    - Huge amounts of configuration options

- Gitlab-ci
    - Less popular
    - Comes with version control (Gitlab) built in
    - Runs on Ruby

---

Self-hosted (indie)
-------------------
- Sismo
    - Written by the Symfony guy (Fabien)
    - Easy to setup (one php file)

- cijoe
    - Written in Ruby
    - Meant for localhost

- Build bot
    - Python?
    - Cool name, which is why it's included here

---

General debugging tools
=======================
Not necessarily test-related
----------------------------

---

Psysh.org
---------
"A runtime developer console, interactive debugger and REPL"

```php
<?php

/**
 * A really useful dockblock
 * @param int $arg1
 * @param int $arg2
 * @param int $arg3
 * @param FluxCapacitor $etc
 *
 * @return mixed
 */
function whats_going_on_here($arg1, $arg2, $arg3, $etc)
{
    $res = ord($arg1) | $arg2;

    // What?!

    \Psy\Shell::debug(get_defined_vars());

    return $arg3 * $etc . $res;
}
```

---
layout: true

Drops you into a REPL
---------------------

Looks like this:

---

```shell
λ php my_problem_file.php

Psy Shell v0.1.8 (PHP 5.5.12 — cli) by Justin Hileman
>>>

```

---

```shell
λ php my_problem_file.php

Psy Shell v0.1.8 (PHP 5.5.12 — cli) by Justin Hileman
>>> ls
```
---

```shell
λ php my_problem_file.php

Psy Shell v0.1.8 (PHP 5.5.12 — cli) by Justin Hileman
>>> ls
Variables: $arg1, $arg2, $arg3, $etc
>>>
```
---

```shell
λ php my_problem_file.php

Psy Shell v0.1.8 (PHP 5.5.12 — cli) by Justin Hileman
>>> ls
Variables: $arg1, $arg2, $arg3, $etc
>>> doc whats_going_on_here
```

---

```shell
λ php my_problem_file.php

Psy Shell v0.1.8 (PHP 5.5.12 — cli) by Justin Hileman
>>> ls
Variables: $arg1, $arg2, $arg3, $etc
>>> doc whats_going_on_here
function whats_going_on_here($arg1, $arg2, $arg3, $etc)

Description:
  A really useful dockblock

Param:
  int            $arg1
  int            $arg2
  int            $arg3
  FluxCapacitor  $etc

Return:
  mixed
```

---
layout: false

Learning resources
==================

- [Laracasts](https://laracasts.com)

- [PHP the right way](http://www.phptherightway.com/)

- [igor.io](http://igor.io)

- [Laravel Testing Decoded](https://leanpub.com/laravel-testing-decoded)


---

Testing resources
=================

- [Mockery](https://github.com/padraic/mockery)

- [PHPUnit](http://phpunit.de/)

- [Behat](http://behat.org/)

- [Mink](http://mink.behat.org/)

---

Things to checkout
==================

- [Phpspec](http://www.phpspec.net/)

- [Prophecy](https://github.com/phpspec/prophecy)

---

Thank you!
==========
