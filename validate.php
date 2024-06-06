<?php

function is_text( string $input, int $min = 1, int $max = 50): bool {
    return ( strlen( $input ) >= $min && strlen( $input ) <= $max );
}

function is_number( int $input, int $min = 0, int $max = 100 ): bool {
    return ( $input >= $min && $input <= $max );
}