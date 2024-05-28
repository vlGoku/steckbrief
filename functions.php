<?php
function e( string $input ): string {
    return htmlspecialchars( $input, ENT_QUOTES, 'UTF-8');
}

function scale_and_copy( string $filename, string $save_to, $max_width = 300, $max_height = 300): bool {
    $width = $max_width;
    $height = $max_height;

    //Get new sizes
    [ $orig_width, $orig_height, $mime_type ] = getimagesize( $filename );
    if( $orig_width === null || $orig_height === null ){
        return false;
    }

    //Calculate new size
    $ratio = $orig_width / $orig_height;
    if( $width / $height > $ratio ){
        $width = $height * $ratio;
    } else {
        $height = $width / $ratio;
    }


    $source = match ( $mime_type ) {
        IMAGETYPE_JPEG => imagecreatefromjpeg( $filename ),
        IMAGEGETYPE_PNG => imagecreatefrompng( $filename ),
        default => false,
    };

    $thumb = imagecreatetruecolor( $width, $height );

    //Resize
    imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height );

    //Output
    match ( $mime_type ) {
        IMAGETYPE_JPEG => imagejpeg( $thumb, $save_to ),
        IMAGETYPE_PNG => imagepng( $thumb, $save_to ),
        default => false,
    };
    imagedestroy( $thumb );
    imagedestroy( $source );
    return true;
}

?>