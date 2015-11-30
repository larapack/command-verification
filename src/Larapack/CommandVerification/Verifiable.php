<?php

namespace Larapack\CommandVerification;

trait Verifiable
{
	protected function verify($message = null, $callback = null)
	{
	   if ($this->verify || $message)
	   {
		   if ($message) $this->warn($message);
		   else $this->warn($this->verify);
		   
		   if (!$this->confirm('Do you wish to continue? [y|N]'))
		   {
			   return $this->comment('Command stopped...');
		   }
	   }
	   
	   if ($callback) return $callback();
	   else return $this->verified();
	}
}
