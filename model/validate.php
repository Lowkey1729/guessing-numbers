<?php
class Validate
{
	private $fields;

	public function __construct()
	{
		$this->fields = new Fields();
	}

	public function getFields()
	{
		return $this->fields;
	}

	// let's validate a generic text field

	public function text($name, $value,$required = true, $min=1, $max = 255 )
	{
		// get the field object

		$field = $this->fields->getField($name);

		// if the field is not required and empty, clear error message

		if(empty($value) && !$required)
		{
			$field->clearErrorMessage();
			return;
		}

		// check field and set or clear error message
		if($required && empty($value))
		{
			$field->setMessage('Required');
		}
		elseif(strlen($value) < $min)
		{
			$field->setMessage('Too Short.');
		}
		elseif(strlen($value) > $max)
		{
			$field->setMessage('Too Long.');
		}
		else
		{
			$field->clearErrorMessage();
		}

	}

	// validate a field with a generic pattern

	public function pattern($name, $value, $pattern,  $message, $required=true)
	{
		// let's get the field object 

		$field = $this->fields->getField($name);


		if(empty($value) && !$required)
		{
			$field->clearErrorMessage();
			return;
		}

		// check field and  set or clear error message

		$match = preg_match($pattern, $value);
		if($match === false)
		{
			$field->setMessage(' Error testin field.');
		}
		elseif($match != 1 )
		{
			$field->setMessage($message);
		}
		else
		{
			$field->clearErrorMessage();
		}



	}

	public function phone($name, $value, $required=false)
	{
		// let's get the field object 

		$field = $this->fields->getField($name);

		// call the text method and exit if it has error
		$this->text($name, $value, $required);
		if($field->hasError())
		{
			return;
		}

		// call the pattern method to use to validate the phone number
		$pattern = '/^[[:digit:]]{11,}$/';
		$message = ' Invalid phone number.';
		$this->pattern($name, $value, $pattern, $message, $required);
	}

	public function email($name, $value, $required=true)
	{

		// let's get the Field object
		$field = $this->fields->getField($name);
		// If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }
        if($required && empty($value))
        {
        	$field->setMessage('Required');
        }

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        // Split email address on @ sign and check parts
        $parts = explode('@', $value);
        if (count($parts) < 2) {
            $field->setMessage('At sign required.');
            return;
        }
        if (count($parts) > 2) {
            $field->setMessage('Only one at sign allowed.');
            return;
        }
        $local = $parts[0];
        $domain = $parts[1];

        // Check lengths of local and domain parts
        if (strlen($local) > 64) {
            $field->setMessage('Username part too long.');
            return;
        }
        if (strlen($domain) > 255) {
            $field->setMessage('Domain name part too long.');
            return;
        }

        // Patterns for address formatted local part
        $atom = '[[:alnum:]_!#$%&\'*+\/=?^`{|}~-]+';
        $dotatom = '(\.' . $atom . ')*';
        $address = '(^' . $atom . $dotatom . '$)';

        // Patterns for quoted text formatted local part
        $char = '([^\\\\"])';
        $esc  = '(\\\\[\\\\"])';
        $text = '(' . $char . '|' . $esc . ')+';
        $quoted = '(^"' . $text . '"$)';

        // Combined pattern for testing local part
        $localPattern = '/' . $address . '|' . $quoted . '/';

        // Call the pattern method and exit if it yields an error
        $this->pattern($name, $local, $localPattern,
                'Invalid username part.');
        if ($field->hasError()) { return; }

        // Patterns for domain part
        $hostname = '([[:alnum:]]([-[:alnum:]]{0,62}[[:alnum:]])?)';
        $hostnames = '(' . $hostname . '(\.' . $hostname . ')*)';
        $top = '\.[[:alnum:]]{2,6}';
        $domainPattern = '/^' . $hostnames . $top . '$/';

        // Call the pattern method
        $this->pattern($name, $domain, $domainPattern,
                'Invalid domain name part.');
    }

    public function password($name, $password, $required = true) {
        $field = $this->fields->getField($name);

        if (!$required && empty($password)) {
            $field->clearErrorMessage();
            return;
        }

        $this->text($name, $password, $required, 6);
        if ($field->hasError()) { return; }

        // Patterns to validate password
        $charClasses = array();
        $charClasses[] = '[:digit:]';
        $charClasses[] = '[:upper:]';
        $charClasses[] = '[:lower:]';
        $charClasses[] = '[:punct:]';

        $pw = '/^';
        $valid = '[';
        foreach($charClasses as $charClass) {
            $pw .= '(?=.*[' . $charClass . '])';
            $valid .= $charClass;
        }
        $valid .= ']{6,}';
        $pw .= $valid . '$/';

        $pwMatch = preg_match($pw, $password);

        if ($pwMatch === false) {
            $field->setMessage('Error testing password.');
            return;
        } else if ($pwMatch != 1) {
            $field->setMessage(
                    'Must have one each of upper, lower, and digit.');
            return;
        }
    
	}

	public function verify($name, $password, $verify, $required=true )
	{
		// get the Field object
		$field = $this->fields->getField($name);

		$this->text($name, $verify, $required, 8 );

		if($field->hasError())
		{
			return;
		}

		if(strcmp($verify, $password) != 0)
		{
			$field->setMessage('Passwords do not match.');
			return;
		}
	}
}


















































?>