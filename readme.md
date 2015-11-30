# command-verification
Makes Artisan Commands prompt the console if it should continue.

## Installing

Install using Composer `composer require larapack/command-verification 1.*`.

## Usage

First add the trait `Verifiable` to your Artisan Command.
```
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Larapack/CommandVerification/Verifiable;

class ExampleCommand extends Command
{
  use Verifiable;
  
  // ...
}
```

In order to make the user verify that he wants to run this command you will have to set your `fire`-method to run the `verify`-method and set the `verify`-attribute.
```
  protected $verify = 'This command will destroy your entire site!';

  public function fire()
  {
	  return $this->verify();
  }
```

If the user accept it will call the `verified`-method, so ensure you define that.
```
  public function verified()
  {
    $this->info('We have destroyed your entire site. Thanks for using our command.');
  }
```

It will look like this:

![Command Line Example](http://static-content.webman.io/github.com/larapack/command-verification/command-line.png)

## Customizing

When calling the `verify`-method you can add the following parameters: `$this->verify($message, Closure $callback)`
```
  public function fire()
  {
	  return $this->verify('A custom verify message', function() {
	    $this->info('We have destroyed your entire site. Thanks for using our command.');
	  });
  }
```

This way you can overwrite the default verify message and the callback.
