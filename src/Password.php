<?php



namespace Solenoid\KeyGen;



class Password
{
    public string $value;



    # Returns [self]
    public function __construct (string $value)
    {
        // (Getting the value)
        $this->value = $value;
    }

    # Returns [Password]
    public static function create (string $value)
    {
        // Returning the value
        return new Password( $value );
    }



    # Returns [int]
    public function rank ()
    {
        // (Setting the value)
        $range = 0;



        if ( preg_match( '/[a-z]/', $this->value ) === 1 )
        {// (Lowercase Character)
            // (Incrementing the value)
            $range += 26;
        }

        if ( preg_match( '/[A-Z]/', $this->value ) === 1 )
        {// (Uppercase Character)
            // (Incrementing the value)
            $range += 26;
        }

        if ( preg_match( '/[0-9]/', $this->value ) === 1 )
        {// (Number)
            // (Incrementing the value)
            $range += 10;
        }

        if ( preg_match( '/[^a-zA-Z0-9]/', $this->value ) === 1 )
        {// (Symbol)
            // (Incrementing the value)
            $range += 33;
        }



        // (Getting the value)
        $entropy = log( pow( $range, strlen( $this->value ) ), 2 );



        // Returning the value
        return $entropy;
    }



    # Returns [Password]
    public static function generate (int $length = 32, int $min_entropy = 128)
    {
        // (Setting the value)
        $characters = '!#$%&*+,-./0123456789:;@ABCDEFGHIJKLMNOPQRSTUVWXYZ[]^_abcdefghijklmnopqrstuvwxyz{|}~';



        // (Setting the value)
        $password = null;



        while ( true )
        {// Processing each clock
            // (Setting the value)
            $password = '';

            for ($i = 0; $i < $length; $i++)
            {// Iterating each index
                // (Appending the value)
                $password .= $characters[ mt_rand( 0, strlen( $characters ) - 1 ) ];
            }



            if ( Password::create( $password )->rank() >= $min_entropy ) break;
        }



        // Returning the value
        return Password::create( $password );
    }



    # Returns [bool]
    public function verify (string $hash)
    {
        // Returning the value
        return password_verify( $this->value, $hash );
    }

    # Returns [string]
    public function hash (?string $algo = PASSWORD_BCRYPT)
    {
        // Returning the value
        return password_hash( $this->value, $algo );
    }



    # Returns [string]
    public function __toString ()
    {
        // Returning the value
        return $this->value;
    }
}



?>